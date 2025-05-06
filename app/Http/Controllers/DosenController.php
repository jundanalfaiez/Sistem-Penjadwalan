<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('created_by', auth()->id())->get(); // Hanya data milik admin yang sedang login
    
        return view('dosen.index')->with('dosen', $dosen);
    }
    
    public function create()
{
    return view('dosen.create'); // Tampilkan halaman untuk membuat data dosen baru
}

public function store(Request $request)
{
    // Validasi data yang diterima dari form
    $validatedData = $request->validate([
        'nip' => 'required|unique:dosens,nip|numeric',
        'nama' => 'required',
        // Sesuaikan aturan validasi lainnya sesuai kebutuhan
    ]);

    Dosen::create([
        'nip' => $validatedData['nip'],
        'nama' => $validatedData['nama'],
        'created_by' => auth()->id(), // Set admin yang membuat data
    ]);


    // Redirect ke halaman index atau halaman lain dengan pesan sukses
    return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
}

public function edit($id)
{
    $dosen = Dosen::where('id', $id)->where('created_by', auth()->id())->firstOrFail(); // Validasi created_by

    if (!$dosen) {
        return redirect()->route('dosen.index')->with('warning', 'Data dosen tidak ditemukan.');
    }

    return view('dosen.edit', compact('dosen'));
}

public function update(Request $request, $id)
{
    $dosen = Dosen::where('id', $id)->where('created_by', auth()->id())->firstOrFail(); // Validasi created_by

    if (!$dosen) {
        return redirect()->route('dosen.index')->with('warning', 'Data dosen tidak ditemukan.');
    }

    $validatedData = $request->validate([
        'nip' => 'required',
        'nama' => 'required',
        // Tambahkan validasi lainnya sesuai kebutuhan
    ]);

    $dosen->update($validatedData);

    return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
}

public function destroy($id)
{
    
    $dosen = Dosen::where('id', $id)->where('created_by', auth()->id())->firstOrFail(); // Validasi created_by

    // Hapus data Matakuliah
    $dosen->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('dosen.index')->with('success', 'Data Matakuliah berhasil dihapus!');
}

}
