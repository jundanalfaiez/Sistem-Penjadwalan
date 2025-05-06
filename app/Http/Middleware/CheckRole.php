<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    // public function handle($request, Closure $next, $role)
    
    // {
    //     if (Auth::check() && Auth::user()->role !== $role) {
    //         return redirect()->route('matakuliah.index')->with('error', 'Unauthorized access!');
    //     }

    //     return $next($request);
    // }
    public function handle($request, Closure $next)
{
    if (Auth::check() && Auth::user()->role === 'superadmin') {
        return redirect()->route('basic.index');
    }

    return $next($request);
}
}
