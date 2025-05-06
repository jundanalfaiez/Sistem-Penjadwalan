<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        // Ambil ID pengguna yang sedang login
        $userId = auth()->id();

        // Hitung data berdasarkan created_by yang sesuai dengan ID pengguna
        $jumlah_dosen = Dosen::where('created_by', $userId)->count();
        $jumlah_matakuliah = Matakuliah::where('created_by', $userId)->count();
        $jumlah_ruangan = Ruangan::where('created_by', $userId)->count();

        // Kirim data ke view
        return view('home', compact('jumlah_dosen', 'jumlah_matakuliah', 'jumlah_ruangan'));
    }
}
