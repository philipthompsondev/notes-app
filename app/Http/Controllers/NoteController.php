<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
//        dd($request);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'bg_color' => 'required|string',
            'font_color' => 'required|string',
        ]);

        $note = new Note();
        $note->user_id = Auth::id();
        $note->title = $validated['title'];
        $note->message = $validated['message'];
        $note->bg_color =  $validated['bg_color'];
        $note->font_color =  $validated['font_color'];

        $note->save();
        $note->labels()->attach($request->labels);

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

        $selected_labels = [];
        foreach ($note->labels as $label) {
            $selected_labels[] = $label->id;
        }

        return view('notes.edit', [
            'note' => $note,
            'labels' => Label::all(),
            'selected_labels' => $selected_labels
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'bg_color' => 'required|string',
            'font_color' => 'required|string',
        ]);

        $note->update($validated);
        $note->labels()->sync($request->label_note);

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
