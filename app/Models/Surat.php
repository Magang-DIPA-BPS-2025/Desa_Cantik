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
    ];

    public function penduduk()
    {
        return $this->belongsTo(DataPenduduk::class, 'penduduk_id');
    }
}
