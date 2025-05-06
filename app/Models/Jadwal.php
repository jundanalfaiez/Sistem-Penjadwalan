<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari_id',
        'matakuliah_id',
        'dosen_id',
        'periode_id',
        'waktu_id',
        'jumlah_mhs',
        'created_by',
    ];


    
    // Relasi ke model Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    // Relasi ke model Hari
    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    // Relasi ke model Jam
    public function jam()
    {
        return $this->belongsTo(Jam::class);
    }

    // Relasi ke model Matakuliah
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    // Relasi ke model Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    // Relasi ke model Periode
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    // relasi ke model waktu
    public function waktu()
    {
        return $this->belongsTo(Waktu::class, 'waktu_id');
    }
}
