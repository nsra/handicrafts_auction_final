<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $user_role="";
        if(Auth::user()) $user_role=Auth::user()->role->name;
        if ($user_role === "Admin") {
            return redirect()->route('admin_dashboard');
        }

        else if($user_role === "Buyer"){
            return redirect()->route('buyer_dashboard');
        }

        else if($user_role === "Craftsman"){
            return redirect()->route('craftsman_dashboard');
        }

        else return view('welcome');
    }

}
