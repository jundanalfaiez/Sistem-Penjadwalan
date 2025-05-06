<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;

    protected $table = 'haris'; // Sesuaikan nama tabel di sini
    protected $fillable = ['kode_hari', 'hari', 'created_by',];
}

