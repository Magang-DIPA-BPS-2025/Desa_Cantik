<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{

    protected $table = 'jenis_surats';
    protected $fillable = [
        'nama_surat',
    ];
}



