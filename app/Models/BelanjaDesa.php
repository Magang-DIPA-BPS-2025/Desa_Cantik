<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BelanjaDesa extends Model
{
    use HasFactory;

    protected $table = 'belanja_desas';

    protected $fillable = [
        'foto',
        'judul',
        'harga',
        'rating',
        'wa',
    ];

    protected $dates = ['tanggal'];
}
