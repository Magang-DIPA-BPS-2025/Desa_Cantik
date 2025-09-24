<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $datas = Berita::with('kategori')->latest()->paginate(10);

        return view('pages.admin.berita.index', [
            'datas' => $datas,
            'menu'  => 'berita',
            'title' => 'Manajemen Berita'
        ]);
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('pages.admin.berita.create', [
            'kategoris' => $kategoris,
            'menu'      => 'berita',
            'title'     => 'Tambah Berita'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'nullable|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'id_kategori' => $request->id_kategori,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoris = Kategori::all();

        return view('pages.admin.berita.edit', [
            'berita'    => $berita,
            'kategoris' => $kategoris,
            'menu'      => 'berita',
            'title'     => 'Edit Berita'
        ]);
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'id_kategori' => 'nullable|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'id_kategori' => $request->id_kategori,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
