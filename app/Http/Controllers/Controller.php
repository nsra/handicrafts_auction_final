<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {

    }

    public function userLogout()
    {
        if(Auth::user()){
            Auth::logout();
            Session::flush();
            return redirect()->route('home');
        }
        else 
            return redirect()->back();
    }

    public function profile(){
        if(Auth::user() && Auth::user()->role_id == 2)
            return redirect()->route('craftsman.profile');
        else if(Auth::user() && Auth::user()->role_id == 3) 
                return redirect()->route('buyer.profile');
        else 
            return redirect()->back();
    }
}
