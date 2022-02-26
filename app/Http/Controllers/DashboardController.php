<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Expense;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dashboardData = [];
        $dashboardData['totalExpense'] = Expense::whereMonth('date', Carbon::now()->submonth()->month)->sum('amount');

        $dashboardData['totalPackage'] =  Package::whereStatus('1')->count();
        $dashboardData['totalBill'] =  Bill::whereMonth('date', Carbon::now()->submonth()->month)->sum('amount');
        $dashboardData['totalDue'] =  Bill::whereMonth('date', Carbon::now()->submonth()->month)->sum('due');

//        dd($dashboardData);

        $dashboardData = (object) $dashboardData;

        return view('admin.dashboard.index', compact('dashboardData'));
    }
}
