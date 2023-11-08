<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $notes = Note::with('tags')
            ->where('created_by', $userId)
            ->get();

        $tags = Tag::get();

        return view('notes.index', compact('notes', 'tags'));
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
        // Validation
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'tags' => 'array',
        ]);

        // Create a new Note
        $note = new Note;
        $note->title = $validatedData['title'];
        $note->body = $validatedData['body'];
        $note->created_by = Auth::user()->id;
        $note->save();

        // Attach tags to the Note
        if (isset($validatedData['tags']) && is_array($validatedData['tags'])) {
            $note->tags()->attach($validatedData['tags']);
        }

        return redirect()->back()
            ->with('success', 'Note created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::with('tags')
            ->where('id', $id)
            ->first();

        return view('notes.view', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $note = Note::with('tags')
            ->where('id', $id)
            ->first();

        $tags = Tag::get();

        return view('notes.edit', compact('note', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'tags' => 'array',
        ]);

        // Create a new Note
        $note = Note::findorFail($id);
        $note->title = $validatedData['title'];
        $note->body = $validatedData['body'];
        $note->created_by = Auth::user()->id;
        $note->save();

        // Attach tags to the Note
        if (isset($validatedData['tags']) && is_array($validatedData['tags'])) {
            $note->tags()->sync($validatedData['tags']);
        }

        return redirect()->route('notes.index')
            ->with('success', 'Note Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the note by ID
            $note = Note::findOrFail($id);

            // Detach the tags associated with the note
            $note->tags()->detach();

            // Delete the note
            $note->delete();

            return response()->json(['message' => 'Note deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Note not found or could not be deleted'], 404);
        }
    }
}
