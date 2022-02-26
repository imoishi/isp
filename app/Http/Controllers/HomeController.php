<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::whereStatus(1)->get();
        return view('frontend.home.index', compact('sliders'));
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showAboutUs()
    {
//        dd('rtr');
        return view('frontend.about-us.index');
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPackage()
    {
        $packages = Package::whereStatus(1)->orderBy('id', 'desc')->get();
//        dd($packages);
        return view('frontend.package.index', compact('packages'));
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showContact()
    {
        return view('frontend.contact.index');
    }

}
