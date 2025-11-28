<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
 
    public function index(Request $request)
{
    $keyword = $request->input('keyword');

    $datas = Pengaduan::when($keyword, function($query, $keyword) {
        $query->where('nama_pelapor', 'like', "%{$keyword}%")
              ->orWhere('email', 'like', "%{$keyword}%");
    })
    ->latest()
    ->paginate(10)
    ->withQueryString();

    return view('pages.admin.pengaduan.index', [
        'datas' => $datas,
        'menu'  => 'Pengaduan',
        'title' => 'Data Pengaduan'
    ]);
}



   
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


    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        if ($pengaduan->file && file_exists(storage_path('app/public/' . $pengaduan->file))) {
            unlink(storage_path('app/public/' . $pengaduan->file));
        }
        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }


    public function userIndex()
    {
        return view('pages.landing.layananonline.Pengaduan');
    }

   
   public function userStatus(Request $request)
{
    $email = $request->input('email');


    $pengaduans = Pengaduan::when($email, function($query, $email) {
        $query->where('email', $email);
    })->latest()->get();

    return view('pages.landing.layananonline.StatusPengaduan', compact('pengaduans'));
}

}
