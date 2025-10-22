<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use App\Models\User;
use App\Models\Admin;
use App\Models\DataPenduduk;
use App\Models\Pengaduan;
use App\Models\Berita;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Total data
        $totalPenduduk   = DataPenduduk::count();
        $totalPengaduan  = class_exists(Pengaduan::class) ? Pengaduan::count() : 0;
        $totalBerita     = class_exists(Berita::class) ? Berita::count() : 0;

        // Statistik penduduk per dusun
        if (Schema::hasTable('data_penduduks') && Schema::hasColumn('data_penduduks', 'dusun')) {
            $labelsPenduduk = DataPenduduk::select('dusun')
                ->whereNotNull('dusun')
                ->where('dusun', '!=', '')
                ->distinct()
                ->pluck('dusun');

            $dataPenduduk = $labelsPenduduk->map(fn($d) => DataPenduduk::where('dusun', $d)->count());
        } else {
            $labelsPenduduk = collect(['Dusun 1', 'Dusun 2', 'Dusun 3']);
            $dataPenduduk   = collect([0, 0, 0]);
        }

        // Pengaduan terbaru
        $latestPengaduan = class_exists(Pengaduan::class) && Schema::hasTable('pengaduans')
            ? Pengaduan::latest()->take(5)->get()
            : collect([]);

        // Tanggal kegiatan dari tabel kalender
        if (class_exists(Kalender::class) && Schema::hasTable('kalenders')) {
            $agendaDates = Kalender::selectRaw('tanggal_kegiatan as tanggal')
                ->whereNotNull('tanggal_kegiatan')
                ->distinct()
                ->pluck('tanggal');
        } else {
            $agendaDates = collect([]);
        }

        return view('pages.admin.dashboard.index', [
            'menu'            => 'dashboard',
            'title'           => 'Dashboard',
            'totalPenduduk'   => $totalPenduduk,
            'totalPengaduan'  => $totalPengaduan,
            'totalBerita'     => $totalBerita,
            'labelsPenduduk'  => $labelsPenduduk,
            'dataPenduduk'    => $dataPenduduk,
            'latestPengaduan' => $latestPengaduan,
            'agendaDates'     => $agendaDates,
        ]);
    }
}
