<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketComment;
class TicketCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TicketComment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'TicketId' => 'required|exists:tickets,id',
            'UserId' => 'required|exists:users,id',
            'CommentText' => 'required|string',
            'IsInternalNote' => 'required|boolean',
        ]);
        return TicketComment::create([
            'TicketId' => $request->TicketId,
            'UserId' => $request->UserId,
            'CommentText' => $request->CommentText,
            'IsInternalNote' => $request->IsInternalNote,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return TicketComment::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TicketId' => 'required|exists:tickets,id',
            'UserId' => 'required|exists:users,id',
            'CommentText' => 'required|string',
            'IsInternalNote' => 'required|boolean',
        ]);
        $ticketcomment = TicketComment::find($id);
        $ticketcomment->update([
            'TicketId' => $request->TicketId,
            'UserId' => $request->UserId,
            'CommentText' => $request->CommentText,
            'IsInternalNote' => $request->IsInternalNote,
        ]);
        return $ticketcomment; 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticketcomment = TicketComment::find($id);
        $ticketcomment->delete;
        return "TicketComment deleted successfully";
    }
}
