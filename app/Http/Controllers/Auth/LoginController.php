<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function multiguardLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (User::where('email', $request->email )->exists()) {
            $existing_user= User::where('email', $request->email )->first();
            if ($existing_user->is_delete) 
                return redirect()->back()->with('error', 'You are blocked');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            $user_role = User::where('email', $request->email)->first()->role->name;
            if ($user_role === "Admin") {
                return redirect()->route('admin_dashboard');
            } else if ($user_role === "Buyer") {
                return redirect()->route('buyer_dashboard');
            } else if ($user_role === "Craftsman") {
                return redirect()->route('craftsman_dashboard');
            }
        } else
            return redirect()->back()->with('error', 'error email or password');
    }
}
