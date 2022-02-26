<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Division;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $areas = Area::with('division:id,name', 'district:id,name', 'upazila:id,name')->orderBy('id', 'desc')->get();
//        dd($areas);
        $divisions = Division::where('status', 1)->latest()->get();
        $districts = Division::where('status', 1)->latest()->get();
        $upazilas = Division::where('status', 1)->latest()->get();

        return view('admin.area.index', compact('areas', 'divisions', 'districts', 'upazilas'));
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
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
        ]);

        $data = $request->all();
        $request->has('status') ? $data['status'] = 1 : $data['status'] = 0;
        Area::create([
            'name' => $data['name'],
            'division_id' => $data['division_id'],
            'district_id' => $data['district_id'],
            'upazila_id' => $data['upazila_id'],
            'status' => $data['status'],
        ]);

//        dd($package);

        return redirect()->back()->with('success', trans('trans.created_successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Area $area
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Area $area)
    {
        $this->validate($request, [
            'name' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
        ]);
        $data = $request->all();
        $request->has('status') ? $data['status'] = 1 : $data['status'] = 0;

        $area->update($data);
        return redirect('/areas')->with('success', trans('trans.created_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Area $area
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect('/areas')->with('success', trans('trans.updated_successfully'));
    }
}
