<?php

namespace App\Http\Controllers\Buyer;
use App\Http\Controllers\Controller;
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
        $this->middleware('buyer');
    }

    public function buyerDashboard()
    {
        return view('app.index');
    }

    public function profile()
    {
        $user= Auth::user();
        return view('app.buyer.profile', compact('user'));
    }
}
