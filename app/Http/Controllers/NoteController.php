<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Actions\Note\GetNotes;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetNotes $getNotes)
    {
        $notes = $getNotes();

        return view('note.index', compact('notes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Note::class);
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = $request->user()->id;
        $note = Note::create($data);

        return to_route('note.show', $note)->with('message', 'Note was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {

        Gate::authorize('view', $note);
        return view('note.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        Gate::authorize('update', $note);
        return view('note.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $data = $request->validated();
        Gate::authorize('update', $note);
        $note->update($data);

        return to_route('note.show', $note)->with('message', 'Note was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);
        $note->delete();

        return to_route('note.index')->with('message', 'Note was deleted');
    }
}
