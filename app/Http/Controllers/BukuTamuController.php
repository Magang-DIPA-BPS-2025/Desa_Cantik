<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
  
    public function index()
    {
        $bukutamus = BukuTamu::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.landing.bukutamu.Buku', compact('bukutamus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:15',
            'keperluan' => 'required|string'
        ]);

        BukuTamu::create($request->all());

        return redirect()->route('bukutamu')
            ->with('success', 'Data berhasil disimpan! Terima kasih telah mengisi buku tamu.');
    }

    // ✅ ADMIN INDEX
    public function adminIndex()
    {
        $menu = 'buku';
        $bukutamus = BukuTamu::latest()->paginate(10);

        return view('pages.admin.buku.index', compact('bukutamus', 'menu'));
    }

    // ✅ EDIT DATA
    public function edit($id)
    {
        $menu = 'buku';
        $bukuTamu = BukuTamu::findOrFail($id);

        return view('pages.admin.buku.edit', compact('bukuTamu', 'menu'));
    }

    // ✅ UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:15',
            'keperluan' => 'required|string'
        ]);

        $bukuTamu = BukuTamu::findOrFail($id);
        $bukuTamu->update($request->all());

        return redirect()->route('admin.buku.index')
            ->with('success', 'Data buku tamu berhasil diperbarui.');
    }
    public function destroy($id)
{
    $bukuTamu = BukuTamu::findOrFail($id);
    $bukuTamu->delete();

    return redirect()->route('admin.buku.index')->with('success', 'Data berhasil dihapus.');
}

}