<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        $role = Auth::check() ? Auth::user()->role->name : "";
        if ($role === "Admin")
            return $next($request);
        else
            return redirect()->back()->with('error', 'You Are not Allowed to access Admin control Panel!');
    }
}
