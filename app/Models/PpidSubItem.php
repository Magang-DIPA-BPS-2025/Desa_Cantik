<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpidSubItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'ppid_id',
        'judul',
        'deskripsi',
        'file',
    ];

    // Relasi: sub-item milik satu PPID
    public function ppid()
    {
        return $this->belongsTo(Ppid::class, 'ppid_id');
    }
}
