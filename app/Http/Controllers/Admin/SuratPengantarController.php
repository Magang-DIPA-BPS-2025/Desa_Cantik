<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratPengantar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratPengantarController extends Controller
{
    public function __construct()
    {
        $this->middleware('ValidasiUser');
    }

    public function index()
    {
        $datas = SuratPengantar::latest()->paginate(10);
        return view('pages.admin.surat_pengantar.index', [
            'datas' => $datas,
            'menu' => 'surat',
            'title' => 'Manajemen Surat Pengantar',
        ]);
    }

    public function show($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        return view('pages.admin.surat_pengantar.show', [
            'surat' => $surat,
            'menu' => 'surat',
            'title' => 'Detail Surat Pengantar',
        ]);
    }

    public function destroy($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        if ($surat->qr_code) {
            Storage::disk('public')->delete($surat->qr_code);
        }
        $surat->delete();
        return redirect()->route('admin.surat_pengantar.index')->with('success', 'Surat dihapus');
    }

    public function approve(Request $request, $id)
    {
        $surat = SuratPengantar::findOrFail($id);
        if ($surat->status === 'Disetujui') {
            return back()->with('error', 'Surat sudah disetujui');
        }
        $surat->status = 'Disetujui';
        $surat->nomor_surat = 'SURAT-' . $surat->id . '/' . date('Y');

        $payload = "Jenis: {$surat->jenis_surat}\nNama/NIK: {$surat->nik}\nTTL: {$surat->tempat_lahir}, {$surat->tanggal_lahir}\nAlamat: {$surat->alamat}\nNomor: {$surat->nomor_surat}\nTanggal: {$surat->tanggal_dibuat}";

        $qrDir = 'qrcodes';
        if (!Storage::disk('public')->exists($qrDir)) {
            Storage::disk('public')->makeDirectory($qrDir);
        }
        $qrPath = $qrDir . '/sp-' . $surat->id . '.png';

        try {
            if (class_exists(\SimpleSoftwareIO\QrCode\Facades\QrCode::class)) {
                $img = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(220)->generate($payload);
                Storage::disk('public')->put($qrPath, $img);
            } else {
                Storage::disk('public')->put($qrPath . '.txt', $payload);
            }
        } catch (\Throwable $e) {
            Storage::disk('public')->put($qrPath . '.txt', $payload);
        }

        $surat->qr_code = $qrPath;
        $surat->save();

        return back()->with('success', 'Surat disetujui dan QR dibuat');
    }
}



