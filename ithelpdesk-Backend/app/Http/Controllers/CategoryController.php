<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
        $Category = Category::create([
            'CategoryName'=> $request->CategoryName,
            'Description' => $request->Description,
        ]);
        return $Category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'Description' => 'nullable|string|max:255',
        ]);
        $Category = Category::find($id);
        $Category->update([
            'CategoryName'=> $request->CategoryName,
            'Description' => $request->Description,
        ]);
        return $Category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $Category = Category::find($id);
         $Category->delete();
         return "Category deleted successfully";
    }
}
