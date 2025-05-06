<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waktu;

class WaktuController extends Controller
{
    public function index()
    {
        $waktus = Waktu::where('created_by', auth()->id())->get();
        return view('waktu.index', compact('waktus'));
    }

    public function create()
    {
        return view('waktu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Waktu::create([
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('waktu.index')->with('message', 'Waktu berhasil ditambahkan!');
    }

    public function edit(Waktu $waktu)
    {
        if ($waktu->created_by !== auth()->id()) {
            return redirect()->route('waktu.index')->with('error', 'Tidak memiliki akses!');
        }

        return view('waktu.edit', compact('waktu'));
    }

    public function update(Request $request, Waktu $waktu)
    {
        if ($waktu->created_by !== auth()->id()) {
            return redirect()->route('waktu.index')->with('error', 'Tidak memiliki akses!');
        }

        $request->validate([
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $waktu->update([
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('waktu.index')->with('message', 'Waktu berhasil diperbarui!');
    }

    public function destroy(Waktu $waktu)
    {
        if ($waktu->created_by !== auth()->id()) {
            return redirect()->route('waktu.index')->with('error', 'Tidak memiliki akses!');
        }

        $waktu->delete();
        return redirect()->route('waktu.index')->with('message', 'Waktu berhasil dihapus!');
    }
}
