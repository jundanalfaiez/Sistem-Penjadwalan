<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BlankController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Menghitung jumlah admin dan superadmin
        $jumlah_admin = User::where('role', 'admin')->count();
        $jumlah_superadmin = User::where('role', 'superadmin')->count();

        // Mengirimkan data ke view
        return view('blank', compact('jumlah_admin', 'jumlah_superadmin'));
    }
}
