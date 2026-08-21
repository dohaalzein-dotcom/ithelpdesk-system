<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Notification::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'UserId' => 'required|exists:users,id',
            'Title' => 'required|string|max:255',
            'Message' => 'required|string',
            'IsRead' => 'required|boolean',
        ]);
        return Notification::create([
            'UserId' => $request->UserId,
            'Title' => $request->Title,
            'Message' => $request->Message,
            'IsRead' => $request->IsRead,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Notification::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'UserId' => 'required|exists:users,id',
            'Title' => 'required|string|max:255',
            'Message' => 'required|string',
            'IsRead' => 'required|boolean',
        ]);
        $notification = Notification::find($id);
        $notification->update([
            'UserId' => $request->UserId,
            'Title' => $request->Title,
            'Message' => $request->Message,
            'IsRead' => $request->IsRead,
        ]);
        return $notification;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);
        $notification->delate;
        return "Notification deleted successfully";
    }
}
