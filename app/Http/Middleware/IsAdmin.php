<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        // Pastikan pengguna sudah login dan memiliki peran 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Jika tidak, arahkan kembali ke halaman login dengan pesan warning
            return redirect()->route('login')->with('warning', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
