<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenduduk extends Model
{


    protected $table = 'data_penduduks';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nokk',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'dusun',
        'rt',
        'rw',
        'keldesa',
        'kecamatan',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'pendidikan',
        'disabilitas',
        'jenis_kelamin'
    ];
}
