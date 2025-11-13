<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SKematian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class sKematianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SKematian::orderBy('created_at', 'desc');
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nik', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nomor_surat', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('alamat', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Pagination dengan custom per_page
        $perPage = $request->get('per_page', 10);
        $kematians = $query->paginate($perPage);
        
        // Tambahkan parameter search ke pagination links
        if ($request->has('search')) {
            $kematians->appends(['search' => $request->search]);
        }
        
        return view('pages.admin.skematian.index', compact('kematians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nik' => 'required|string|max:16',
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'pekerjaan' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:15',
                'email' => 'nullable|email',
                'nomor_kk' => 'required|string|max:16',
                'tanggal_kematian' => 'required|date',
                'tanggal_dibuat' => 'required|date',
                'nomor_surat' => 'nullable|string|max:100',
            ]);

            $validated['status_verifikasi'] = 'Belum Diverifikasi';

            SKematian::create($validated);

            return redirect()->route('pengantar')
                ->with('success', 'Data surat kematian berhasil diajukan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kematian = SKematian::findOrFail($id);
        return view('pages.admin.skematian.show', compact('kematian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kematian = SKematian::findOrFail($id);
        return view('pages.admin.skematian.edit', compact('kematian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kematian = SKematian::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'nomor_kk' => 'required|string|max:16',
            'tanggal_kematian' => 'required|date',
            'nomor_surat' => 'nullable|string|max:100',
        ]);

        $kematian->update($validated);

        return redirect()->route('kematian.index')
            ->with('success', 'Data surat kematian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kematian = SKematian::findOrFail($id);
        $kematian->delete();

        return redirect()->route('kematian.index')
            ->with('success', 'Data surat kematian berhasil dihapus.');
    }

    /**
     * Verifikasi surat kematian
     */
    public function verifikasi($id)
    {
        $kematian = SKematian::findOrFail($id);
        $kematian->update([
            'status_verifikasi' => 'Terverifikasi',
            'nomor_surat' => $kematian->nomor_surat ?? $kematian->id . '/SKM/' . date('Y')
        ]);

        return redirect()->route('kematian.index')
            ->with('success', 'Surat kematian berhasil diverifikasi.');
    }

    /**
     * Cetak surat kematian
     */
    public function cetak($id)
    {
        $kematian = SKematian::findOrFail($id);

        if ($kematian->status_verifikasi !== 'Terverifikasi') {
            return redirect()->back()->with('error', 'Data belum diverifikasi, tidak dapat dicetak.');
        }

        $linkVerifikasi = route('verifikasi.surat.kematian', ['id' => $kematian->id]);

        // Untuk sementara, kita skip QR code dulu
        $qrCodeSuccess = false;
        $qrCodeBase64 = '';

        $pdf = Pdf::loadView('pages.admin.skematian.cetak', [
            'kematian' => $kematian,
            'linkVerifikasi' => $linkVerifikasi,
            'qrCodeSuccess' => $qrCodeSuccess
        ])->setPaper('A4', 'portrait')
            ->setOptions([
                'defaultFont' => 'Times New Roman',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return $pdf->stream('Surat-Keterangan-Kematian-' . $kematian->nama . '.pdf');
    }

    /**
     * Verifikasi surat untuk user (public)
     */
    public function verifikasiSurat($id)
{
    $kematian = SKematian::find($id);

    if (!$kematian) {
        return view('pages.admin.skematian.index', [
            'valid' => false,
            'pesan' => 'Data surat kematian tidak ditemukan.'
        ]);
    }

    return view('pages.admin.skematian.verifikasi', [
        'valid' => true,
        'kematian' => $kematian
    ]);
}

}