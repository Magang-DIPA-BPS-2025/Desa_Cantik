<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Tampilkan semua pengaduan (untuk admin).
     */
    public function index()
    {
        $datas = Pengaduan::latest()->get();

        return view('pages.admin.pengaduan.index', [
            'datas' => $datas,
            'menu'  => 'Pengaduan',
            'title' => 'Data Pengaduan'
        ]);
    }

    /**
     * Simpan pengaduan dari form user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'email'     => 'required|email',
            'telepon'   => 'required|string|max:20',
            'alamat'    => 'required|string',
            'judul'     => 'required|string|max:255',
            'uraian'    => 'required|string',
            'lampiran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        // upload lampiran jika ada
        $lampiran = null;
        if ($request->hasFile('lampiran')) {
            $lampiran = $request->file('lampiran')->store('pengaduan_files', 'public');
        }

        // simpan ke database
        Pengaduan::create([
            'nama'      => $request->nama,
            'email'     => $request->email,
            'telepon'   => $request->telepon,
            'alamat'    => $request->alamat,
            'judul'     => $request->judul,
            'deskripsi' => $request->uraian, // simpan uraian ke kolom deskripsi
            'file'      => $lampiran,
            'status'    => 'baru',
            'anonymous' => false,
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');
    }

    /**
     * Update status pengaduan (untuk admin).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai,ditolak',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }


    /**
     * Hapus pengaduan.
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->file && file_exists(storage_path('app/public/' . $pengaduan->file))) {
            unlink(storage_path('app/public/' . $pengaduan->file));
        }
        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}
