<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'id',
        'kode_ruangan',
        'nama_ruangan',
        'kapasitas_ruangan',
        'type_ruangan',
        'created_by',

    ];
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class); // Ruangan memiliki banyak Jadwal
    }
    
}
