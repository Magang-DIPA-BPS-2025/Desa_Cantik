<?php

namespace App\Http\Controllers;

use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermohonanInformasiController extends Controller
{
    /**
     * Form pengajuan untuk frontend
     */
    public function create()
    {
        return view('pages.landing.PPID&UMKM.permohonan-create');
    }

    /**
     * Simpan data dari frontend
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:50',
            'asal_instansi' => 'nullable|string|max:255',
            'alamat_email' => 'required|email|max:255',
            'permohonan' => 'required|string',
            'file_path' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Upload file jika ada
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('permohonan', 'public');
        }

        PermohonanInformasi::create($validated);

        return redirect()->route('userindex')
                         ->with('success', 'Permohonan informasi berhasil dikirim.');
    }

    /**
     * Daftar permohonan (Admin)
     */
    public function index()
{
    $menu = 'permohonan';
    
    $permohonans = PermohonanInformasi::latest();
    
    // Support untuk pencarian
    if (request('search')) {
        $permohonans->where(function($query) {
            $query->where('nama', 'like', '%' . request('search') . '%')
                  ->orWhere('nomor_telepon', 'like', '%' . request('search') . '%')
                  ->orWhere('asal_instansi', 'like', '%' . request('search') . '%')
                  ->orWhere('alamat_email', 'like', '%' . request('search') . '%')
                  ->orWhere('permohonan', 'like', '%' . request('search') . '%');
        });
    }
    
    $permohonans = $permohonans->paginate(request('per_page', 10));
    
    return view('pages.admin.permohonan.index', compact('permohonans', 'menu'));
}

    /**
     * Form edit permohonan
     */
    public function edit($id)
    {
        $permohonan = PermohonanInformasi::findOrFail($id);
        $menu = 'permohonan';
        return view('pages.admin.permohonan.edit', compact('permohonan', 'menu'));
    }

    /**
     * Update data permohonan
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:50',
            'asal_instansi' => 'nullable|string|max:255',
            'alamat_email' => 'required|email|max:255',
            'permohonan' => 'required|string',
            'status' => 'required|in:diproses,selesai,ditolak',
            'file_path' => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $permohonan = PermohonanInformasi::findOrFail($id);

        // Jika admin upload file baru → hapus lama
        if ($request->hasFile('file_path')) {
            if ($permohonan->file_path && Storage::disk('public')->exists($permohonan->file_path)) {
                Storage::disk('public')->delete($permohonan->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('permohonan', 'public');
        } else {
            // Jika tidak upload file baru → pakai file lama
            $validated['file_path'] = $permohonan->file_path;
        }

        $permohonan->update($validated);

        return redirect()->route('permohonan.index')->with('success', 'Data permohonan berhasil diperbarui.');
    }

    /**
     * Update status langsung dari dropdown di tabel
     */
    public function userStatus(Request $request)
{
    $permohonans = collect(); // default kosong
    if ($request->has('email')) {
        $permohonans = PermohonanInformasi::where('alamat_email', $request->email)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    return view('pages.landing.PPID&UMKM.status-permohonan', compact('permohonans'));
}

    /**
     * Hapus data permohonan
     */
    public function destroy($id)
    {
        $permohonan = PermohonanInformasi::findOrFail($id);

        if ($permohonan->file_path && Storage::disk('public')->exists($permohonan->file_path)) {
            Storage::disk('public')->delete($permohonan->file_path);
        }

        $permohonan->delete();

        return redirect()->route('permohonan.index')->with('success', 'Permohonan berhasil dihapus.');
    }

    public static function countPending()
    {
        return PermohonanInformasi::where('status', 'diproses')->count();
    }
}
