<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sktm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'nama', 'alamat', 'pekerjaan', 'agama', 
        'no_hp', 'email', 'tanggal_dibuat', 'nomor_surat', 'status_verifikasi'
    ];

    protected $attributes = [
        'status_verifikasi' => 'Belum Diverifikasi',
    ];
}