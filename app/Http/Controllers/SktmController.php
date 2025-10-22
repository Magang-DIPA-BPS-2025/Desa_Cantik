<?php

namespace App\Http\Controllers;

use App\Models\Sktm;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class SktmController extends Controller
{
    /** -------------------------------
     *  TAMPILKAN DATA SKTM - INDEX
     *  -------------------------------
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $sktms = Sktm::when($keyword, function ($query, $keyword) {
            $query->where('nik', 'like', "%{$keyword}%")
                ->orWhere('nama', 'like', "%{$keyword}%")
                ->orWhere('alamat', 'like', "%{$keyword}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.sktm.index', [
            'sktms' => $sktms,
            'menu'  => 'SKTM',
            'title' => 'Data SKTM',
        ]);
    }

    /** -------------------------------
     *  TAMPILKAN FORM TAMBAH - CREATE
     *  -------------------------------
     */
    public function create()
    {
        return view('pages.admin.sktm.create', [
            'title' => 'Tambah SKTM',
            'menu'  => 'SKTM',
        ]);
    }

    /** -------------------------------
     *  SIMPAN DATA SKTM BARU - STORE
     *  -------------------------------
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
            'agama' => 'required|string|max:20',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        // Tambahkan status_verifikasi default
        $data = $request->all();
        $data['status_verifikasi'] = 'Belum Diverifikasi';

        Sktm::create($data);

        return redirect()->route('pengantar')->with('success', 'Data SKTM berhasil ditambahkan.');
    }

    /** -------------------------------
     *  TAMPILKAN DETAIL SKTM - SHOW
     *  -------------------------------
     */
    public function show($id)
    {
        $sktm = Sktm::findOrFail($id);
        
        return view('pages.admin.sktm.show', [
            'sktm'  => $sktm,
            'title' => 'Detail SKTM',
            'menu'  => 'SKTM',
        ]);
    }

    /** -------------------------------
     *  TAMPILKAN FORM EDIT - EDIT
     *  -------------------------------
     */
    public function edit($id)
    {
        $sktm = Sktm::findOrFail($id);

        return view('pages.admin.sktm.edit', [
            'sktm'  => $sktm,
            'title' => 'Edit SKTM',
            'menu'  => 'SKTM',
        ]);
    }

    /** -------------------------------
     *  UPDATE DATA SKTM - UPDATE
     *  -------------------------------
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:50',
            'agama' => 'required|string|max:20',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'nomor_surat' => 'nullable|string|max:50',
            'tanggal_dibuat' => 'required|date',
        ]);

        $sktm = Sktm::findOrFail($id);
        
        $sktm->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'agama' => $request->agama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'nomor_surat' => $request->nomor_surat,
            'tanggal_dibuat' => $request->tanggal_dibuat ?? now(), 
        ]);

        return redirect()->route('sktm.index')
            ->with('success', 'Data SKTM berhasil diperbarui!');
    }

    /** -------------------------------
     *  HAPUS DATA SKTM - DESTROY
     *  -------------------------------
     */
    public function destroy($id)
    {
        $sktm = Sktm::findOrFail($id);
        $sktm->delete();

        return redirect()->route('sktm.index')->with('success', 'Data SKTM berhasil dihapus.');
    }

    /** -------------------------------
     *  VERIFIKASI SKTM - CUSTOM METHOD
     *  -------------------------------
     */
    public function verifikasi($id)
    {
        try {
            $sktm = Sktm::findOrFail($id);
            $sktm->status_verifikasi = 'Terverifikasi';
            $sktm->save();

            return redirect()->route('sktm.index')->with('success', 'Data SKTM berhasil diverifikasi.');
        } catch (\Exception $e) {
            Log::error('Error verifikasi SKTM: ' . $e->getMessage());
            return redirect()->route('sktm.index')->with('error', 'Gagal memverifikasi SKTM: ' . $e->getMessage());
        }
    }

    /** -------------------------------
     *  CETAK SURAT SKTM (PDF) - CUSTOM METHOD
     *  -------------------------------
     */
    public function cetak($id)
    {
        try {
            $sktm = Sktm::findOrFail($id);

            // Cek apakah status_verifikasi ada dan bernilai 'Terverifikasi'
            if (!$sktm->status_verifikasi || $sktm->status_verifikasi !== 'Terverifikasi') {
                return redirect()->back()->with('error', 'Data belum diverifikasi, tidak dapat dicetak.');
            }

            $linkVerifikasi = route('verifikasi.surat.sktm', ['id' => $sktm->id]);
            
            $pdf = Pdf::loadView('pages.admin.sktm.cetak', [
                'sktm' => $sktm,
                'linkVerifikasi' => $linkVerifikasi,
            ])->setPaper('A4', 'portrait')
              ->setOptions([
                  'defaultFont' => 'Times New Roman',
                  'isHtml5ParserEnabled' => true,
                  'isRemoteEnabled' => true,
              ]);

            return $pdf->stream('Surat-Keterangan-Tidak-Mampu-' . $sktm->nama . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error cetak SKTM: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mencetak surat: ' . $e->getMessage());
        }
    }

    /** -------------------------------
     *  HALAMAN VERIFIKASI SURAT - CUSTOM METHOD
     *  -------------------------------
     */
    public function verifikasiSurat($id)
    {
        try {
            $sktm = Sktm::find($id);

            if (!$sktm) {
                return response()->view('pages.admin.sktm.verifikasi', [
                    'valid' => false,
                    'pesan' => 'Data surat tidak ditemukan dalam sistem.',
                ], 404);
            }

            return response()->view('pages.admin.sktm.verifikasi', [
                'valid' => true,
                'sktm' => $sktm,
            ]);
        } catch (\Exception $e) {
            Log::error('Error verifikasi surat SKTM: ' . $e->getMessage());
            return response()->view('pages.admin.sktm.verifikasi', [
                'valid' => false,
                'pesan' => 'Terjadi kesalahan sistem.',
            ], 500);
        }
    }
}