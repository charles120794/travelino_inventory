<?php

namespace App\Http\Controllers\Main;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\Common\ModuleCommonAccessTrait;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('login');
    }

    public function features()
    {
        return view('main.features');
    }

    public function contactus()
    {
        return view('main.contactus');
    }

    public function aboutus()
    {
        return view('main.aboutus');
    }

    public function details($moduleID, Request $request)
    {
        return view('main.details',[
            'moduleInfo' => $this->getModule(decrypt($moduleID)),
        ]);
    }

}
