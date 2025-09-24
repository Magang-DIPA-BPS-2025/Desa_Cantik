<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris'; 
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_kategori');
    }

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id');
    }
}
