<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    public function index()
    {
        // Get purchases
        $purchases = Purchase::orderBy("created_at","DESC")->paginate(15);
        // Purchases Count
        $count     = $purchases->total();
        // Get categories
        $categories = Category::all();
        // Return
        return view("purchases.purchases",compact("purchases", "count", "categories"));
    }

    public function create()
    {
        // Get categories
        $categories = Category::all();
        // Return
        return view("purchases.addPurchase", compact("categories"));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "product"  => "required|string|exists:categories,id",
            "type"     => "required|string",
            "comment"  => "nullable|string",
            "quantity" => "required|numeric|min:1",
            "price"    => "required|numeric|min:1",
            "total"    => "required|numeric|min:1",
        ]);
        // Insert data
        Purchase::create([
            "category_id"  => $request->product,
            "type"         => $request->type,
            "comment"      => $request->comment,
            "quantity"     => $request->quantity,
            "price"        => $request->price,
            "total"        => $request->total,
        ]);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function edit(string $id)
    {
        // Check if exist
        $purchase = Purchase::findOrFail($id);
        // Get categories
        $categories = Category::all();
        return view("purchases.editPurchase", compact("purchase","categories"));
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $purchase = Purchase::findOrFail($id);
        // Validation
        $request->validate([
            "product"  => "required|string|exists:categories,id",
            "type"     => "required|string",
            "comment"  => "nullable|string",
            "quantity" => "required|numeric|min:1",
            "price"    => "required|numeric|min:1",
            "total"    => "required|numeric|min:1",
        ]);
        // Update data
        $purchase->update([
            "category_id"  => $request->product,
            "type"         => $request->type,
            "comment"      => $request->comment,
            "quantity"     => $request->quantity,
            "price"        => $request->price,
            "total"        => $request->total,
        ]);
        // Return
        return redirect()->route("purchases.purchases")->with("success","Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $purchase = Purchase::findOrFail($id);
        // delete
        $purchase->delete();
        // Return
        return redirect()->back()->with("success","Deleted successfully");
    }

    public function search(Request $request)
    {
        // Validation
        $request->validate([
            "typeSearch" => "nullable|string",
            "productSearch" => "required|string|exists:categories,id",
        ]);
        // Catch
        $type       = $request->input("typeSearch");
        $product    = $request->input("productSearch");
        // the search query
        if($request->get("typeSearch")){
            $purchases  = Purchase::where("type", $type)->where("category_id", $product)->orderBy("created_at","DESC")->paginate()->appends(['type' => $type, 'product'=>$product]);
        }else{
            $purchases  = Purchase::where("category_id", $product)->orderBy("created_at","DESC")->paginate()->appends(['product' => $product]);
        }
        // Purchases Count
        $count      = $purchases->total();
        // Get categories
        $categories = Category::all();
        // Return
        return view("purchases.purchases",compact("purchases", "count", "categories"));
    }
}
