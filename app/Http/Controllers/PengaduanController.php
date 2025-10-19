<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * Tampilkan semua pengaduan (untuk admin)
     */
    public function index(Request $request)
    {
        // Tambahkan pencarian untuk admin berdasarkan nama atau email (opsional)
        $keyword = $request->input('keyword');

        $datas = Pengaduan::when($keyword, function($query, $keyword) {
            $query->where('nama_pelapor', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
        })->latest()->get();

        return view('pages.admin.pengaduan.index', [
            'datas' => $datas,
            'menu'  => 'Pengaduan',
            'title' => 'Data Pengaduan'
        ]);
    }

    /**
     * Simpan pengaduan dari form user
     */
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'telepon' => 'required|string|max:20',
        'alamat' => 'required|string',
        'judul' => 'required|string|max:255',
        'uraian' => 'required|string',
        'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
    ]);

    $lampiran = $request->hasFile('lampiran')
        ? $request->file('lampiran')->store('pengaduan_files', 'public')
        : null;

    Pengaduan::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'judul' => $request->judul,
        'deskripsi' => $request->uraian,
        'file' => $lampiran,
        'status' => 'baru',
        'anonymous' => false,
    ]);

    return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');
}
    
    /**
     * Update status pengaduan (untuk admin)
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
     * Hapus pengaduan
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

    /**
     * Menampilkan form pengaduan untuk user
     */
    public function userIndex()
    {
        return view('pages.landing.layananonline.Pengaduan');
    }

    /**
     * Menampilkan status pengaduan untuk user dengan pencarian email
     */
   public function userStatus(Request $request)
{
    $email = $request->input('email');

    // Ambil pengaduan berdasarkan email jika ada, atau kosong jika tidak ada
    $pengaduans = Pengaduan::when($email, function($query, $email) {
        $query->where('email', $email);
    })->latest()->get();

    return view('pages.landing.layananonline.StatusPengaduan', compact('pengaduans'));
}

}
