<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        // Get tasks
        $tasks = Task::orderBy("created_at", "DESC")->paginate(15);
        // // Competitions Count
        $count        = $tasks->total();
        return view("tasks.tasks", compact("tasks", "count"));
    }

    public function create()
    {
        return view("tasks.addTask");
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            "title"       => "required|string|min:3",
            "description" => "required|string|max:255",
            "startDate"   => "required|date",
            "dueDate"     => "required|date",
            "status"      => "required|in:pending,done,canceled",
        ]);
        // Insert data
        Task::create([
            "title"       => $request->title,
            "description" => $request->description,
            "start_date"  => $request->startDate,
            "due_date"    => $request->dueDate,
            "status"      => $request->status,
        ]);
        // Return
        return redirect()->route("tasks.tasks")->with("success", "Added successfully");
    }

    public function edit(string $id)
    {
        // Check if exist
        $task = Task::findOrFail($id);
        return view("tasks.editTask", compact("task"));
    }

    public function update(Request $request, string $id)
    {
        // Check if exist
        $task = Task::findOrFail($id);
        // Validation
        $request->validate([
            "title"       => "required|string|min:3",
            "description" => "required|string|max:255",
            "startDate"   => "required|date",
            "dueDate"     => "required|date",
            "status"      => "required|in:pending,done,canceled",
        ]);
        // Insert data
        $task->update([
            "title"       => $request->title,
            "description" => $request->description,
            "start_date"  => $request->startDate,
            "due_date"    => $request->dueDate,
            "status"      => $request->status,
        ]);
        // Return
        return redirect()->back()->with("success", "Updated successfully");
    }

    public function destroy(string $id)
    {
        // Check if exist
        $task = Task::findOrFail($id);
        // Delete
        $task->delete();
        // Return
        return redirect()->back()->with("success", "Deleted successfully");
    }

    public function search(Request $request)
    {
        // Validation
        $request->validate([
            "title" => "nullable|string|max:255",
            "status" => "nullable|in:pending,done,canceled",
        ]);
        // Catch
        $title  = $request->input("title");
        $status = $request->input("status");
        // the search query
        if (!empty($title) || empty($status)) {
            $tasks  = Task::where("title", "like", "%$title%")->paginate()->appends(['title' => $title]);
        }
        if (!empty($status) || empty($title)) {
            $tasks  = Task::where("status", "like", "%$status")->paginate()->appends(['status' => $status]);
        }
        if (!empty($title) && !empty($status)) {
            $tasks  = Task::where("title", "like", "%$title%")->where("status", "like", "%$status")->paginate()->appends(['title' => $title, 'status' => $status]);
        }
        // Tasks Count
        $count  = $tasks->total();
        // Return
        return view("tasks.tasks", compact("tasks", "count"));
    }
}
