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

   
    protected $casts = [
        'tanggal' => 'datetime',
    ];

  
    public function subItems()
    {
        return $this->hasMany(PpidSubItem::class, 'ppid_id');
    }
}
