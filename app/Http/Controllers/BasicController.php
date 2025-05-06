<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data pengguna berdasarkan role
        $users = auth()->user()->isSuperAdmin()
            ? User::paginate(10) // Super Admin melihat semua data
            : User::where('created_by', auth()->id())->paginate(10); // Admin hanya melihat data yang dia buat

        return view('basic.list', [
            'title' => 'Data User',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('basic.create', [
            'title' => 'Add New User',
            'roles' => ['admin'], // Hanya bisa membuat role admin
        ]);
    }


    public function store(AddUserRequest $request)
    {
        // Buat pengguna baru dengan mencatat siapa yang membuatnya
        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_by' => auth()->id(), // Menyimpan ID pembuat user
        ]);

        return redirect()->route('basic.index')->with('message', 'User added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    
        // Validasi akses edit (Super Admin atau Admin yang membuat user ini)
        if (auth()->user()->isSuperAdmin() || $user->created_by == auth()->id()) {
            return view('basic.edit', [
                'title' => 'Edit User',
                'user' => $user,
                'roles' => ['superadmin','admin'], // bisa mengedit role super admin dan admin
            ]);
        }

        return redirect()->route('basic.index')->with('warning', 'You do not have permission to edit this user.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, User $user)
    {
        // $a = User::find(2);
        // $a->delete();
        // Pastikan hanya pembuat user atau Super Admin yang dapat mengedit
        if (auth()->user()->isSuperAdmin() || $user->created_by == auth()->id()) {
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('basic.index')->with('message', 'User updated successfully!');
        }

        return redirect()->route('basic.index')->with('warning', 'You do not have permission to update this user.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Validasi: Jangan biarkan pengguna menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->route('basic.index')->with('warning', 'Cannot delete yourself!');
        }

        // Hanya Super Admin yang bisa menghapus user
        if (auth()->user()->isSuperAdmin()) {
            $user->delete();
            return redirect()->route('basic.index')->with('message', 'User deleted successfully!');
        }

        return redirect()->route('basic.index')->with('warning', 'You do not have permission to delete this user.');
    }
}
