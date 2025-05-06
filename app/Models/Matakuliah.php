<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'type_matakuliah',
        'semester',
        'sks',
        'created_by',
    ];
    
}
