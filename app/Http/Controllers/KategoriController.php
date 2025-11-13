<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // Tampilkan semua kategori dengan pagination dan search
    public function index(Request $request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $kategoris = Kategori::when($search, function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pages.admin.kategori.index', [
            'kategoris' => $kategoris,
            'menu'      => 'Kategori',
            'title'     => 'Kategori Berita'
        ]);
    }

    // Form tambah kategori
    public function create()
    {
        return view('pages.admin.kategori.create', [
            'menu'  => 'Kategori',
            'title' => 'Tambah Kategori Berita'
        ]);
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|unique:kategoris,nama|max:255',
            'deskripsi' => 'nullable|max:500',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah ada.',
            'nama.max'      => 'Nama kategori maksimal 255 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
        ]);

        try {
            Kategori::create([
                'nama'      => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('kategori.index')
                ->with('success', 'Kategori berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Form edit kategori
    public function edit($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);

            return view('pages.admin.kategori.edit', [
                'kategori' => $kategori,
                'menu'     => 'Kategori',
                'title'    => 'Edit Kategori Berita'
            ]);

        } catch (\Exception $e) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|unique:kategoris,nama,' . $id . '|max:255',
            'deskripsi' => 'nullable|max:500',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique'   => 'Nama kategori sudah ada.',
            'nama.max'      => 'Nama kategori maksimal 255 karakter.',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter.',
        ]);

        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->update([
                'nama'      => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('kategori.index')
                ->with('success', 'Kategori berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Hapus kategori
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            
            // Cek apakah kategori digunakan di berita
            $usedInBerita = DB::table('beritas')->where('kategori_id', $id)->exists();
            
            if ($usedInBerita) {
                return redirect()->route('kategori.index')
                    ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan dalam berita.');
            }

            $kategori->delete();

            return redirect()->route('kategori.index')
                ->with('success', 'Kategori berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->route('kategori.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Download data kategori (untuk API/export)
    public function download(Request $request)
    {
        $type = $request->get('type', 'excel');
        $search = $request->get('search');

        $kategoris = Kategori::when($search, function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
            })
            ->orderBy('nama')
            ->get();

        if ($type === 'pdf') {
            // Logic untuk generate PDF
            return $this->generatePDF($kategoris);
        } else {
            // Logic untuk generate Excel
            return $this->generateExcel($kategoris);
        }
    }

    // Generate PDF (placeholder - bisa diimplementasi dengan library PDF)
    private function generatePDF($kategoris)
    {
        // Implementasi generate PDF
        // Contoh menggunakan DomPDF atau library lainnya
        return response()->json(['message' => 'PDF download akan diimplementasi']);
    }

    // Generate Excel (placeholder - bisa diimplementasi dengan library Excel)
    private function generateExcel($kategoris)
    {
        // Implementasi generate Excel
        // Contoh menggunakan Maatwebsite/Laravel-Excel atau library lainnya
        return response()->json(['message' => 'Excel download akan diimplementasi']);
    }

    // Get data kategori untuk API/select2
    public function getKategoris(Request $request)
    {
        $search = $request->get('search');

        $kategoris = Kategori::when($search, function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orderBy('nama')
            ->limit(10)
            ->get(['id', 'nama as text']);

        return response()->json($kategoris);
    }
}