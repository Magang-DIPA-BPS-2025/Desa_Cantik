<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{

    protected $table = 'surats';
    protected $fillable = [
        'penduduk_id',
        'jenis_surat_id',
        'nomor_surat',
        'tanggal_dibuat',
        'status',
        'keterangan',
        // snapshot fields from DataPenduduk
        'nik',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        // qr code path
        'qr_code',
    ];

    public function penduduk()
    {
        return $this->belongsTo(DataPenduduk::class, 'penduduk_id');
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }
}
