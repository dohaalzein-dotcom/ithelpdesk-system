<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Username' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Password' => 'required|string|max:8',
            'RoleId' => 'required|exists:roles,id',
            'AccountStatus' => 'required|string',
        ]);
        return User::create([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'RoleId' => $request->RoleId,
            'AccountStatus' => $request->AccountStatus,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Username' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'Password' => 'required|string|max:8',
            'RoleId' => 'required|exists:roles,id',
            'AccountStatus' => 'required|string',
        ]);
        $user = User::find($id);
        $user->update([
            'Username' => $request->Username,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'RoleId' => $request->RoleId,
            'AccountStatus' => $request->AccountStatus,
        ]);
        return $user; 
            
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return "User deleted successfully";
    }
}
