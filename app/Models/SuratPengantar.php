<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    protected $table = 'surat_pengantars';

    protected $fillable = [
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'no_hp',
        'email',
        'alamat',
        'usaha',
        'jenis_surat',
        'nomor_surat',
        'tanggal_dibuat',
        'status',
        'keterangan',
        'qr_code',
    ];

    public function penduduk()
    {
        return $this->belongsTo(DataPenduduk::class, 'nik', 'nik');
    }
}
