<?php

namespace App\Http\Controllers\Craftsman;
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
        $this->middleware('craftsman');
    }

    public function craftsmanDashboard()
    {
        return view('app.craftsman.home');
    }

    public function profile()
    {
        $user= Auth::user();
        return view('app.craftsman.profile', compact('user'));
    }
}
