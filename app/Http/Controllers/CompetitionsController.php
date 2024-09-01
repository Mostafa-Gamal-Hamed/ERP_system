<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionsController extends Controller
{
    public function index()
    {
        // Get competitions
        $competitions = Competition::orderBy("created_at","DESC")->paginate(15);
        // // Competitions Count
        $count        = $competitions->total();
        return view("competitions.competitions", compact("competitions", "count"));
    }

    public function create()
    {
        return view("competitions.addCompetition");
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "name"        => "required|string|min:3",
            "description" => "required|string|max:255",
            "startDate"   => "required|date",
            "endDate"     => "required|date",
        ]);
        // Insert data
        Competition::create([
            "name"        => $request->name,
            "description" => $request->description,
            "start_date"   => $request->startDate,
            "end_date"     => $request->endDate,
        ]);
        // Return
        return redirect()->back()->with("success","Added successfully");
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $competition = Competition::findOrFail($id);
        // Validation
        $request->validate([
            "name"        => "required|string|min:3",
            "description" => "required|string|max:255",
            "startDate"   => "required|date",
            "endDate"     => "required|date",
        ]);
        // Insert data
        $competition->update([
            "name"        => $request->name,
            "description" => $request->description,
            "start_date"   => $request->startDate,
            "end_date"     => $request->endDate,
        ]);
        // Return
        return redirect()->back()->with("success","Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $competition = Competition::findOrFail($id);
        // Delete
        $competition->delete();
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
        $search       = $request->input("search");
        // the search query
        $competitions = Competition::where("name", "like", "%$search%")->orderBy("created_at","DESC")->paginate()->appends(['search' => $search]);
        // Accounts Count
        $count        = $competitions->total();
        // Return
        return view("competitions.competitions",compact("competitions", "count"));
    }
}
