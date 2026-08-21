<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Status::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'StatusName' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
        $Status = Status::create([
        'StatusName'=> $request->StatusName,
        'Description'=> $request->Description,
       ]);
       return $Status;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Status::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'StatusName' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
        $Status = status::find($id);
        $Status->update([
            'StatusName'=> $request->StatusName,
            'Description'=> $request->Description,
        ]);
        return $Status;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $Status = status::find($id);
         $Status->delete();
         return "Status deleted successfully";
    }
}
