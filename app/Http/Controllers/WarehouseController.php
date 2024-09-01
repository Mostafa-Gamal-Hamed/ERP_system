<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        // Get stock
        $stock     = Warehouse::orderBy("created_at","DESC")->paginate(15);
        // Sales Count
        $count     = $stock->total();
        // Get customer
        $categories = Category::all();
        return view("warehouse.warehouse", compact("stock", "count", "categories"));
    }

    public function create()
    {
        // Get customer
        $categories = Category::all();
        return view("warehouse.addStock", compact("categories"));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "product"  => "required|string|exists:categories,id",
            "type"     => "required|string|exists:purchases,id",
            "quantity" => "required|numeric|min:1",
        ]);
        // Insert data
        Warehouse::create([
            "categories_id" => $request->product,
            "purchases_id"  => $request->type,
            "quantity"      => $request->quantity,
        ]);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $stock = Warehouse::findOrFail($id);
        // Validation
        $request->validate([
            "product"  => "required|string|exists:categories,id",
            "type"     => "required|string|exists:purchases,id",
            "quantity" => "required|numeric|min:1",
        ]);
        // Insert data
        $stock->update([
            "categories_id" => $request->product,
            "purchases_id"  => $request->type,
            "quantity"      => $request->quantity,
        ]);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $stock = Warehouse::findOrFail($id);
        // delete
        $stock->delete();
        // Return
        return redirect()->back()->with("success","Deleted successfully");
    }

    public function search(Request $request)
    {
        // Validation
        $request->validate([
            "search" => "required|date"
        ]);
        // Catch
        $search = $request->input("search");
        // the search query
        $stock  = Warehouse::where("created_at", "like", "%$search%")->paginate()->appends(['search' => $search]);
        // Purchases Count
        $count  = $stock->total();
        // Get customer
        $categories = Category::all();
        // Return
        return view("warehouse.warehouse",compact("stock", "count", "categories"));
    }
}
