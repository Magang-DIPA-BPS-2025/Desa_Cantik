<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{

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


    public function create()
    {
        return view('pages.admin.kategori.create', [
            'menu'  => 'Kategori',
            'title' => 'Tambah Kategori Berita'
        ]);
    }

 
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

    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            
       
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
        
            return $this->generatePDF($kategoris);
        } else {
      
            return $this->generateExcel($kategoris);
        }
    }

    private function generatePDF($kategoris)
    {
     
        return response()->json(['message' => 'PDF download akan diimplementasi']);
    }

    private function generateExcel($kategoris)
    {

        return response()->json(['message' => 'Excel download akan diimplementasi']);
    }

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