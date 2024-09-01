<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function index()
    {
        // Get reports
        $reports = Report::orderBy("created_at", "DESC")->paginate(15);
        // Reports Count
        $count   = $reports->total();
        // Get users
        $users   = User::all();
        return view("reports.reports", compact("reports", "count", "users"));
    }

    public function create()
    {
        return view("reports.addReport");
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "title"           => "required|string|min:3",
            "description"     => "required|string"
        ]);
        // Get user
        $user = Auth::user()->id;
        // Insert data
        Report::create([
            "title"        => $request->title,
            "description"  => $request->description,
            "users_id"     => $user,
        ]);
        // Return
        return redirect()->route("reports.reports")->with("success", "Added successfully");
    }

    public function edit(string $id)
    {
        // Check if exist
        $report = Report::findOrFail($id);
        // Return
        return view("reports.editReport", compact("report"));
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $report = Report::findOrFail($id);
        // Validation
        $request->validate([
            "title"           => "required|string|min:3",
            "description"     => "required|string"
        ]);
        // Get user
        $user = Auth::user()->id;
        // Insert data
        $report->update([
            "title"        => $request->title,
            "description"  => $request->description,
            "users_id"     => $user,
        ]);
        // Return
        return redirect()->route("reports.reports")->with("success", "Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $report = Report::findOrFail($id);
        // delete
        $report->delete();
        // Return
        return redirect()->back()->with("success","Deleted successfully");
    }

    public function search(Request $request)
    {
        // Validation
        $request->validate([
            "search" => "nullable|string|exists:users,id"
        ]);
        // Catch
        $search  = $request->input("search");
        // the search query
        $reports = Report::where("users_id", $search)->orderBy("created_at", "DESC")->paginate()->appends(['search' => $search]);
        // Purchases Count
        $count   = $reports->total();
        // Get users
        $users   = User::all();
        // Return
        return view("reports.reports",compact("reports","count","users"));
    }

    public function downloadPDF($id)
    {
        $report = Report::findOrFail($id);

        $pdf = Pdf::loadView("reports.pdf", compact("report"));
        return $pdf->download("report.pdf");
    }
}
