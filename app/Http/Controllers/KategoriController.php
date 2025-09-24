<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategoris = Kategori::all();

        return view('pages.admin.kategori.index', [
            'kategoris' => $kategoris,
            'menu'      => 'Kategori',
            'title'     => 'Kategori Berita'
        ]);
    }

    // Form tambah kategori
    public function create()
    {
        return view('pages.admin.kategori.create', [
            'menu'  => 'Kategori',
            'title' => 'Tambah Kategori Berita'
        ]);
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|unique:kategoris,nama',
            'deskripsi' => 'nullable',
        ]);

        Kategori::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    // Form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('pages.admin.kategori.edit', [
            'kategori' => $kategori,
            'menu'     => 'Kategori',
            'title'    => 'Edit Kategori Berita'
        ]);
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|unique:kategoris,nama,' . $id,
            'deskripsi' => 'nullable',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
    