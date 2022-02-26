<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_unless(Gate::allows('access-bill'), 403);
        $customers = User::with('package')
            ->whereNotNull('package_id')
            ->whereStatus('1')
            ->latest()
            ->select('id', 'first_name', 'last_name', 'package_id')
            ->get();
        $bills = Bill::latest()->get();
        return view('admin.bill.index', compact('bills', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('create-bill'), 403);
        $this->validate($request, [
            'date' => 'required',
            'user_id' => 'required',
            'amount' => 'required',

        ], [
            'user_id.required' => 'The customer is required for bill create'
        ]);

        $data = $request->except('_token');
        $bill = Bill::create($data);

        return redirect()->route('bills.index')->with('success', trans('trans.created_successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bill $bill
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Bill $bill)
    {
        abort_unless(Gate::allows('update-bill'), 403);
        $this->validate($request, [
            'date' => 'required',
            'user_id' => 'required',
            'amount' => 'required',

        ], [
            'user_id.required' => 'The customer is required for bill create'
        ]);
        $data = $request->except('_token');

        $bill->update($data);

        return redirect()->route('bills.index')->with('success', trans('trans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bill $bill
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Bill $bill)
    {
        abort_unless(Gate::allows('delete-bill'), 403);
        $bill->delete();
//        Cache::forget('categories');
        return redirect('/bills')->with('success', trans('trans.deleted_successfully'));
    }
}
