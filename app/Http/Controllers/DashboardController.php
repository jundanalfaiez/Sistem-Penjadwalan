<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $adminCount = User::where('role', 'admin')->count();
        $superAdminCount = User::where('role', 'superadmin')->count();

        return view('dashboard', compact('adminCount', 'superAdminCount'))->with('title', 'Dashboard');
    }
}
