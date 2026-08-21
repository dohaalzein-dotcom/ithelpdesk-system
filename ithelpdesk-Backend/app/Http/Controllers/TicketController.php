<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ReferenceNumber' => 'required|string|max:255',
            'Title' => 'required|string|max:255',
            'Description' => 'required|string',
            'CreatedByUserId' => 'required|exists:users,id',
            'AssignedByUserId' => 'required|exists:users,id',
            'CategoryId' => 'required|exists:categories,id',
            'PriorityId' => 'required|exists:priorities,id',
            'StatusId' => 'required|exists:statuses,id',
        ]);

        return Ticket::create([
            'ReferenceNumber' => $request->ReferenceNumber,
            'Title' => $request->Title,
            'Description' => $request->Description,
            'CreatedByUserId' => $request->CreatedByUserId,
            'AssignedToUserId' => $request->AssignedToUserId,
            'CategoryId' => $request->CategoryId,
            'PrirityId' => $request->PriorityId,
            'StatusId' => $request->StatusId,
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Ticket::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ReferenceNumber' => 'required|string|max:255',
            'Title' => 'required|string|max:255',
            'Description' => 'required|string',
            'CreatedByUserId' => 'required|exists:users,id',
            'AssignedByUserId' => 'required|exists:users,id',
            'CategoryId' => 'required|exists:categories,id',
            'PriorityId' => 'required|exists:priorities,id',
            'StatusId' => 'required|exists:statuses,id',
        ]);

       $ticket = Ticket::find($id);
       $ticket->update([
         'ReferenceNumber' => $request->ReferenceNumber,
            'Title' => $request->Title,
            'Description' => $request->Description,
            'CreatedByUserId' => $request->CreatedByUserId,
            'AssignedToUserId' => $request->AssignedToUserId,
            'CategoryId' => $request->CategoryId,
            'PrirityId' => $request->PriorityId,
            'StatusId' => $request->StatusId,
        ]);
       return $ticket;


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return "Ticket deleted succesfully";
    }
}
