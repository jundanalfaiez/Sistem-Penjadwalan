<?php 

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        // Menampilkan data periode hanya untuk admin yang login
        $periodes = Periode::where('created_by', auth()->id())->get();
        return view('periode.index', compact('periodes'));
    }

    public function create()
    {
        return view('periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Menambahkan `created_by` saat menyimpan data periode
        Periode::create([
            'name' => $request->name,
            'created_by' => auth()->id(), // Menyimpan ID admin pembuat
        ]);

        return redirect()->route('periode.index')->with('success', 'Data periode berhasil disimpan!');
    }

    public function edit(Periode $periode)
    {
        // Pastikan data hanya dapat diakses oleh admin yang membuatnya
        if ($periode->created_by !== auth()->id()) {
            return redirect()->route('periode.index')->with('error', 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        return view('periode.edit', compact('periode'));
    }

    public function update(Request $request, Periode $periode)
    {
        // Pastikan data hanya dapat diakses oleh admin yang membuatnya
        if ($periode->created_by !== auth()->id()) {
            return redirect()->route('periode.index')->with('error', 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $periode->update([
            'name' => $request->name,
        ]);

        return redirect()->route('periode.index')->with('success', 'Data periode berhasil diperbarui!');
    }

    public function destroy(Periode $periode)
    {
        // Pastikan data hanya dapat diakses oleh admin yang membuatnya
        if ($periode->created_by !== auth()->id()) {
            return redirect()->route('periode.index')->with('error', 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        $periode->delete();

        return redirect()->route('periode.index')->with('success', 'Data periode berhasil dihapus!');
    }
}
