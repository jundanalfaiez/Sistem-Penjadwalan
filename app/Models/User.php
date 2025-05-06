<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;
    // cek apakah useradmin
    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }
    // protected $fillable = ['name', 'last_name', 'email', 'password', 'role'];
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'role', 'created_by',
    ];
    protected $hidden = ['password', 'remember_token'];

    // Relasi ke model Storage
    public function storage()
    {
        return $this->hasOne(Storage::class);
    }

    // Cek apakah pengguna adalah super admin
    // public function isSuperAdmin()
    // {
    //     return $this->role === 'Super Admin';
    // }
}
