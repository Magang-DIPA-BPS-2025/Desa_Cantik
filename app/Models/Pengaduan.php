<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduans';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'alamat',
        'judul',
        'deskripsi',
        'file',
        'status',
        'anonymous',
    ];
}       
