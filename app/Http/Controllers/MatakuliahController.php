<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliahs = Matakuliah::where('created_by', auth()->id())->paginate(10);
        return view('matakuliah.index', compact('matakuliahs'));
        // $matakuliahs = Matakuliah::paginate(10); // Menampilkan 10 item per halaman
        // return view('matakuliah.index', compact('matakuliahs'));
    }
    
    
    // public function create()
    // {
    //     // Tampilkan view form create
    //     return view('matakuliah.create');
    // }
    public function store(Request $request)
    {
        // Validasi data dari $request
        $validatedData = $request->validate([
            'kode_matakuliah' => 'required|unique:matakuliahs,kode_matakuliah', // Menambahkan validasi unique untuk kode_matakuliah
            'nama_matakuliah' => 'required',
            'type_matakuliah' => 'required',
            'semester' => 'required',
            'sks' => 'required|integer', // Pastikan sks adalah integer
        ]);
    
        // Simpan data ke database menggunakan validated data
        Matakuliah::create([
            'kode_matakuliah' => $validatedData['kode_matakuliah'],
            'nama_matakuliah' => $validatedData['nama_matakuliah'],
            'semester' => $validatedData['semester'],
            'sks' => $validatedData['sks'],
            'type_matakuliah' => $validatedData['type_matakuliah'],
            'created_by' => auth()->id(),
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('matakuliah.index')->with('success', 'Matakuliah berhasil dibuat!');
    }
    

    public function create()
{
    $typeMatakuliahOptions = ['Teori', 'Praktikum', 'Teori dan Praktikum'];
    return view('matakuliah.create', compact('typeMatakuliahOptions'));
}

    // Fungsi untuk menampilkan detail Matakuliah
    public function show($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('show.index', compact('matakuliah'));
    }
   
    

    public function edit($id)
    {
        $matakuliah = Matakuliah::where('id', $id)->where('created_by', auth()->id())->firstOrFail();
        $typeMatakuliahOptions = ['Teori', 'Praktikum', 'Teori dan Praktikum'];
    
        return view('matakuliah.edit', compact('matakuliah', 'typeMatakuliahOptions'));
    }
    
    public function update(Request $request, $id)
    {
        $matakuliah = Matakuliah::where('id', $id)->where('created_by', auth()->id())->firstOrFail();

        $request->validate([
            'kode_matakuliah' => 'required|string',
            'nama_matakuliah' => 'required|string',
            'semester' => 'required|integer',
            'sks' => 'required|integer',
            'type_matakuliah' => 'required|string',
        ]);
    
        $matakuliah = Matakuliah::findOrFail($id);
    
        $matakuliah->update([
            'kode_matakuliah' => $request->kode_matakuliah,
            'nama_matakuliah' => $request->nama_matakuliah,
            'semester' => $request->semester,
            'sks' => $request->sks,
            'type_matakuliah' => $request->type_matakuliah,
        ]);
    
        return redirect()->route('matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui!');
    }
    

public function destroy($id)
{
    // Temukan data Matakuliah berdasarkan ID
    $matakuliah = Matakuliah::where('id', $id)->where('created_by', auth()->id())->firstOrFail();

    // Hapus data Matakuliah
    $matakuliah->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('matakuliah.index')->with('success', 'Data Matakuliah berhasil dihapus!');
}


}
