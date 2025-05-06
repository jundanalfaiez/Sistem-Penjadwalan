<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            switch ($role) {
                case 'superadmin':
                    return redirect()->route('basic.index'); // Superadmin diarahkan ke halaman User Management
                case 'admin':
                    return redirect()->route('home'); // Admin diarahkan ke Dashboard
                default:
                    return redirect('/'); // Default halaman
            }
        }

        return $next($request);
    }
}
