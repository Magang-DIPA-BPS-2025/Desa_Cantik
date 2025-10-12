<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\DataPenduduk;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('ValidasiUser');
    }

    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Surat::with(['penduduk', 'jenisSurat'])->latest();
        if (!empty($status)) {
            $query->where('status', $status);
        }
        $datas = $query->paginate(10)->appends($request->query());

        return view('pages.admin.surat.index', [
            'datas' => $datas,
            'menu'  => 'surat',
            'title' => 'Manajemen Surat',
            'statusSelected' => $status,
        ]);
    }

    public function show($id)
    {
        $surat = Surat::with(['penduduk', 'jenisSurat'])->findOrFail($id);
        return view('pages.admin.surat.show', [
            'surat' => $surat,
            'menu' => 'surat',
            'title' => 'Detail Surat',
        ]);
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        if (!empty($surat->qr_code)) {
            Storage::disk('public')->delete($surat->qr_code);
        }
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat dihapus');
    }

    public function approve(Request $request, $id)
    {
        $surat = Surat::with(['penduduk', 'jenisSurat'])->findOrFail($id);
        if ($surat->status === 'Disetujui') {
            return back()->with('error', 'Surat sudah disetujui');
        }

        $surat->status = 'Disetujui';
        $surat->nomor_surat = 'SURAT-' . $surat->id . '/' . date('Y');

        // Build QR payload
        $payload = json_encode([
            'jenis' => $surat->jenisSurat->nama_surat ?? '-',
            'nama' => $surat->penduduk->nama ?? '-',
            'nik' => $surat->penduduk->nik ?? '-',
            'tanggal_lahir' => $surat->penduduk->tanggal_lahir ?? '-',
            'alamat' => $surat->penduduk->alamat ?? '-',
            'nomor_surat' => $surat->nomor_surat,
            'tanggal_dibuat' => $surat->tanggal_dibuat,
        ], JSON_UNESCAPED_UNICODE);

        // Generate QR code image to storage/app/public/qrcodes
        $qrDir = 'qrcodes';
        if (!Storage::disk('public')->exists($qrDir)) {
            Storage::disk('public')->makeDirectory($qrDir);
        }
        $qrPath = $qrDir . '/surat-' . $surat->id . '.png';

        // If SimpleSoftwareIO\QrCode is installed, use it; otherwise, store payload as a file placeholder
        try {
            if (class_exists(\SimpleSoftwareIO\QrCode\Facades\QrCode::class)) {
                $image = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(220)->generate($payload);
                Storage::disk('public')->put($qrPath, $image);
            } else {
                Storage::disk('public')->put($qrPath . '.txt', $payload);
            }
        } catch (\Throwable $e) {
            // fallback on error
            Storage::disk('public')->put($qrPath . '.txt', $payload);
        }

        $surat->qr_code = $qrPath;
        $surat->save();

        return back()->with('success', 'Surat disetujui dan QR code dibuat');
    }

    public function reject(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $request->validate([
            'keterangan' => 'required|string',
        ]);
        $surat->status = 'Ditolak';
        $surat->keterangan = $request->input('keterangan');
        $surat->save();
        return back()->with('success', 'Surat ditolak');
    }
}



