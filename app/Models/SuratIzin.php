<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratIzin extends Model
{

    protected $table = 'surat_izins'; 
    protected $fillable = [
        'surat_id',
        'hari',
        'tanggal',
        'tempat',
        'jenis_acara',
    ];
}
