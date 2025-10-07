<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Apbd;

class ApbdDesaController extends Controller
{
    /**
     * Menampilkan data APBD terbaru untuk landing page
     */
    public function show()
    {
        $apbd = Apbd::latest('tahun')->first();

        // Jika tidak ada data APBD, buat data dummy
        if (!$apbd) {
            $apbd = (object) [
                'tahun' => date('Y'),
                'total_pendapatan' => 0,
                'total_belanja' => 0,
                'penerimaan' => 0,
                'pengeluaran' => 0,
                'surplus_defisit' => 0,
                'pendapatan_pad' => 0,
                'pendapatan_transfer' => 0,
                'pendapatan_lain' => 0,
                'belanja_pemerintahan' => 0,
                'belanja_pembangunan' => 0,
                'belanja_pembinaan' => 0,
                'belanja_pemberdayaan' => 0,
                'belanja_bencana' => 0,
                'pembiayaan_penerimaan' => 0,
                'pembiayaan_pengeluaran' => 0,
            ];
        }

        return view('pages.landing.profildesa.ApbdDesa', compact('apbd'));
    }
}
