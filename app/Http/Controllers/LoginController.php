<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect users after login based on their role.
     */
    protected function authenticated($request, $user)
    {
        if ($user->role === 'superadmin') {
            return redirect()->route('basic.index')->with('message', 'Anda dialihkan ke User Management!');
        } elseif ($user->role === 'admin') {
            return redirect()->route('home')->with('message', 'Selamat datang di Dashboard!');
        }
    
        return redirect('/'); // Jika ada role lain, bisa diarahkan ke halaman default
    }
}
