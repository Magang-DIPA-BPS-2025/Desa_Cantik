<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    use HasFactory;

    protected $table = 'buku_tamus';

    protected $fillable = [
        'nama',
        'asal',
        'jabatan',
        'keperluan',
        'tanda_tangan',
        'waktu_kunjungan'
    ];
}