<?php

namespace App\Http\Controllers;

use App\Models\Surat;
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
        $query = Surat::latest();

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
        $jenisSurats = JenisSurat::orderBy('nama_surat')->get();

        return view('pages.admin.surat.create', [
            'jenisSurats' => $jenisSurats,
            'menu' => 'surat',
            'title' => 'Tambah Surat',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nomor_surat' => 'nullable|string|max:255|unique:surats,nomor_surat',
            'tanggal_dibuat' => 'required|date',
            'status' => 'nullable|in:Menunggu Verifikasi,Diproses,Disetujui,Ditolak',
            'keterangan' => 'nullable|string',
        ]);

        $validated['status'] = $validated['status'] ?? 'Menunggu Verifikasi';

        Surat::create($validated);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $jenisSurats = JenisSurat::orderBy('nama_surat')->get();

        return view('pages.admin.surat.edit', [
            'surat' => $surat,
            'jenisSurats' => $jenisSurats,
            'menu' => 'surat',
            'title' => 'Edit Surat',
        ]);
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
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

        if (in_array($surat->status, ['Disetujui', 'Ditolak'])) {
            return redirect()->route('surat.index')->with('error', 'Surat sudah diverifikasi.');
        }

        $surat->update(['status' => $request->status]);

        return redirect()->route('surat.index')->with('success', 'Status surat diperbarui menjadi ' . $surat->status);
    }

    /**
     * ============================
     * USER SIDE (PENGAJUAN SURAT)
     * ============================
     */
    public function userIndex(Request $request)
    {
        $jenisSurats = Schema::hasTable('jenis_surats')
            ? JenisSurat::orderBy('nama_surat')->get()
            : collect();

        return view('pages.landing.layananonline.SuratPengantar', [
            'jenisSurats' => $jenisSurats,
        ]);
    }

    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jenis_surat' => 'required|string|max:100',
            'tanggal_dibuat' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        SuratPengantar::create(array_merge($validated, [
            'nomor_surat' => null,
            'status' => 'Menunggu Verifikasi',
            'qr_code' => null,
        ]));

        return redirect()->route('status')->with('success', 'Pengajuan surat diterima. Menunggu verifikasi admin.');
    }

    public function userStatus(Request $request)
    {
        $nik = $request->query('nik');
        $datas = !empty($nik)
            ? SuratPengantar::where('nik', $nik)->latest()->get()
            : collect();

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
            'kepalaDesa' => 'Kepala Desa Contoh',
        ]);
    }
}
