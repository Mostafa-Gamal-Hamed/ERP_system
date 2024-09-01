<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomersController extends Controller
{
    public function index()
    {
        // Get customers
        $customers = Customer::orderBy("created_at","DESC")->paginate(15);
        // customers Count
        $count     = $customers->total();
        // Return
        return view("users.customers.customers", compact("customers","count"));
    }

    public function create()
    {
        return view("users.customers.addCustomer");
    }

    public function store(Request $request)
    {
        // Validation
        $data = $request->validate([
            "name"  => "required|string|min:3",
            "email"     => "nullable|string|email|unique:customers,email|unique:users,email",
            "phone" => "required|numeric|unique:customers,phone|min_digits:10",
            "city"  => "required|string",
            "address"    => "required|string"
        ]);
        // Insert data
        Customer::create($data);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $customer = Customer::findOrFail($id);
        // Validation
        $data = $request->validate([
            "name"  => "required|string|min:3",
            "email" => [
                "nullable","string","email",Rule::unique('customers')->ignore($customer->id),
            ],
            "phone" => [
                "required","numeric","min_digits:10",Rule::unique('customers')->ignore($customer->id)
            ],
            "city"  => "required|string",
            "address"    => "required|string"
        ]);
        // Update data
        $customer->update($data);
        // Return
        return redirect()->back()->with("success","Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $customer = Customer::findOrFail($id);
        // delete
        $customer->delete();
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
        $search     = $request->input("search");
        // the search query
        $customers  = Customer::whereAny(["name","email","phone","city"], "like", "%$search%")->paginate()->appends(['search' => $search]);
        // Purchases Count
        $count      = $customers->total();
        // Return
        return view("users.customers.customers",compact("customers","count"));
    }
}
