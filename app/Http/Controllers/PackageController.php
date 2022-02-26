<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_unless(Gate::allows('access-package'), 403);
        $packages = Package::latest()->get();
//        dd($packages);

        return view('admin.package.index', compact('packages'));
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
     *  Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('create-package'), 403);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'value' => 'required',
        ]);

        $data = $request->all();

        $request->has('status') ? $data['status'] = 1 : $data['status'] = 0;

        $package = Package::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'value' => $data['value'],
            'status' => $data['status'],
        ]);

//        dd($package);

        return redirect()->back()->with('success', trans('trans.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Package $package
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Package $package)
    {
        abort_unless(Gate::allows('update-package'), 403);

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'value' => 'required',

        ]);

        $data = $request->all();

        $request->has('status') ? $data['status'] = 1 : $data['status'] = 0;

        $package = $package->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'value' => $data['value'],
            'status' => $data['status'],
        ]);

//        dd($expense);


        return redirect()->back()->with('success', trans('trans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Package $package
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function destroy(Package $package)
    {
        abort_unless(Gate::allows('delete-package'), 403);

        $package->forceDelete();
//        return redirect('/flats')->with('success', trans('trans.deleted_successfully'));
        return redirect()->back()->with('success', trans('trans.deleted_successfully'));
    }

    public function statusUpdate(Package $package)
    {
        $package->update([
            'status' => !$package->status
        ]);

        return redirect()->back()->with('success', trans('trans.updated_successfully'));
    }
}
