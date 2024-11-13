<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kelas_id',
        'tgl_lahir',
        'alamat',
        'wali',
    ];
    public function kelas()
    {
        return $this->belongsTo(kelas::class,'id','kelas_id');
    }
}
