<?php

namespace App\Http\Controllers;

use App\Models\Ppid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PPIDController extends Controller
{
    // === HALAMAN ADMIN: LIST DATA PPID ===
    public function index(Request $request)
{
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $query = Ppid::query();

    // Tambahkan pencarian jika ada
    if ($search) {
        $query->where('judul', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
    }

    $ppids = $query->latest()->paginate($perPage);
    $menu = 'ppid';

    return view('pages.admin.ppid.index', compact('ppids', 'menu'));
}

    // === HALAMAN ADMIN: FORM TAMBAH DATA PPID ===
    public function create()
    {
        $menu = 'ppid';
        return view('pages.admin.ppid.create', compact('menu'));
    }

    // === SIMPAN DATA PPID BARU ===
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('ppid', 'public');
        }

        Ppid::create($data);

        return redirect()->route('ppid.index')->with('success', 'Data PPID berhasil ditambahkan.');
    }

    // === HALAMAN ADMIN: FORM EDIT DATA PPID ===
    public function edit($id)
    {
        $ppid = Ppid::findOrFail($id);
        $menu = 'ppid';
        return view('pages.admin.ppid.edit', compact('ppid', 'menu'));
    }

    // === UPDATE DATA PPID ===
    public function update(Request $request, $id)
    {
        $ppid = Ppid::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        // Hapus file lama jika ada file baru
        if ($request->hasFile('file')) {
            if ($ppid->file && Storage::disk('public')->exists($ppid->file)) {
                Storage::disk('public')->delete($ppid->file);
            }
            $data['file'] = $request->file('file')->store('ppid', 'public');
        } else {
            unset($data['file']); // jangan overwrite file lama
        }

        $ppid->update($data);

        return redirect()->route('ppid.index')->with('success', 'Data PPID berhasil diupdate.');
    }

    // === HALAMAN FRONTEND: DAFTAR SEMUA PPID UNTUK USER ===
    public function userindex()
    {
        $ppids = Ppid::latest()->get();
        return view('pages.landing.PPID&UMKM.Ppid', compact('ppids'));
    }

    // === Informasi Berkala ===
    public function berkala()
    {
        $berkalas = Ppid::where('kategori', 'berkala')
                         ->orderBy('tanggal', 'desc')
                         ->get();
        return view('pages.landing.PPID&UMKM.informasi-berkala', compact('berkalas'));
    }

    // === Informasi Serta Merta ===
    public function serta()
    {
        $sertas = Ppid::where('kategori', 'serta')
                      ->orderBy('tanggal', 'desc')
                      ->get();
        return view('pages.landing.PPID&UMKM.informasi-serta', compact('sertas'));
    }

    // === Informasi Setiap Saat ===
    public function setiap()
    {
        $setiaps = Ppid::where('kategori', 'setiap')
                        ->orderBy('tanggal', 'desc')
                        ->get();
        return view('pages.landing.PPID&UMKM.informasi-setiap', compact('setiaps'));
    }

    // === DELETE DATA PPID ===
    public function destroy($id)
    {
        $ppid = Ppid::findOrFail($id);

        if ($ppid->file && Storage::disk('public')->exists($ppid->file)) {
            Storage::disk('public')->delete($ppid->file);
        }

        $ppid->delete();

        return redirect()->route('ppid.index')->with('success', 'Data PPID berhasil dihapus.');
    }
}
