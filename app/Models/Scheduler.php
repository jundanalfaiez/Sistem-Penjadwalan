<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    use HasFactory;

    // Tabel yang digunakan (opsional jika menggunakan nama tabel khusus)
    protected $table = 'schedulers';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'jadwal_id',
        'ruangan_id',
        'hari_id',
        'waktu_id',
        'created_by',
    ];

    // Relasi ke model Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    // Relasi ke model Ruangan
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    // Relasi ke model Hari
    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id');
    }

    // Relasi ke model Jam
    public function waktu()
    {
        return $this->belongsTo(Waktu::class, 'waktu_id');
    }
}
