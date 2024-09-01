<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        // Get sales
        $sales     = Sale::orderBy("created_at","DESC")->paginate(15);
        // Sales Count
        $count     = $sales->total();
        // Get customer
        $customers = Customer::all();
        return view("sales.sales", compact("sales", "count", "customers"));
    }

    public function create()
    {
        // Get categories
        $categories = Category::all();
        // Get customers
        $customers = Customer::all();
        return view("sales.addSale", compact("categories","customers"));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "customer" => "required|string|exists:customers,id",
            "product"  => "required|string|exists:categories,id",
            "type"     => "required|string|exists:purchases,id",
            "quantity" => "required|numeric|min:1",
            "price"    => "required|numeric|min:1",
            "total"    => "required|numeric|min:1",
        ]);
        // Insert data
        Sale::create([
            "customers_id"  => $request->customer,
            "categories_id" => $request->product,
            "purchases_id"  => $request->type,
            "quantity"      => $request->quantity,
            "price"         => $request->price,
            "total"         => $request->total,
        ]);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function edit(string $id)
    {
        // Check if exist
        $sale = Sale::findOrFail($id);
        // Get categories
        $categories = Category::all();
        // Get customers
        $customers = Customer::all();
        return view("sales.editSale", compact("sale", "customers", "categories"));
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $sale = Sale::findOrFail($id);
        // Validation
        $request->validate([
            "customer" => "required|string|exists:customers,id",
            "product"  => "required|string|exists:categories,id",
            "type"     => "required|string|exists:purchases,id",
            "quantity" => "required|numeric|min:1",
            "price"    => "required|numeric|min:1",
            "total"    => "required|numeric|min:1",
        ]);
        // Insert data
        $sale->update([
            "customers_id"  => $request->customer,
            "categories_id" => $request->product,
            "purchases_id"  => $request->type,
            "quantity"      => $request->quantity,
            "price"         => $request->price,
            "total"         => $request->total,
        ]);
        // Return
        return redirect()->route("sales.sales")->with("success","Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $sales = Sale::findOrFail($id);
        // delete
        $sales->delete();
        // Return
        return redirect()->back()->with("success","Deleted successfully");
    }

    public function search(Request $request)
    {
        // Validation
        $request->validate([
            "search" => "required|string"
        ]);
        // Catch
        $search = $request->input("search");
        // the search query
        $sales  = Sale::where("customers_id", "like", "%$search%")->orderBy("created_at","DESC")->orderBy("created_at","DESC")->paginate()->appends(['search' => $search]);
        // Purchases Count
        $count  = $sales->total();
        // Get customer
        $customers = Customer::all();
        // Return
        return view("sales.sales",compact("sales", "count", "customers"));
    }

    public function getProductTypes($product_id)
    {
        // Get purchase
        $productTypes = Purchase::where('category_id', $product_id)->pluck('type', 'id');
        // Return
        return response()->json($productTypes);
    }
}
