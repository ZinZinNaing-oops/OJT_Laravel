<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->cookie('id' . Auth::user()->id)) {
            return view('home', ['banner' => "not first"]);
        } else {
            $response = new Response(view('home', ['banner' => "first"]));
            $response->withCookie(cookie()->forever('id' . Auth::user()->id, Auth::user()->id));
            return $response;
        }
    }
}
