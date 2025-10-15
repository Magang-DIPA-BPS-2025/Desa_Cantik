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
        'kategori',
        'deskripsi',
        'harga',
        'rating',
        'wa',
        'lokasi',
        'pemilik',
        'latitude',
        'longitude',
        'alamat_lengkap',
        'jam_buka',
        'jam_tutup',
    ];

    protected $casts = [
        'harga'  => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    /**
     * RELASI RATING
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'belanja_desa_id');
    }

    /**
     * Hitung rating rata-rata
     */
    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    /**
     * Hitung jumlah rating
     */
    public function ratingCount()
    {
        return $this->ratings()->count();
    }

    /**
     * SCOPE UNTUK DATA PETA
     */
    public function scopeWithLokasi($query)
    {
        return $query->whereNotNull('latitude')->whereNotNull('longitude');
    }

    /**
     * MUTATOR & ACCESSOR
     */
    public function getJamOperasionalAttribute()
    {
        if ($this->jam_buka && $this->jam_tutup) {
            return date('H:i', strtotime($this->jam_buka)) . ' - ' . date('H:i', strtotime($this->jam_tutup));
        }
        return '24 Jam';
    }
}