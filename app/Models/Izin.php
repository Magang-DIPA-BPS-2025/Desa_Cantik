<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'nama', 'alamat', 'pekerjaan', 'no_hp', 'email',
        'hari', 'tanggal', 'tempat', 'jenis_acara', 'tanggal_dibuat',
        'status_verifikasi', 'nomor_surat'
    ];

    protected $attributes = [
        'status_verifikasi' => 'Belum Diverifikasi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_dibuat' => 'date',
    ];
}