<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        // Hanya menampilkan data ruangan yang dibuat oleh admin yang sedang login
        $ruangan = Ruangan::where('created_by', auth()->id())->get();
        return view('ruangan.index', compact('ruangan'));
    }

    public function create()
    {
        return response(view('ruangan.create'));
    }

    public function store(Request $request)
    {
        // Validasi form
        $this->validate($request, [
            'kode_ruangan'     => 'required',
            'nama_ruangan'     => 'required',
            'kapasitas_ruangan' => 'required|integer',
            'type_ruangan'      => 'required',
        ]);

        // Membuat data ruangan baru dengan `created_by`
        Ruangan::create([
            'kode_ruangan'      => $request->kode_ruangan,
            'nama_ruangan'      => $request->nama_ruangan,
            'kapasitas_ruangan' => $request->kapasitas_ruangan,
            'type_ruangan'      => $request->type_ruangan,
            'created_by'        => auth()->id(), // Menyimpan ID admin pembuat
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ruangan.index')->with(['success' => 'Data Ruangan Berhasil Disimpan!']);
    }

    public function edit($id)
    {
        // Mengambil data ruangan berdasarkan ID, hanya jika dibuat oleh admin yang login
        $ruangan = Ruangan::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        // Mengambil data ruangan berdasarkan ID, hanya jika dibuat oleh admin yang login
        $ruangan = Ruangan::where('id', $id)->where('created_by', auth()->id())->firstOrFail();

        // Validasi dan update data
        $request->validate([
            'kode_ruangan'      => 'required',
            'nama_ruangan'      => 'required',
            'kapasitas_ruangan' => 'required|integer',
            'type_ruangan'      => 'required',
        ]);

        $ruangan->update([
            'kode_ruangan'      => $request->kode_ruangan,
            'nama_ruangan'      => $request->nama_ruangan,
            'kapasitas_ruangan' => $request->kapasitas_ruangan,
            'type_ruangan'      => $request->type_ruangan,
        ]);

        return redirect()->route('ruangan.index')->with('success', 'Data Ruangan Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        // Menghapus ruangan hanya jika dibuat oleh admin yang login
        $ruangan = Ruangan::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
        $ruangan->delete();

        return redirect()->route('ruangan.index')->with('success', 'Data Ruangan Berhasil Dihapus');
    }

    public function show($id)
    {
        // Mengambil data ruangan berdasarkan ID, hanya jika dibuat oleh admin yang login
        $ruangan = Ruangan::where('id', $id)->where('created_by', auth()->id())->firstOrFail();

        return view('ruangan.show', compact('ruangan'));
    }
}
