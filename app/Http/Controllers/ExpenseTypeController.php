<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $expenseTypes = ExpenseType::latest()->get();

//        $expenseTypes = ExpenseType::when(auth()->user()->is_admin != 1, function ($q) {
//            $q->where('user_id', auth()->user()->id);
//        })
//            ->latest()
//            ->get();
//        dd($expenseTypes);

        return view('admin.expenseType.index', compact('expenseTypes'));
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
        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();

        $request->has('status') ? $data['status'] = 1 : $data['status'] = 0;

        $expenseType = ExpenseType::create([
            'name' => $data['name'],
            'status' => $data['status'],
        ]);

//        dd($package);

        return redirect()->back()->with('success', trans('trans.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseType $expenseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseType $expenseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ExpenseType $expenseType
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ExpenseType $expenseType)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $data = $request->all();

        $request->has('status') ? $data['status'] = 1 : $data['status'] = 0;

        $expenseType = $expenseType->update([
            'name' => $data['name'],
            'status' => $data['status'],
        ]);

//        dd($expense);


        return redirect()->back()->with('success', trans('trans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ExpenseType $expenseType
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->forceDelete();

        return redirect()->back()->with('success', trans('trans.deleted_successfully'));
    }

    public function statusUpdate(ExpenseType $expenseType)
    {
        $expenseType->update([
            'status' => !$expenseType->status
        ]);

        return redirect()->back()->with('success', trans('trans.updated_successfully'));
    }
}
