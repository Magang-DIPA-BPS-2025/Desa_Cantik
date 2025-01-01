<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'modul_id',
        'deskripsi',
        'gambar',
        'status',
    ];

    public function modul()
    {
        return $this->hasMany(modul::class,'id', 'modul_id');
    }
}
