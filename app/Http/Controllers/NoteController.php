<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('notes.index', [
            'notes' => Note::with('user')->latest()->get(),
            'labels' => Label::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->notes()->create($validated);

        return redirect(route('notes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): View
    {
        Gate::authorize('update', $note);

        return view('notes.edit', [
            'note' => $note,
            'labels' => Label::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        Gate::authorize('update', $note);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $note->update($validated);

        return redirect(route('notes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);
        $note->delete();
        return redirect(route('notes.index'));
    }
}
