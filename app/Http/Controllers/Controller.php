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
        $this->middleware('auth');
    }

    public function userLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }

    public function profile(){
        if($this->middleware('craftsman')) 
            return redirect()->route('craftsman.profile');
        else if($this->middleware('buyer')) 
                return redirect()->route('buyer.profile');
        else 
            return redirect()->back();
    }
}
