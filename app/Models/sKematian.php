<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sKematian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik','nama','alamat','tempat_lahir','tanggal_lahir','jenis_kelamin','pekerjaan',
        'no_hp','email','nomor_kk','tanggal_kematian','tanggal_dibuat'
    ];
}

