<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataJadwalController extends Controller
{
    public function create()
{
    $matakuliahList = Matakuliah::all();
    $dosenList = Dosen::all();
    $periodeList = Periode::all();

    return view('datajadwal.create', compact('matakuliahList', 'dosenList', 'periodeList'));
}

}
