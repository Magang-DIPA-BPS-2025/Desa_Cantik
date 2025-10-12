<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suratketus extends Model
{

    protected $table = 'suratketuses';
    protected $fillable = [
        'nik',
        'no_hp',
        'email',
        'nama_usaha',
        'alamat_usaha',
        'qr_code',
    ];

    public function penduduk()
    {
        return $this->belongsTo(DataPenduduk::class, 'nik', 'nik');
    }
}
