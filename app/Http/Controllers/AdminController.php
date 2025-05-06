<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Hanya Super Admin dapat melihat daftar admin
        if (auth()->user() && auth()->user()->isSuperAdmin()) {
            $admins = User::where('role', 'admin')->get();
            return view('basic.index', compact('admins'));
        }

        return redirect()->route('basic')->with('error', 'Access denied.');
    }

    public function create()
    {
        return view('basic.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Buat admin baru
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        // Inisialisasi penyimpanan kosong untuk admin
        $admin->storage()->create(['data' => json_encode([])]);

        return redirect()->route('basic.index')->with('message', 'Admin successfully created.');
    }

    public function destroy(User $user)
    {
        if (auth()->user() && auth()->user()->isSuperAdmin()) {
            $user->delete();
            return redirect()->route('basic.index')->with('message', 'Admin deleted.');
        }

        return redirect()->route('basic')->with('error', 'Access denied.');
    }
}

