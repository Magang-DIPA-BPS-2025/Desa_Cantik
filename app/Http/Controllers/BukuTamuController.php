<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'jabatan' => 'required|string|max:255',
            'keperluan' => 'required|string',
            'ttd_data' => 'nullable|string'
            
        ]);

       
        BukuTamu::create([
            'nama' => $request->nama,
            'asal' => $request->asal,
            'jabatan' => $request->jabatan,
            'keperluan' => $request->keperluan,
            'tanda_tangan' => $request->ttd_data,
            
        ]);

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
            'jabatan' => 'required|string|max:255',
            'keperluan' => 'required|string',
            'ttd_data' => 'nullable|string'
            
        ]);

        $bukuTamu = BukuTamu::findOrFail($id);
        $bukuTamu->update([
            'nama' => $request->nama,
            'asal' => $request->asal,
            'jabatan' => $request->jabatan,
            'keperluan' => $request->keperluan,
            'tanda_tangan' => $request->ttd_data
            // HAPUS 'tujuan'
        ]);

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