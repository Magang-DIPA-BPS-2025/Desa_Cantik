<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'belanja_desa_id',
        'user_id',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Relasi ke tabel BelanjaDesa
     */
    public function belanja()
    {
        return $this->belongsTo(BelanjaDesa::class, 'belanja_desa_id');
    }

    /**
     * Relasi ke tabel User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}