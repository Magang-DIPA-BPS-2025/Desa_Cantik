<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';

    protected $fillable = [
        'nama_kegiatan',
        'waktu_pelaksanaan',
        'deskripsi',
        'kategori',
        'foto',
    ];

    protected $casts = [
        'waktu_pelaksanaan' => 'datetime',
    ];

    public function setKategoriAttribute($value)
    {
        if (!is_string($value)) {
            $this->attributes['kategori'] = $value;
            return;
        }
        $normalized = trim($value);
        // Normalize common variants to canonical values used by filters/UI
        $map = [
            'umum' => 'Umum',
            'rapat' => 'Rapat',
            'pelatihan' => 'Pelatihan',
            'sosialisasi' => 'Sosialisasi',
            'acara resmi' => 'Acara Resmi',
            'internal' => 'Internal',
            'eksternal' => 'Eksternal',
        ];
        $key = mb_strtolower($normalized);
        $this->attributes['kategori'] = $map[$key] ?? $normalized;
    }
}
