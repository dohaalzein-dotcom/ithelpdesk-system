<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketAttachment;
class TicketAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TicketAttachment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'TicketId' => 'required|exists:tickets,id',
            'FileName' => 'required|string|max:255',
            'FilePath' => 'required|string|max:255',
            'FileType' => 'required|string|max:100',
            'FileSize' => 'required|integer',
            'UploadByUserId' => 'required|exists:users,id',
        ]);
        return TicketAttachment::create ([
            'TicketId' => $request->TicketId,
            'FileName' => $request->FileName,
            'FilePath' => $request->FilePath,
            'FileType' => $request->FileType,
            'FileSize' => $request->FileSize,
            'UploadByUserId' => $request->UploadByUserId,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return TicketAttachment::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TicketId' => 'required|exists:tickets,id',
            'FileName' => 'required|string|max:255',
            'FilePath' => 'required|string|max:255',
            'FileType' => 'required|string|max:100',
            'FileSize' => 'required|integer',
            'UploadByUserId' => 'required|exists:users,id',
        ]);
        $ticketattachment = TicketAttachment::find($id);
        $ticketattachment->update([
             'TicketId' => $request->TicketId,
            'FileName' => $request->FileName,
            'FilePath' => $request->FilePath,
            'FileType' => $request->FileType,
            'FileSize' => $request->FileSize,
            'UploadByUserId' => $request->UploadByUserId,
        ]);
        return $ticketattachment;
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticketattachment = Ticketattachment::find($id);
        $ticketattachment->delete;
        return "TicketAttachment deleted successfully";
    }
}
