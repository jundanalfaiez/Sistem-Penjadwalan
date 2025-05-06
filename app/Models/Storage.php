<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = ['user_id', 'data'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
