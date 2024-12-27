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
        'guru_id',
        'gender',
        'agama',
        'tgl_lahir',
        'alamat',
        'wali',
        'no_hp_wali',
        'pas_foto',
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id','kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class,'id','guru_id');
    }
}
