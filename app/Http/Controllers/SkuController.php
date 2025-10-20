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
     *  TAMPILKAN DATA SKU
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
     *  TAMPILKAN FORM TAMBAH
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
     *  SIMPAN DATA SKU BARU
     *  -------------------------------
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'nama_usaha' => 'required|string|max:100',
            'alamat_usaha' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        Sku::create($request->all());

        return redirect()->route('sku.index')->with('success', 'Data SKU berhasil ditambahkan.');
    }

    /** -------------------------------
     *  TAMPILKAN FORM EDIT
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
     *  UPDATE DATA SKU
     *  -------------------------------
     */
    public function update(Request $request, $id)
    {
        $sku = Sku::findOrFail($id);

        $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'nama_usaha' => 'required|string|max:100',
            'alamat_usaha' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        $sku->update($request->all());

        return redirect()->route('sku.index')->with('success', 'Data SKU berhasil diperbarui.');
    }

    /** -------------------------------
     *  HAPUS DATA SKU
     *  -------------------------------
     */
    public function destroy($id)
    {
        $sku = Sku::findOrFail($id);
        $sku->delete();

        return redirect()->back()->with('success', 'Data SKU berhasil dihapus.');
    }

    /** -------------------------------
     *  VERIFIKASI SKU
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
     *  CETAK SURAT SKU (PDF)
     *  -------------------------------
     */
    public function cetak($id)
    {
        $sku = Sku::findOrFail($id);

        if ($sku->status_verifikasi !== 'Terverifikasi') {
            return redirect()->back()->with('error', 'Data belum diverifikasi, tidak dapat dicetak.');
        }

        // Generate link verifikasi untuk QR
        $linkVerifikasi = URL::to('/verifikasi-surat/' . $sku->id);

        $pdf = Pdf::loadView('pages.admin.sku.cetak', compact('sku', 'linkVerifikasi'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Surat-Keterangan-Usaha-' . $sku->nama . '.pdf');
    }

    /** -------------------------------
     *  HALAMAN VERIFIKASI SURAT
     *  -------------------------------
     */


    public function verifikasiQr($id)
{
    $sku = Sku::find($id);

    if (!$sku) {
        return response()->view('pages.admin.sku.verifikasi', [
            'valid' => false,
            'pesan' => 'Data surat tidak ditemukan dalam sistem.',
        ]);
    }

    return response()->view('pages.admin.sku.verifikasi', [
        'valid' => true,
        'sku' => $sku,
    ]);
}

}
