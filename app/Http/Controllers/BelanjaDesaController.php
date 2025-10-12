<?php

namespace App\Http\Controllers;

use App\Models\BelanjaDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BelanjaDesaController extends Controller
{
    // ===========================
    // ADMIN CRUD
    // ===========================

    public function index()
    {
        $datas = BelanjaDesa::latest()->paginate(10);
        return view('pages.admin.belanja.index', [
            'datas' => $datas,
            'menu'  => 'belanja',
            'title' => 'Data UMKM Desa',
        ]);
    }

    public function create()
    {
        return view('pages.admin.belanja.create', [
            'menu'  => 'belanja',
            'title' => 'Tambah UMKM Desa',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'harga'  => 'required|numeric',
            'rating' => 'required|numeric|min:0|max:5',
            'wa'     => 'nullable|string',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'harga', 'rating', 'wa']);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        BelanjaDesa::create($data);

        return redirect()->route('belanja.index')->with('success', 'UMKM berhasil ditambahkan.');
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

        $request->validate([
            'judul'  => 'required|string|max:255',
            'harga'  => 'required|numeric',
            'rating' => 'required|numeric|min:0|max:5',
            'wa'     => 'nullable|string',
            'foto'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'harga', 'rating', 'wa']);

        if ($request->hasFile('foto')) {
            if ($belanja->foto) {
                Storage::disk('public')->delete($belanja->foto);
            }
            $data['foto'] = $request->file('foto')->store('umkm', 'public');
        }

        $belanja->update($data);

        return redirect()->route('belanja.index')->with('success', 'UMKM berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $belanja = BelanjaDesa::findOrFail($id);
        if ($belanja->foto) {
            Storage::disk('public')->delete($belanja->foto);
        }
        $belanja->delete();

        return redirect()->route('belanja.index')->with('success', 'UMKM berhasil dihapus.');
    }

    // ===========================
    // USER LANDING PAGE
    // ===========================
    public function userIndex()
    {
        $belanjas = BelanjaDesa::latest()->paginate(9);
        return view('pages.landing.PPID&UMKM.Belanja', [
            'belanjas' => $belanjas,
            'menu'     => 'belanja',
            'title'    => 'UMKM Desa',
        ]);
    }

    public function userShow($id)
    {
        $belanja = BelanjaDesa::findOrFail($id);
        return view('pages.landing.PPID&UMKM.Detail-Belanja', [
            'belanja' => $belanja,
            'menu'    => 'belanja',
            'title'   => 'Detail UMKM Desa',
        ]);
    }
}
