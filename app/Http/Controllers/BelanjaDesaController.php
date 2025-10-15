<?php

namespace App\Http\Controllers;

use App\Models\BelanjaDesa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BelanjaDesaController extends Controller
{
    // ===========================
    // ADMIN CRUD
    // ===========================
    public function index()
    {
        $datas = BelanjaDesa::with('ratings.user')->latest()->paginate(10);

        // PERBAIKAN: Hitung rating rata-rata yang benar
        $totalRating = 0;
        $umkmWithRating = 0;
        
        foreach ($datas as $umkm) {
            $rating = $umkm->averageRating();
            if ($rating > 0) {
                $totalRating += $rating;
                $umkmWithRating++;
            }
        }
        
        $avgRating = $umkmWithRating > 0 
            ? number_format($totalRating / $umkmWithRating, 1) 
            : '0.0';

        $stats = [
            'total'    => BelanjaDesa::count(),
            'lokasi'   => BelanjaDesa::withLokasi()->count(),
            'rating'   => $avgRating, // PERBAIKAN: Gunakan perhitungan yang benar
            'kategori' => BelanjaDesa::distinct('kategori')->count('kategori'),
        ];

        return view('pages.admin.belanja.index', [
            'datas' => $datas,
            'stats' => $stats,
            'menu'  => 'belanja',
            'title' => 'Data UMKM Desa',
        ]);
    }

    // ... method lainnya tetap sama ...

    public function create()
    {
        return view('pages.admin.belanja.create', [
            'menu'  => 'belanja',
            'title' => 'Tambah UMKM Desa',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'kategori'       => 'nullable|string|max:100',
            'deskripsi'      => 'nullable|string',
            'harga'          => 'required|numeric',
            'wa'             => 'nullable|string|max:20',
            'lokasi'         => 'nullable|string|max:255',
            'pemilik'        => 'nullable|string|max:100',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'alamat_lengkap' => 'nullable|string|max:255',
            'jam_buka'       => 'nullable|date_format:H:i',
            'jam_tutup'      => 'nullable|date_format:H:i',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        BelanjaDesa::create($validated);

        return redirect()->route('belanja.index')
                         ->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $belanja = BelanjaDesa::findOrFail($id);

        return view('pages.admin.belanja.edit', [
            'belanja' => $belanja,
            'menu'    => 'belanja',
            'title'   => 'Edit UMKM Desa',
        ]);
    }

    public function update(Request $request, $id)
    {
        $belanja = BelanjaDesa::findOrFail($id);

        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'kategori'       => 'nullable|string|max:100',
            'deskripsi'      => 'nullable|string',
            'harga'          => 'required|numeric',
            'wa'             => 'nullable|string|max:20',
            'lokasi'         => 'nullable|string|max:255',
            'pemilik'        => 'nullable|string|max:100',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'alamat_lengkap' => 'nullable|string|max:255',
            'jam_buka'       => 'nullable|date_format:H:i',
            'jam_tutup'      => 'nullable|date_format:H:i',
            'foto'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($belanja->foto) {
                Storage::disk('public')->delete($belanja->foto);
            }
            $validated['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        $belanja->update($validated);

        return redirect()->route('belanja.index')
                         ->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $belanja = BelanjaDesa::findOrFail($id);

        if ($belanja->foto) {
            Storage::disk('public')->delete($belanja->foto);
        }

        $belanja->delete();

        return redirect()->route('belanja.index')
                         ->with('success', 'UMKM berhasil dihapus.');
    }

    // ===========================
    // LANDING PAGE UNTUK USER
    // ===========================
    public function userIndex()
    {
        $belanjas = BelanjaDesa::with('ratings')->latest()->paginate(9);

        return view('pages.landing.PPID&UMKM.Belanja', [
            'belanjas' => $belanjas,
            'menu'     => 'belanja',
            'title'    => 'UMKM Desa',
        ]);
    }

    public function userShow($id)
    {
        $belanja = BelanjaDesa::with('ratings.user')->findOrFail($id);

        return view('pages.landing.PPID&UMKM.Detail-Belanja', [
            'belanja' => $belanja,
            'menu'    => 'belanja',
            'title'   => 'Detail UMKM Desa',
        ]);
    }

    // ===========================
    // SIMPAN RATING PRODUK (BISA BERKALI-KALI - FIXED)
    // ===========================
    public function storeRating(Request $request, $id)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        $belanja = BelanjaDesa::findOrFail($id);

        // Cek apakah user sudah login
        $userId = auth()->check() ? auth()->id() : null;

        // **HAPUS SEMUA PEMBATASAN - BIARKAN USER RATING BERKALI-KALI**
        // Create new rating every time without checking existing ratings
        Rating::create([
            'belanja_desa_id' => $belanja->id,
            'user_id'         => $userId,
            'rating'          => $request->rating,
            'komentar'        => $request->komentar,
        ]);

        return redirect()->route('belanja.usershow', $belanja->id)
             ->with('success', 'Terima kasih atas rating Anda! Rating berhasil disimpan.');
    }

    public function userBeranda()
    {
        $beritas = Berita::with('kategori')->latest()->take(6)->get();
        $latest_agendas = Agenda::latest()->take(6)->get();
        $belanjas = BelanjaDesa::latest()->take(6)->get();
        $galeris = Galeri::latest()->take(6)->get();

        return view('pages.landing.index', [
            'beritas'        => $beritas,
            'latest_agendas' => $latest_agendas,
            'belanjas'       => $belanjas,
            'galeris'        => $galeris,
        ]);
    }
}