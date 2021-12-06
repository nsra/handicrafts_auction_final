<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class Craftsman
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
        if ($role === "Craftsman") 
            return $next($request);
        else
            return redirect()->back()->with('error', 'You are not allowed as a craftsman to bidding! Create a Buyer account to order products.');
    }
}
