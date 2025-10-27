<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $izins = Izin::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.izin.index', compact('izins'));
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
                'pekerjaan' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:15',
                'email' => 'nullable|email',
                'hari' => 'required|string|max:50',
                'tanggal' => 'required|date',
                'tempat' => 'required|string|max:255',
                'jenis_acara' => 'required|string|max:255',
                'tanggal_dibuat' => 'required|date',
            ]);

            $validated['status_verifikasi'] = 'Belum Diverifikasi';

            Izin::create($validated);

            return redirect()->route('pengantar')
                ->with('success', 'Surat Izin Kegiatan berhasil diajukan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $izin = Izin::findOrFail($id);
        return view('pages.admin.izin.edit', compact('izin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $izin = Izin::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'pekerjaan' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'email' => 'nullable|email',
            'hari' => 'required|string|max:50',
            'tanggal' => 'required|date',
            'tempat' => 'required|string|max:255',
            'jenis_acara' => 'required|string|max:255',
            'nomor_surat' => 'nullable|string|max:100',
        ]);

        $izin->update($validated);

        return redirect()->route('izin.index')
            ->with('success', 'Data surat izin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $izin = Izin::findOrFail($id);
        $izin->delete();

        return redirect()->route('izin.index')
            ->with('success', 'Data surat izin berhasil dihapus.');
    }

    /**
     * Verifikasi surat izin
     */
    public function verifikasi($id)
    {
        $izin = Izin::findOrFail($id);
        $izin->update([
            'status_verifikasi' => 'Terverifikasi',
            'nomor_surat' => $izin->nomor_surat ?? $izin->id . '/SIZ/' . date('Y')
        ]);

        return redirect()->route('izin.index')
            ->with('success', 'Surat izin berhasil diverifikasi.');
    }

    /**
     * Cetak surat izin
     */
    public function cetak($id)
    {
        $izin = Izin::findOrFail($id);

        if ($izin->status_verifikasi !== 'Terverifikasi') {
            return redirect()->back()->with('error', 'Data belum diverifikasi, tidak dapat dicetak.');
        }

        $linkVerifikasi = route('verifikasi.surat.izin', ['id' => $izin->id]);
        
        $qrCodeSuccess = false;
        $qrCodeBase64 = '';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.admin.izin.cetak', [
            'izin' => $izin,
            'linkVerifikasi' => $linkVerifikasi,
            'qrCodeSuccess' => $qrCodeSuccess
        ])->setPaper('A4', 'portrait')
          ->setOptions([
              'defaultFont' => 'Times New Roman',
              'isHtml5ParserEnabled' => true,
              'isRemoteEnabled' => true,
          ]);

        return $pdf->stream('Surat-Izin-Kegiatan-' . $izin->nama . '.pdf');
    }

    /**
     * Verifikasi surat untuk user (public)
     */
      public function verifikasiSurat($id)
    {
        $izin = Izin::find($id);

        if (!$izin) {
            return response()->view('pages.admin.izin.verifikasi', [
                'valid' => false,
                'pesan' => 'Data surat tidak ditemukan dalam sistem.',
            ], 404);
        }

        return response()->view('pages.admin.izin.verifikasi', [
            'valid' => true,
            'izin' => $izin,
        ]);
    }
}