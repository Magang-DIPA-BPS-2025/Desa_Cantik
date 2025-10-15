<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppid extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file',
        'tanggal',
        'kategori',
    ];

    // Cast tanggal menjadi Carbon instance
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    // Relasi: satu PPID punya banyak sub-item
    public function subItems()
    {
        return $this->hasMany(PpidSubItem::class, 'ppid_id');
    }
}
