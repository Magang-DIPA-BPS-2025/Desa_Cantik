<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use App\Models\Pengaduan;
use App\Models\Berita;
use App\Models\Surat;
use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\BelanjaDesa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function userBeranda()
    {
        $currentYear = date('Y');

        // ========== BAGIAN STATISTIK ========== //
        try {
            $totalPenduduk = DataPenduduk::where('tahun', $currentYear)->count();
            $laki = DataPenduduk::where('tahun', $currentYear)->where('jenis_kelamin', 'Laki-laki')->count();
            $perempuan = DataPenduduk::where('tahun', $currentYear)->where('jenis_kelamin', 'Perempuan')->count();
            $disabilitas = DataPenduduk::where('tahun', $currentYear)
                ->whereNotNull('disabilitas')
                ->where('disabilitas', '!=', 'Tidak Ada')
                ->where('disabilitas', '!=', '')
                ->count();
            $kepalaKeluarga = DataPenduduk::where('tahun', $currentYear)->distinct('nokk')->count('nokk');

            $dusunCount = DataPenduduk::where('tahun', $currentYear)
                ->whereNotNull('dusun')
                ->where('dusun', '!=', '')
                ->distinct('dusun')
                ->count('dusun');

            $rtCount = DataPenduduk::where('tahun', $currentYear)
                ->whereNotNull('rt')
                ->where('rt', '!=', '')
                ->distinct('rt')
                ->count('rt');

            $rwCount = DataPenduduk::where('tahun', $currentYear)
                ->whereNotNull('rw')
                ->where('rw', '!=', '')
                ->distinct('rw')
                ->count('rw');

            $stats = [
                'tahun' => $currentYear,
                'dusun' => $dusunCount,
                'rt' => $rtCount,
                'rw' => $rwCount,
                'kepala_keluarga' => $kepalaKeluarga,
                'laki_laki' => $laki,
                'perempuan' => $perempuan,
                'disabilitas' => $disabilitas,
                'total_penduduk' => $totalPenduduk,
            ];
        } catch (\Exception $e) {
            \Log::error('Error in HomeController: ' . $e->getMessage());
            $stats = [
                'tahun' => $currentYear,
                'dusun' => 7,
                'rt' => 23,
                'rw' => 12,
                'kepala_keluarga' => 2463,
                'laki_laki' => 4952,
                'perempuan' => 4716,
                'disabilitas' => 4,
                'total_penduduk' => 9668,
            ];
        }

        // ========== BAGIAN KONTEN (BERITA, AGENDA, DLL) ========== //
        $beritas = Berita::with('kategori')->latest()->take(6)->get();
        $latest_agendas = Agenda::latest()->take(6)->get();
        $belanjas = BelanjaDesa::latest()->take(6)->get();
        $galeris = Galeri::latest()->take(6)->get();

        // ========== RETURN KE VIEW ========== //
        return view('pages.landing.index', [
            'beritas' => $beritas,
            'latest_agendas' => $latest_agendas,
            'belanjas' => $belanjas,
            'galeris' => $galeris,
            'stats' => $stats,
        ]);
    }
}
