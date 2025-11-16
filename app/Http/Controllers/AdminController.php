<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use App\Models\User;
use App\Models\Admin;
use App\Models\DataPenduduk;
use App\Models\Pengaduan;
use App\Models\Berita;
use App\Models\Surat;
use App\Models\SKematian;
use App\Models\SKU;
use App\Models\Sktm;
use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Total data utama
        $totalPenduduk = DataPenduduk::count();
        $totalPengaduan = class_exists(Pengaduan::class) ? Pengaduan::count() : 0;
        $totalBerita = class_exists(Berita::class) ? Berita::count() : 0;

        // Hitung total semua surat
        $totalSKematian = class_exists(SKematian::class) ? SKematian::count() : 0;
        $totalSKU = class_exists(SKU::class) ? SKU::count() : 0;
        $totalSktm = class_exists(Sktm::class) ? Sktm::count() : 0;
        $totalIzin = class_exists(Izin::class) ? Izin::count() : 0;

        // Jumlah total surat keseluruhan
        $totalSuratMasuk = $totalSKematian + $totalSKU + $totalSktm + $totalIzin;

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
            $dataPenduduk = collect([0, 0, 0]);
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
            'menu' => 'dashboard',
            'title' => 'Dashboard',
            'totalPenduduk' => $totalPenduduk,
            'totalPengaduan' => $totalPengaduan,
            'totalBerita' => $totalBerita,
            'totalSurat' => $totalSKematian + $totalSKU + $totalSktm + $totalIzin,
            'totalSKematian' => $totalSKematian,
            'totalSKU' => $totalSKU,
            'totalSktm' => $totalSktm,
            'totalIzin' => $totalIzin,
            'labelsPenduduk' => $labelsPenduduk,
            'dataPenduduk' => $dataPenduduk,
            'latestPengaduan' => $latestPengaduan,
            'agendaDates' => $agendaDates,
        ]);
    }

    /**
     * Tampilkan halaman edit profil
     */
    public function profile($id)
    {
        // Pastikan user hanya bisa edit profil sendiri
        $sessionUserId = session('user_id');
        if ($sessionUserId != $id) {
            return redirect()->route('dashboard')->with('message', 'Anda tidak memiliki akses untuk mengedit profil ini');
        }

        $user = Admin::findOrFail($id);
        
        return view('pages.admin.profile.edit', [
            'menu' => 'profile',
            'user' => $user
        ]);
    }

    /**
     * Update profil admin
     */
    public function profile_update(Request $request)
    {
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu');
        }

        $user = Admin::findOrFail($userId);

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:admins,username,' . $user->id,
            'password' => 'nullable|string|min:6',
        ], [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        try {
            // Update nama
            $user->name = $request->name;
            
            // Update username
            $user->username = strtolower(str_replace(' ', '', $request->username));

            // Update password jika diisi
            if ($request->filled('password')) {
                $user->password = $request->password; // Mutator akan hash otomatis
            }

            $user->save();

            // Update session dengan data terbaru
            session([
                'name' => $user->name,
                'username' => $user->username,
            ]);

            return redirect()->route('profile.index', $userId)
                ->with('message', 'update')
                ->with('success', 'Profil berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui profil: ' . $e->getMessage()])
                ->with('message', 'Gagal memperbarui profil');
        }
    }
}
