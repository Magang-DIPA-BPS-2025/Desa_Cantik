<?php

namespace App\Http\Controllers;

use App\Models\SejarahDesa;
use Illuminate\Http\Request;

class SejarahDesaController extends Controller
{
    public function index()
    {
        $datas = SejarahDesa::latest()->paginate(10);

        return view('pages.admin.sejarahDesa.index', [
            'datas' => $datas,
            'menu'  => 'sejarahDesa',
            'title' => 'Manajemen Sejarah Desa'
        ]);
    }

    public function create()
    {
        return view('pages.admin.sejarahDesa.create', [
            'menu'  => 'sejarahDesa',
            'title' => 'Tambah Sejarah Desa'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
        ]);

        SejarahDesa::create($request->only(['judul', 'isi']));

        return redirect()->route('sejarahDesa.index')->with('success', 'Sejarah Desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sejarah = SejarahDesa::findOrFail($id);

        return view('pages.admin.sejarahDesa.edit', [
            'sejarah' => $sejarah,
            'menu'    => 'sejarahDesa',
            'title'   => 'Edit Sejarah Desa'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
        ]);

        $sejarah = SejarahDesa::findOrFail($id);
        $sejarah->update($request->only(['judul', 'isi']));

        return redirect()->route('sejarahDesa.index')->with('success', 'Sejarah Desa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sejarah = SejarahDesa::findOrFail($id);
        $sejarah->delete();

        return redirect()->route('sejarahDesa.index')->with('success', 'Sejarah Desa berhasil dihapus.');
    }
}
