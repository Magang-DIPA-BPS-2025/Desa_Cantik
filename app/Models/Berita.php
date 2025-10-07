<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita_desa';

    protected $fillable = [
        'id_kategori',
        'foto',
        'judul',
        'deskripsi_singkat',
        'dilihat',
        'tanggal_event',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
