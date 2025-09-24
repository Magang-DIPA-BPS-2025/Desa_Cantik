<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemerintahDesa extends Model
{

    protected $table = 'pemerintah_desas'; 
    protected $fillable = [
        'nama',
        'jabatan',
        'tupoksi',
        'foto',
    ];
}
