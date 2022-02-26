<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        abort_unless(Gate::allows('access-report'), 403);
        $reportData = [];
        if ($request->has('month')) {
            $reportData['total_expense'] = Expense::whereMonth('date', Carbon::parse($request->month)->month)->sum('amount');

            $reportData['total_due'] = Bill::whereMonth('date', Carbon::parse($request->month)->month)->sum('due');

            $reportData['total_amount'] = Bill::whereMonth('date', Carbon::parse($request->month)->month)->sum('amount');
        }
        $reportData = (object) $reportData;
        return view('admin.report.index', compact( 'reportData'));
    }
}
