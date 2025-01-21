<?php

namespace App\Http\Controllers;

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
        // $this->middleware('auth');
    }

    public function redirectAdmin()
    {
        // session()->forget('otp');
        // session()->forget('number');
        // session()->forget('Patient');
        // return redirect()->route('admin.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        session()->forget('otp');
        session()->forget('number');
        session()->forget('Patient');

        $sliders = Slider::all();

        return view('site.home',compact('sliders'));
    }
}
