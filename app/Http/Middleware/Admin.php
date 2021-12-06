<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = Auth::check() ? Auth::user()->role->name : "";
        if ($role === "Admin") 
            return $next($request);
        else
            return redirect()->back()->with('error', 'You Are not Allowed to access Admin control Panel!');  
        }
}
