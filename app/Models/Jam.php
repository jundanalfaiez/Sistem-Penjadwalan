<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_jam',
        'jamnya',
        'created_by',
    ];
}
