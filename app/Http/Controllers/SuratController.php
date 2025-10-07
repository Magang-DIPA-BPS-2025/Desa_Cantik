<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::with('penduduk')->latest()->paginate(10);
        return view('surat.index', compact('surats'));
    }

    public function create()
    {
        $penduduks = DataPenduduk::all();
        return view('surat.create', compact('penduduks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penduduk_id' => 'required',
            'jenis_surat_id' => 'required',
            'nomor_surat' => 'required|unique:surats,nomor_surat',
            'tanggal_dibuat' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        $data = $request->all();
        $data['status'] = 'pending';

        Surat::create($data);

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil dibuat');
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    public function edit(Surat $surat)
    {
        $penduduks = DataPenduduk::all();
        return view('surat.edit', compact('surat', 'penduduks'));
    }

    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'penduduk_id' => 'required',
            'jenis_surat_id' => 'required',
            'nomor_surat' => 'required|unique:surats,nomor_surat,' . $surat->id,
            'tanggal_dibuat' => 'required|date',
            'status' => 'required|in:pending,proses,selesai,ditolak',
            'keterangan' => 'nullable',
        ]);

        $surat->update($request->all());

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil diperbarui');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil dihapus');
    }

    /**
     * Menampilkan form surat pengantar untuk user
     */
    public function userIndex()
    {
        return view('pages.landing.layananonline.SuratPengantar');
    }

    /**
     * Menampilkan status surat pengantar untuk user
     */
    public function userStatus()
    {
        return view('pages.landing.layananonline.StatusPengantar');
    }
}

