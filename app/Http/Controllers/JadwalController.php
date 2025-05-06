<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Models\Periode;

class JadwalController extends Controller
{
    public function deleteAll()
    {
        try {
            // Hapus semua data jadwal yang dibuat oleh admin saat ini
            Jadwal::where('created_by', auth()->id())->delete();

            return redirect()->route('jadwal.index')->with('message', 'Semua jadwal berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jadwal.index')->with('error', 'Gagal menghapus jadwal: ' . $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $search = $request->get('search'); // Ambil query pencarian

        $jadwals = Jadwal::with(['matakuliah', 'dosen', 'periode'])
            ->where('created_by', auth()->id()) // Hanya data yang dibuat oleh admin saat ini
            ->when($search, function ($query, $search) {
                return $query->whereHas('matakuliah', function ($q) use ($search) {
                    $q->where('nama_matakuliah', 'like', '%' . $search . '%');
                });
            })
            ->paginate(10);

        return view('jadwal.index', [
            'title' => 'Jadwal',
            'jadwals' => $jadwals
        ]);
    }

    public function create()
    {
        // Hanya ambil data yang dibuat oleh admin saat ini
        $matakuliahs = Matakuliah::where('created_by', auth()->id())->get();
        $dosens = Dosen::where('created_by', auth()->id())->get();
        $periodes = Periode::where('created_by', auth()->id())->get();

        return view('jadwal.create', compact('matakuliahs', 'dosens', 'periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_id' => 'required|exists:matakuliahs,id',
            'dosen_id' => 'required|exists:dosens,id',
            'periode_id' => 'required|exists:periodes,id',
            'jumlah_mhs' => 'required|integer|min:1',
        ]);

        // Tambahkan kolom `created_by`
        Jadwal::create([
            'matakuliah_id' => $request->matakuliah_id,
            'dosen_id' => $request->dosen_id,
            'periode_id' => $request->periode_id,
            'jumlah_mhs' => $request->jumlah_mhs,
            'created_by' => auth()->id(), // Admin pembuat jadwal
        ]);

        return redirect()->route('jadwal.index')->with('message', 'Jadwal berhasil ditambahkan!');
    }

    public function edit(Jadwal $jadwal)
    {
        // Pastikan hanya admin yang membuat data bisa mengedit
        if ($jadwal->created_by !== auth()->id()) {
            return redirect()->route('jadwal.index')->with('error', 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        // Hanya ambil data yang dibuat oleh admin saat ini
        $matakuliahs = Matakuliah::where('created_by', auth()->id())->get();
        $dosens = Dosen::where('created_by', auth()->id())->get();
        $periodes = Periode::where('created_by', auth()->id())->get();

        return view('jadwal.edit', compact('jadwal', 'matakuliahs', 'dosens', 'periodes'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        // Pastikan hanya admin yang membuat data bisa mengubah
        if ($jadwal->created_by !== auth()->id()) {
            return redirect()->route('jadwal.index')->with('error', 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        $request->validate([
            'matakuliah_id' => 'required|exists:matakuliahs,id',
            'dosen_id' => 'required|exists:dosens,id',
            'periode_id' => 'required|exists:periodes,id',
            'jumlah_mhs' => 'required|integer|min:1',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('message', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(Jadwal $jadwal)
    {
        // Pastikan hanya admin yang membuat data bisa menghapus
        if ($jadwal->created_by !== auth()->id()) {
            return redirect()->route('jadwal.index')->with('error', 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('message', 'Jadwal berhasil dihapus!');
    }
}
