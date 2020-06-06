<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        //$this->middleware('rolecheck');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function roleman(Request $request)
    {
        return view('simplepost');
    }

    public function soli(Request $request)
    {
        return 'soli access granted';
        
    }

    public function samplepost(Request $request)
    {
        return 'we got the request';
        
    }
}
