<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'nama', 'alamat', 'pekerjaan', 
        'nama_usaha', 'alamat_usaha', 'no_hp', 'email', 'tanggal_dibuat'
    ];
}

