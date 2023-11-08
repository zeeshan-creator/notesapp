<?php

namespace App\Http\Controllers;

use App\Models\SharedNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharedNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the shared notes
        $sharedNotes = SharedNote::where('shared_to', Auth::user()->id)
            ->with('note')
            ->with('createdUser')
            ->get();

        return view('shared_notes.index', ['sharedNotes' => $sharedNotes]);
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
        $request->validate([
            'note_id' => 'required|exists:notes,id',
            'user_ids' => 'required|array',
        ]);

        $noteId = $request->input('note_id');
        $userIds = $request->input('user_ids');

        $createdBy = Auth::user()->id;

        foreach ($userIds as $userId) {
            $existingSharedNote = SharedNote::where('note_id', $noteId)
                ->where('shared_to', $userId)
                ->first();

            if (!$existingSharedNote) {
                $sharedNote = new SharedNote;
                $sharedNote->note_id = $noteId;
                $sharedNote->created_by = $createdBy;
                $sharedNote->shared_to = $userId;
                $sharedNote->save();
            }
        }

        return response()->json(['message' => 'Note shared successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
