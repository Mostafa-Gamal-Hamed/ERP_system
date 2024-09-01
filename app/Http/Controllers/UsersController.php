<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function index()
    {
        // Get users
        $users = User::orderBy("created_at", "DESC")->paginate(15);
        // // Users Count
        $count = $users->total();
        return view("users.managers.users", compact("users", "count"));
    }

    public function create()
    {
        return view("users.managers.addUser");
    }

    public function store(Request $request)
    {
        // Validation
        $data = $request->validate([
            "name"  => "required|string|min:3",
            "email" => "required|email|unique:users,email|unique:customers,email",
            "password" => ['required', 'confirmed', Password::min(8)->mixedCase()->symbols()],
            "role"  => "required|in:0,1",
        ]);
        // Insert data
        User::create($data);
        // Return
        return redirect()->route("users.users")->with("success", "Added successfully");
    }

    public function edit(string $id)
    {
        // Check if exist
        $user = User::findOrFail($id);
        return view("users.managers.editUser", compact("user"));
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $user = User::findOrFail($id);
        // Validation
        $data = $request->validate([
            "name"  => "required|string|min:3",
            "email" => ["required","email",
                Rule::unique('users')->ignore($user->id),
                Rule::unique('customers')->ignore($user->id)],
            "role"  => "required|in:0,1",
        ]);
        // Insert data
        $user->update($data);
        // Return
        return redirect()->back()->with("success", "Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $user = User::findOrFail($id);
        // Delete
        $user->delete();
        // Return
        return redirect()->back()->with("success", "Deleted successfully");
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
        $users  = User::where("name", "like", "%$search%")->paginate()->appends(['search' => $search]);
        // Purchases Count
        $count  = $users->total();
        // Return
        return view("users.managers.users", compact("users", "count"));
    }

    public function changeRole(string $id)
    {
        // Check if exist
        $user = User::findOrFail($id);
        // Get role
        $role = $user->role;
        // Update
        if ($role === "0") {
            $user->update(["role"=>"1"]);
        } else {
            $user->update(["role"=>"0"]);
        }
        // Return
        return redirect()->back()->with("success", "Update role successfully");
    }
}
