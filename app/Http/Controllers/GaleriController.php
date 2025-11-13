<?php

namespace App\Http\Controllers;

use App\Models\BelanjaDesa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->paginate(12);

        return view('pages.admin.galeriDesa.index', [
            'galeris' => $galeris,
            'menu' => 'galeri',
            'title' => 'Galeri Desa'
        ]);
    }

    public function create()
    {
        return view('pages.admin.galeriDesa.create', [
            'menu' => 'galeri',
            'title' => 'Galeri Desa'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'  => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan file gambar
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        Galeri::create($validated);

        return redirect()->route('galeriDesa.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('pages.admin.galeriDesa.edit', [
            'galeri' => $galeri,
            'menu' => 'galeri',
            'title' => 'Edit Galeri Desa'
        ]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul'  => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = ['judul' => $validated['judul']];

        // Handle upload gambar baru
        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeriDesa.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('galeriDesa.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function userIndex(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 12; // Bisa disesuaikan, lebih banyak untuk infinite scroll
        
        $galeris = Galeri::latest()->paginate($perPage, ['*'], 'page', $page);
        
        if ($request->ajax()) {
            $html = '';
            foreach ($galeris as $galeri) {
                $html .= '
                <div class="gallery-card">
                    <div class="gallery-item" 
                         onclick="openModal(\'' . asset('storage/' . $galeri->gambar) . '\', \'' . addslashes($galeri->judul) . '\')">
                        <img src="' . asset('storage/' . $galeri->gambar) . '"
                             class="gallery-img"
                             alt="' . addslashes($galeri->judul) . '">
                        <div class="gallery-overlay">
                            <i class="bi bi-zoom-in"></i>
                            <small class="text-uppercase fw-bold">
                                Klik untuk memperbesar
                            </small>
                        </div>
                    </div>
                </div>';
            }
            
            return response()->json([
                'html' => $html,
                'hasMore' => $galeris->hasMorePages()
            ]);
        }
        
        // Untuk load pertama, tampilkan semua data tanpa pagination
        $initialGaleris = Galeri::latest()->get();
        
        return view('pages.landing.profildesa.GaleriDesa', compact('initialGaleris'));
    }
}