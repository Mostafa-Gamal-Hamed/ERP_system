<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warehouse;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::user()) {
            if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
                // Get stock & count
                $stock     = Warehouse::orderBy("created_at","DESC")->paginate(5);
                $stockCt   = $stock->total();
                // Get sales & count
                $sales     = Sale::orderBy("created_at","DESC")->paginate(5);
                $all       = Sale::all();
                $salesCt   = $all->sum('total');
                // Get purchases & count
                $purchases = Purchase::orderBy("created_at","DESC")->paginate(5);
                $all       = Purchase::all();
                $purchaseCt= $all->sum('total');
                // Get tasks & count
                $tasks     = Task::orderBy("created_at","DESC")->paginate(5);
                $all       = Task::where('status','pending')->get();
                $tasksCt   = count($all);
                return view('dashboard', compact(
                    'stock', 'stockCt', 'sales', 'salesCt',
                    'purchases', 'purchaseCt',
                    'tasks', 'tasksCt'
                ));
            } else {
                return view('auth.verify-email');
            }
        } else {
            return view('auth/login');
        }
    }
}
