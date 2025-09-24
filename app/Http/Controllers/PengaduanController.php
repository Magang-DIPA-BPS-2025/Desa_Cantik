<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with(['kategori', 'user'])->latest()->paginate(10);
        return view('pengaduan.index', compact('pengaduans'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('pengaduan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'anonymous' => 'boolean',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengaduan/gambar', 'public');
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('pengaduan/file', 'public');
        }

        Pengaduan::create($data);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim');
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('pengaduan.show', compact('pengaduan'));
    }

    public function edit(Pengaduan $pengaduan)
    {
        $kategoris = Kategori::all();
        return view('pengaduan.edit', compact('pengaduan', 'kategoris'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'kategori_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required|in:pending,proses,selesai,ditolak',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($pengaduan->gambar) {
                Storage::disk('public')->delete($pengaduan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pengaduan/gambar', 'public');
        }

        if ($request->hasFile('file')) {
            if ($pengaduan->file) {
                Storage::disk('public')->delete($pengaduan->file);
            }
            $data['file'] = $request->file('file')->store('pengaduan/file', 'public');
        }

        $pengaduan->update($data);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if ($pengaduan->gambar) {
            Storage::disk('public')->delete($pengaduan->gambar);
        }
        if ($pengaduan->file) {
            Storage::disk('public')->delete($pengaduan->file);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus');
    }
}

