<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Labels/Index', [
            'labels' => Label::with('user')->latest()->get(),
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
            'label' => 'required|string|max:25',
            'bg_color' => 'required|string|max:7',
            'font_color' => 'required|string|max:7',
        ]);

        $request->user()->labels()->create($validated);

        return redirect(route('labels.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        Gate::authorize('update', $label);

        return view('labels.edit', [
            'label' => $label,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        Gate::authorize('update', $label);
        $validated = $request->validate([
            'label' => 'required|string|max:25',
            'bg_color' => 'required|string|max:7',
            'font_color' => 'required|string|max:7',
        ]);
        $label->update($validated);

        return redirect(route('labels.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        Gate::authorize('delete', $label);
        $label->delete();
        return redirect(route('labels.index'));
    }
}
