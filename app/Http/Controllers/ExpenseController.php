<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_unless(Gate::allows('access-expense'), 403);
//        $expenses = Expense::latest()->get();
        $expenses = Expense::with('expenseType:id,name')->latest()->get();
        $expenseTypes = ExpenseType::where('status', 1)->latest()->get();
//        dd($expenses);

        return view('admin.expense.index', compact('expenses', 'expenseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('create-expense'), 403);
//        dd($request->all());
        $this->validate($request, [
            'amount' => 'required',
            'date' => 'required',
        ]);

        $data = $request->all();

        $expense = Expense::create([
            'expense_type_id' => $data['expense_type_id'],
            'amount' => $data['amount'],
            'remarks' => $data['remarks'],
            'date' => $data['date'],
        ]);

//        dd($package);

        return redirect()->back()->with('success', trans('trans.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        abort_unless(Gate::allows('update-expense'), 403);

        $this->validate($request, [
            'amount' => 'required',
            'date' => 'required',

        ]);

        $data = $request->all();


        $expense = $expense->update([
//            'user_id' => auth()->user()->id,
//            'expense_type_id' => $expenseType->id,
            'expense_type_id' => $data['expense_type_id'],
            'amount' => $data['amount'],
            'remarks' => $data['remarks'],
            'date' => $data['date'],
        ]);

//        dd($expense);


        return redirect()->back()->with('success', trans('trans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        abort_unless(Gate::allows('delete-expense'), 403);

        $expense->forceDelete();

        return redirect()->back()->with('success', trans('trans.deleted_successfully'));
    }
}
