<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jam;

class JamController extends Controller
{
    public function index()
    {
        $jams = Jam::where('created_by', auth()->id())->get(); // Hanya data yang dibuat oleh admin saat ini
        return view('jam.index', compact('jams'));
    }

    public function create()
    {
        return view('jam.create'); // Tampilkan halaman untuk membuat data jam baru
    }

    public function store(Request $request)
    {
        // Validasi data dari $request
        $validatedData = $request->validate([
            'kode_jam' => 'required|string|max:255',
            'jamnya' => 'required|string|max:255',
        ]);

        // Tambahkan kolom `created_by` saat menyimpan
        Jam::create([
            'kode_jam' => $validatedData['kode_jam'],
            'jamnya' => $validatedData['jamnya'],
            'created_by' => auth()->id(), // Admin yang membuat data
        ]);

        return redirect()->route('jam.index')->with('success', 'Jam berhasil dibuat!');
    }

    public function show($id)
    {
        $jam = Jam::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
        return view('jam.show', compact('jam'));
    }

    public function edit($id)
    {
        $jam = Jam::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
        return view('jam.edit', compact('jam'));
    }

    public function update(Request $request, $id)
    {
        $jam = Jam::where('id', $id)->where('created_by', auth()->id())->firstOrFail();

        $validatedData = $request->validate([
            'kode_jam' => 'required|string|max:255',
            'jamnya' => 'required|string|max:255',
        ]);

        $jam->update($validatedData);

        return redirect()->route('jam.index')->with('success', 'Jam berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jam = Jam::where('id', $id)->where('created_by', auth()->id())->firstOrFail();

        $jam->delete();

        return redirect()->route('jam.index')->with('success', 'Jam berhasil dihapus!');
    }
}
