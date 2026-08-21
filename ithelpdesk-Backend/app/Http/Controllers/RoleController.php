<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'RoleName' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
        return Role::create([
            'RoleName' => $request->RoleName,
            'Description' => $request->Description,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Role::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'RoleName' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
        $role = Role::find($id);
        $role->update([ 
            'RoleName' => $request->RoleName,
            'Description' => $request->Description,
        ]);
        return $role;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return "Role deleted Successfully";
    }
}
