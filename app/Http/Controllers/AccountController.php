<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // Get accounts
        $accounts = Account::orderBy("created_at","DESC")->paginate(15);
        // Accounts Count
        $count    = $accounts->total();
        return view("accounts.accounts", compact("accounts", "count"));
    }

    public function create()
    {
        return view('accounts.addAccount');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "name"  => "required|string|max:255",
            "type"     => "required|string|max:255",
            "balance" => "required|numeric|min:1",
        ]);
        // Insert data
        Account::create([
            "account_name" => $request->name,
            "account_type"  => $request->type,
            "balance"      => $request->balance,
        ]);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $account = Account::findOrFail($id);
        // Validation
        $request->validate([
            "name"  => "required|string|max:255",
            "type"     => "required|string|max:255",
            "balance" => "required|numeric|min:1",
        ]);
        // Insert data
        $account->update([
            "account_name" => $request->name,
            "account_type"  => $request->type,
            "balance"      => $request->balance,
        ]);
        // Return
        return redirect()->back()->with("success","Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $account = Account::findOrFail($id);
        // delete
        $account->delete();
        // Return
        return redirect()->back()->with("success","Deleted successfully");
    }

    public function search(Request $request)
    {
        // Validation
        $request->validate([
            "search" => "nullable|string|exists:accounts,account_name"
        ]);
        // Catch
        $search    = $request->input("search");
        // the search query
        $accounts  = Account::where("account_name", "like", "%$search%")->orderBy("created_at","DESC")->paginate()->appends(['search' => $search]);
        // Accounts Count
        $count     = $accounts->total();
        // Return
        return view("accounts.accounts",compact("accounts", "count"));
    }
}
