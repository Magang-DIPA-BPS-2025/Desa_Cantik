<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApbdController extends Controller
{
    public function index()
    {
        // Data contoh (bisa diganti dari DB nanti)
        $apbd = [
            'tahun' => 2024,
            'pendapatan' => 4802205800,
            'belanja' => 4888222678.75,
            'pembiayaan' => 86016878.75,
            'surplus_defisit' => 0,
        ];

        $pendapatan = [
            ['sumber' => 'PAD', 'jumlah' => 0],
            ['sumber' => 'Transfer', 'jumlah' => 4802205800],
            ['sumber' => 'Lain-lain', 'jumlah' => 0],
        ];

        $belanja = [
            ['bidang' => 'Pemerintahan Desa', 'jumlah' => 2004886353],
            ['bidang' => 'Pembangunan Desa', 'jumlah' => 2158774559.75],
            ['bidang' => 'Pembinaan Kemasyarakatan', 'jumlah' => 495161766],
            ['bidang' => 'Pemberdayaan Masyarakat', 'jumlah' => 35000000],
            ['bidang' => 'Penanggulangan Bencana', 'jumlah' => 194400000],
        ];

        $pembiayaan = [
            ['jenis' => 'Penerimaan', 'jumlah' => 86016878.75],
            ['jenis' => 'Pengeluaran', 'jumlah' => 0],
        ];

        $tahunData = [
            ['tahun' => 2020, 'pendapatan' => 3000000000, 'belanja' => 2800000000],
            ['tahun' => 2021, 'pendapatan' => 3500000000, 'belanja' => 3300000000],
            ['tahun' => 2022, 'pendapatan' => 4200000000, 'belanja' => 4000000000],
            ['tahun' => 2023, 'pendapatan' => 4600000000, 'belanja' => 4500000000],
            ['tahun' => 2024, 'pendapatan' => 4802205800, 'belanja' => 4888222678.75],
        ];

        // Kirim semua variabel yang diperlukan ke view
        return view('pages.landing.profildesa.APBDDesa', compact(
            'apbd','pendapatan','belanja','pembiayaan','tahunData'
        ));
    }
}
