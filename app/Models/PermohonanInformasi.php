<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanInformasi extends Model
{
    use HasFactory;

    protected $table = 'permohonan_informasi';

    protected $fillable = [
        'nama',
        'nomor_telepon',
        'asal_instansi',
        'alamat_email',
        'permohonan',
        'file_path',
        'status',
    ];
}
