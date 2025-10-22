<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;

class SkuController extends Controller
{
    /** -------------------------------
     *  TAMPILKAN DATA SKU - INDEX
     *  -------------------------------
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $skus = Sku::when($keyword, function ($query, $keyword) {
            $query->where('nik', 'like', "%{$keyword}%")
                ->orWhere('nama', 'like', "%{$keyword}%")
                ->orWhere('nama_usaha', 'like', "%{$keyword}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.sku.index', [
            'skus'  => $skus,
            'menu'  => 'SKU',
            'title' => 'Data SKU',
        ]);
    }

    /** -------------------------------
     *  TAMPILKAN FORM TAMBAH - CREATE
     *  -------------------------------
     */
    public function create()
    {
        return view('pages.admin.sku.create', [
            'title' => 'Tambah SKU',
            'menu'  => 'SKU',
        ]);
    }

    /** -------------------------------
     *  SIMPAN DATA SKU BARU - STORE
     *  -------------------------------
     */
    public function store(Request $request)
{$request->validate([
    'nik' => 'required|string|max:20',
    'nama' => 'required|string|max:100',
    'alamat' => 'required|string',
    'nama_usaha' => 'required|string|max:100',
    'alamat_usaha' => 'required|string',
    'no_hp' => 'nullable|string|max:20',
    'email' => 'nullable|email|max:100',
    'pekerjaan' => 'nullable|string|max:50',
    'jenis_kelamin' => 'nullable|string',
    'tanggal_dibuat' => 'required|date', 
]);


    // Cara 2: Explicitly define semua field
    Sku::create([
        'nik' => $request->nik,
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'pekerjaan' => $request->pekerjaan,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'nama_usaha' => $request->nama_usaha,
        'alamat_usaha' => $request->alamat_usaha,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_dibuat' => $request->tanggal_dibuat ?? now(), 
        'status_verifikasi' => 'Belum Diverifikasi',
    ]);

    return redirect()->route('pengantar')->with('success', 'Data SKU berhasil ditambahkan.');
}

    

    /** -------------------------------
     *  TAMPILKAN DETAIL SKU - SHOW
     *  -------------------------------
     */
    public function show($id)
    {
        $sku = Sku::findOrFail($id);
        
        return view('pages.admin.sku.show', [
            'sku'   => $sku,
            'title' => 'Detail SKU',
            'menu'  => 'SKU',
        ]);
    }

    /** -------------------------------
     *  TAMPILKAN FORM EDIT - EDIT
     *  -------------------------------
     */
    public function edit($id)
    {
        $sku = Sku::findOrFail($id);

        return view('pages.admin.sku.edit', [
            'sku'   => $sku,
            'title' => 'Edit SKU',
            'menu'  => 'SKU',
        ]);
    }

    /** -------------------------------
     *  UPDATE DATA SKU - UPDATE
     *  -------------------------------
     */
     public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'pekerjaan' => 'nullable|string|max:50',
            'nama_usaha' => 'required|string|max:100',
            'alamat_usaha' => 'required|string',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'keperluan' => 'nullable|string',
            'nomor_surat' => 'nullable|string|max:50', // Tambahan field nomor surat
        ]);

        $sku = SKU::findOrFail($id);
        
        $sku->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'nama_usaha' => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'nomor_surat' => $request->nomor_surat, // Simpan nomor surat
        ]);


        return redirect()->route('sku.index')
            ->with('success', 'Data SKU berhasil diperbarui!');
    }

    /** -------------------------------
     *  HAPUS DATA SKU - DESTROY
     *  -------------------------------
     */
    public function destroy($id)
    {
        $sku = Sku::findOrFail($id);
        $sku->delete();

        return redirect()->route('sku.index')->with('success', 'Data SKU berhasil dihapus.');
    }

    /** -------------------------------
     *  VERIFIKASI SKU - CUSTOM METHOD
     *  -------------------------------
     */
    public function verifikasi($id)
    {
        $sku = Sku::findOrFail($id);
        $sku->status_verifikasi = 'Terverifikasi';
        $sku->save();

        return redirect()->route('sku.index')->with('success', 'Data SKU berhasil diverifikasi.');
    }

    /** -------------------------------
     *  CETAK SURAT SKU (PDF) - CUSTOM METHOD
     *  -------------------------------
     */
    public function cetak($id)
    {
        $sku = Sku::findOrFail($id);

        if ($sku->status_verifikasi !== 'Terverifikasi') {
            return redirect()->back()->with('error', 'Data belum diverifikasi, tidak dapat dicetak.');
        }

        $linkVerifikasi = route('verifikasi.surat', ['id' => $sku->id]);
        
        // Untuk sementara, kita skip QR code dulu
        $qrCodeSuccess = false;
        $qrCodeBase64 = '';

        $pdf = Pdf::loadView('pages.admin.sku.cetak', [
            'sku' => $sku,
            'linkVerifikasi' => $linkVerifikasi,
            'qrCodeSuccess' => $qrCodeSuccess
        ])->setPaper('A4', 'portrait')
          ->setOptions([
              'defaultFont' => 'Times New Roman',
              'isHtml5ParserEnabled' => true,
              'isRemoteEnabled' => true,
          ]);

        return $pdf->stream('Surat-Keterangan-Usaha-' . $sku->nama . '.pdf');
    }

    /** -------------------------------
     *  HALAMAN VERIFIKASI SURAT - CUSTOM METHOD
     *  -------------------------------
     */
    public function verifikasiSurat($id)
    {
        $sku = Sku::find($id);

        if (!$sku) {
            return response()->view('pages.admin.sku.verifikasi', [
                'valid' => false,
                'pesan' => 'Data surat tidak ditemukan dalam sistem.',
            ], 404);
        }

        return response()->view('pages.admin.sku.verifikasi', [
            'valid' => true,
            'sku' => $sku,
        ]);
    }

    /** -------------------------------
     *  FORCE GD BACKEND UNTUK QR CODE
     *  -------------------------------
     */
    private function forceGDBackend()
    {
        putenv('QR_CODE_BACKEND=gd');
        config(['qrcode.imageBackend' => 'gd']);
        \Log::info('Forced GD backend for QR Code generation');
    }
}