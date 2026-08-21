<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Priority;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Priority::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'PriorityLevel' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
      $priority = priority::create([
        'PriorityLevel'=> $request->PriorityLevel,
        'Description'=> $request->Description,
       ]);
       return $Priority;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Priority::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'PriorityLevel' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
        $Priority = Priority::find($id);
        $Priority->update([
            'PriorityLevel'=> $request->PriorityLevel,
            'Description'=> $request->Description,
        ]);
        return $Priority;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Priority = priority::find($id);
        $Priority->delete();
        return "Priority deleted successfully";
    }
}
