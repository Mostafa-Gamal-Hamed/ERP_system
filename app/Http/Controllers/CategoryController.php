<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Get categories
        $categories = Category::all();
        // return
        return view("categories.categories", compact("categories"));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "category" => "required|string|unique:categories,name|min:3"
        ]);
        // Insert data
        Category::create(['name' => $request->input('category')]);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $category = Category::findOrFail($id);
        // Validation
        $request->validate([
            "name" => "required|string|unique:categories,name|min:3"
        ]);
        // Update data
        $category->update(['name' => $request->input('name')]);
        // Return
        return redirect()->back()->with("success","Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $category = Category::findOrFail($id);
        // Delete
        $category->delete();
        // Return
        return redirect()->back()->with("success","Deleted successfully");
    }
}
