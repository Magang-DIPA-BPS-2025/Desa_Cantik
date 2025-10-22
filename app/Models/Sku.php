<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    use HasFactory;

    protected $table = 'skus';

    protected $fillable = [
        'nik',
        'nama', 
        'alamat',
        'pekerjaan',
        'nama_usaha',
        'alamat_usaha',
        'no_hp',
        'email',
        'keperluan',
        'status_verifikasi',
        'nomor_surat',
        'tanggal_lahir',
        'tanggal_dibuat',
    ];

    protected $attributes = [
        'status_verifikasi' => 'Belum Diverifikasi',
    ];
}