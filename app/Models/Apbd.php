<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbd extends Model
{
    use HasFactory;

    protected $table = 'apbd_desa';

    protected $fillable = [
        'tahun',
        'total_pendapatan',
        'total_belanja',
        'penerimaan',
        'pengeluaran',
        'surplus_defisit',
        'pendapatan_pad',
        'pendapatan_pad_persen',
        'pendapatan_transfer',
        'pendapatan_transfer_persen',
        'pendapatan_lain',
        'pendapatan_lain_persen',
        'belanja_pemerintahan',
        'belanja_pemerintahan_persen',
        'belanja_pembangunan',
        'belanja_pembangunan_persen',
        'belanja_pembinaan',
        'belanja_pembinaan_persen',
        'belanja_pemberdayaan',
        'belanja_pemberdayaan_persen',
        'belanja_bencana',
        'belanja_bencana_persen',
        'pembiayaan_penerimaan',
        'pembiayaan_penerimaan_persen',
        'pembiayaan_pengeluaran',
        'pembiayaan_pengeluaran_persen',
    ];

    // Accessor untuk menghitung persentase otomatis jika tidak ada di database
    public function getPendapatanPadPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_pendapatan > 0) {
            return round(($this->pendapatan_pad / $this->total_pendapatan) * 100, 2);
        }

        return 0;
    }

    public function getPendapatanTransferPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_pendapatan > 0) {
            return round(($this->pendapatan_transfer / $this->total_pendapatan) * 100, 2);
        }

        return 0;
    }

    public function getPendapatanLainPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_pendapatan > 0) {
            return round(($this->pendapatan_lain / $this->total_pendapatan) * 100, 2);
        }

        return 0;
    }

    public function getBelanjaPemerintahanPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_belanja > 0) {
            return round(($this->belanja_pemerintahan / $this->total_belanja) * 100, 2);
        }

        return 0;
    }

    public function getBelanjaPembangunanPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_belanja > 0) {
            return round(($this->belanja_pembangunan / $this->total_belanja) * 100, 2);
        }

        return 0;
    }

    public function getBelanjaPembinaanPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_belanja > 0) {
            return round(($this->belanja_pembinaan / $this->total_belanja) * 100, 2);
        }

        return 0;
    }

    public function getBelanjaPemberdayaanPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_belanja > 0) {
            return round(($this->belanja_pemberdayaan / $this->total_belanja) * 100, 2);
        }

        return 0;
    }

    public function getBelanjaBencanaPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        if ($this->total_belanja > 0) {
            return round(($this->belanja_bencana / $this->total_belanja) * 100, 2);
        }

        return 0;
    }

    public function getPembiayaanPenerimaanPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        $total_pembiayaan = $this->pembiayaan_penerimaan + $this->pembiayaan_pengeluaran;
        if ($total_pembiayaan > 0) {
            return round(($this->pembiayaan_penerimaan / $total_pembiayaan) * 100, 2);
        }

        return 0;
    }

    public function getPembiayaanPengeluaranPersenAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        $total_pembiayaan = $this->pembiayaan_penerimaan + $this->pembiayaan_pengeluaran;
        if ($total_pembiayaan > 0) {
            return round(($this->pembiayaan_pengeluaran / $total_pembiayaan) * 100, 2);
        }

        return 0;
    }
}
