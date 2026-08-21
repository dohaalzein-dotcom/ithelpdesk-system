<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ActivityLog::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'UserId' => 'required|exists:users,id',
            'ActionType' => 'required|string|max:255',
            'Description' => 'required|string',
        ]);
        return ActivityLog::create([
            'UserId' => $request->UserId,
            'ActionType' => $request->ActionType,
            'Description' => $request->Description,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ActivityLog::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'UserId' => 'required|exists:users,id',
            'ActionType' => 'required|string|max:255',
            'Description' => 'required|string',
        ]);
        $activitylog = ActivityLog::find($id);
        $activiylog->update([
             'UserId' => $request->UserId,
             'ActionType' => $request->ActionType,
             'Description' => $request->Description,
        ]);
        return $activitylog;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activitylog = ActivityLog::find($id);
        $activitylog->delete;
        return "ActivityLog deleted successfully";
    }
}
