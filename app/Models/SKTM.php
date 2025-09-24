<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKTM extends Model
{

    protected $table = 's_k_t_m_s'; 
    protected $fillable = [
        'surat_id',
        'pekerjaan',
        'penghasilan',
    ];
}
