<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Akun extends Authenticatable
{
    use HasFactory;

    protected $table = 'akuns'; // nama tabel

    protected $fillable = [
        'name',
        'username',
        'role',     // otomatis 'admin'
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
