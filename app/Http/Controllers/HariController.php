<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use Illuminate\Http\Request;

class HariController extends Controller
{
    public function index()
    {
        // Hanya menampilkan hari yang dibuat oleh admin yang sedang login, diurutkan berdasarkan kode_hari
        $hari = Hari::where('created_by', auth()->id())->orderBy('kode_hari')->get();
        return view('hari.index', compact('hari'));
    }

    public function create()
    {
        return view('hari.create'); // Tampilkan form untuk menambahkan hari baru
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_hari' => 'required|max:10|unique:haris,kode_hari,NULL,id,created_by,' . auth()->id(),
            'hari' => 'required|max:50',
        ]);

        try {
            Hari::create([
                'kode_hari' => $request->kode_hari,
                'hari' => $request->hari,
                'created_by' => auth()->id(), // Simpan admin yang membuat data
            ]);

            return redirect()->route('hari.index')->with('success', 'Hari berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('hari.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Pastikan hanya data yang dibuat oleh admin saat ini yang dapat diedit
        $hari = Hari::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
        return view('hari.edit', compact('hari'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_hari' => 'required|max:10|unique:haris,kode_hari,' . $id . ',id,created_by,' . auth()->id(),
            'hari' => 'required|max:50',
        ]);

        try {
            $hari = Hari::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
            $hari->update([
                'kode_hari' => $request->kode_hari,
                'hari' => $request->hari,
            ]);

            return redirect()->route('hari.index')->with('success', 'Hari berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('hari.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $hari = Hari::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
            $hari->delete();

            return redirect()->route('hari.index')->with('success', 'Hari berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('hari.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
