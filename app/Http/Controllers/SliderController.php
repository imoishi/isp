<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_unless(Gate::allows('access-slider'), 403);

        $sliders = Slider::latest()->get();

//        dd($sliders);

        return view('admin.slider.index', compact('sliders'));
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
        abort_unless(Gate::allows('access-slider'), 403);
        $this->validate($request, [
//            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000',
        ],
            ['image.required' => 'The image field is required.']);

        $data = $request->all();

        if($request->has('image')){
            $data['image'] = uploadImage($request->image, imagePath()['slider']['path'], imagePath()['slider']['size']);

        }


        $request->has('status') ? $data['status'] = 1 : $data['status'] = 0;

        $slider = Slider::create($data);

        return redirect()->back()->with('success', trans('trans.created_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Slider $slider)
    {
        abort_unless(Gate::allows('access-slider'), 403);
        $slider->delete();
        return redirect()->back()->with('success', trans('trans.deleted_successfully'));
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function statusUpdate(Slider $slider)
    {
        abort_unless(Gate::allows('access-slider'), 403);
        $slider->update([
            'status' => !$slider->status
        ]);

        return redirect()->back()->with('success', trans('trans.updated_successfully'));

    }
}
