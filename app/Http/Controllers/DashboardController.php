<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\Pengaduan;
use App\Models\Berita;
use App\Models\Surat;
use App\Models\Agenda;
use App\Models\Galeri;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_penduduk'   => DataPenduduk::count(),
            'total_pengaduan'  => Pengaduan::count(),
            'pengaduan_pending'=> Pengaduan::where('status', 'pending')->count(),
            'total_berita'     => Berita::count(),
            'total_surat'      => Surat::count(),
            'surat_pending'    => Surat::where('status', 'pending')->count(),
            'agenda_hari_ini'  => Agenda::whereDate('tanggal', today())->count(),
            'total_galeri'     => Galeri::count(),
        ];

        return view('dashboard', [
            'data' => $data,
            'menu' => 'dashboard' 
        ]);
    }
}
