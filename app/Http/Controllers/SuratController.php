<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\DataPenduduk;
use App\Models\JenisSurat;
use App\Models\SuratPengantar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SuratController extends Controller
{
    /**
     * ============================
     * ADMIN SIDE (CRUD SURAT)
     * ============================
     */
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

    public function create()
    {
        $penduduks = DataPenduduk::orderBy('nama')->get();
        $jenisSurats = JenisSurat::orderBy('nama_surat')->get();

        return view('pages.admin.surat.create', [
            'penduduks' => $penduduks,
            'jenisSurats' => $jenisSurats,
            'menu' => 'surat',
            'title' => 'Tambah Surat',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penduduk_id' => 'required|exists:data_penduduks,id',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nomor_surat' => 'nullable|string|max:255|unique:surats,nomor_surat',
            'tanggal_dibuat' => 'required|date',
            'status' => 'nullable|in:Menunggu Verifikasi,Diproses,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        if (empty($validated['status'])) {
            $validated['status'] = 'Menunggu Verifikasi';
        }

        $penduduk = DataPenduduk::findOrFail($validated['penduduk_id']);

        $payload = array_merge($validated, [
            'nik' => $penduduk->nik,
            'nama' => $penduduk->nama,
            'alamat' => $penduduk->alamat,
            'tempat_lahir' => $penduduk->tempat_lahir,
            'tanggal_lahir' => $penduduk->tanggal_lahir,
            'jenis_kelamin' => $penduduk->jenis_kelamin,
            'pekerjaan' => $penduduk->pekerjaan,
        ]);

        Surat::create($payload);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $penduduks = DataPenduduk::orderBy('nama')->get();
        $jenisSurats = JenisSurat::orderBy('nama_surat')->get();

        return view('pages.admin.surat.edit', [
            'surat' => $surat,
            'penduduks' => $penduduks,
            'jenisSurats' => $jenisSurats,
            'menu' => 'surat',
            'title' => 'Edit Surat',
        ]);
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $validated = $request->validate([
            'penduduk_id' => 'required',
            'jenis_surat_id' => 'required',
            'nomor_surat' => 'required|string|max:255|unique:surats,nomor_surat,' . $surat->id,
            'tanggal_dibuat' => 'required|date',
            'status' => 'required|in:Menunggu Verifikasi,Diproses,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $surat->update($validated);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }

    public function verifikasi(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $request->validate([
            'status' => 'required|in:Diproses,Disetujui,Ditolak',
        ]);

        if ($surat->status === 'Disetujui' || $surat->status === 'Ditolak') {
            return redirect()->route('surat.index')->with('error', 'Surat sudah diverifikasi.');
        }

        $surat->update(['status' => $request->input('status')]);

        return redirect()->route('surat.index')->with('success', 'Status surat diperbarui menjadi ' . $surat->status);
    }

    /**
     * ============================
     * USER SIDE (PENGAJUAN SURAT)
     * ============================
     */
    public function userIndex(Request $request)
    {
        $jenisSurats = collect();
        try {
            if (Schema::hasTable('jenis_surats')) {
                $jenisSurats = JenisSurat::orderBy('nama_surat')->get();
            }
        } catch (\Throwable $e) {
            $jenisSurats = collect();
        }

        return view('pages.landing.layananonline.SuratPengantar', [
            'jenisSurats' => $jenisSurats,
        ]);
    }

    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'email' => 'nullable|email',
            'alamat' => 'nullable|string',
            'usaha' => 'nullable|string',
            'jenis_surat' => 'required|string',
            'tanggal_dibuat' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        SuratPengantar::create([
            'nik' => $validated['nik'],
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
            'pekerjaan' => $validated['pekerjaan'] ?? null,
            'no_hp' => $validated['no_hp'] ?? null,
            'email' => $validated['email'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'usaha' => $validated['usaha'] ?? null,
            'jenis_surat' => $validated['jenis_surat'],
            'nomor_surat' => null,
            'tanggal_dibuat' => $validated['tanggal_dibuat'],
            'status' => 'Menunggu Verifikasi',
            'keterangan' => $validated['keterangan'] ?? null,
            'qr_code' => null,
        ]);

        return redirect()->route('status')->with('success', 'Pengajuan surat diterima. Menunggu verifikasi admin.');
    }

    public function userStatus(Request $request)
    {
        $nik = $request->query('nik');
        $datas = collect();

        if (!empty($nik)) {
            $datas = SuratPengantar::where('nik', $nik)->latest()->get();
        }

        return view('pages.landing.layananonline.StatusPengantar', [
            'datas' => $datas,
            'nik' => $nik,
        ]);
    }

    public function userShowLetter($id)
    {
        $surat = SuratPengantar::findOrFail($id);
        if ($surat->status !== 'Disetujui') {
            abort(404);
        }

        return view('pages.landing.layananonline.SuratView', [
            'surat' => $surat,
            'kepalaDesa' => 'Kepala Desa',
        ]);
    }

    /**
     * ============================
     * API: Ambil Data Penduduk via NIK
     * ============================
     */
    public function getPendudukByNik($nik)
    {
        $penduduk = DataPenduduk::where('nik', $nik)->first();

        if ($penduduk) {
            return response()->json([
                'success' => true,
                'data' => $penduduk
            ]);
        }

        return response()->json(['success' => false]);
    }
}
