<?php

namespace App\Http\Controllers;

use App\Models\Apbd;
use Illuminate\Http\Request;

class ApbdController extends Controller
{
    /**
     * Menampilkan semua data APBD Desa (Admin)
     */
    public function index()
    {
        $apbds = Apbd::orderBy('tahun', 'desc')->get();

        return view('pages.admin.apbd.index', [
            'apbds' => $apbds,
            'menu'  => 'apbd',
            'title' => 'Data APBD Desa',
        ]);
    }

    /**
     * Menampilkan form tambah data APBD
     */
    public function create()
    {
        return view('pages.admin.apbd.create', [
            'menu'  => 'apbd',
            'title' => 'Tambah Data APBD Desa',
        ]);
    }

    /**
     * Menyimpan data APBD baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:2020|max:2030|unique:apbds,tahun',
            'total_pendapatan' => 'required|numeric|min:0',
            'total_belanja' => 'required|numeric|min:0',
            'penerimaan' => 'required|numeric|min:0',
            'pengeluaran' => 'required|numeric|min:0',
            'surplus_defisit' => 'required|numeric',
            'pendapatan_pad' => 'required|numeric|min:0',
            'pendapatan_transfer' => 'required|numeric|min:0',
            'pendapatan_lain' => 'required|numeric|min:0',
            'belanja_pemerintahan' => 'required|numeric|min:0',
            'belanja_pembangunan' => 'required|numeric|min:0',
            'belanja_pembinaan' => 'required|numeric|min:0',
            'belanja_pemberdayaan' => 'required|numeric|min:0',
            'belanja_bencana' => 'required|numeric|min:0',
            'pembiayaan_penerimaan' => 'required|numeric|min:0',
            'pembiayaan_pengeluaran' => 'required|numeric|min:0',
        ]);

        // Hitung persentase otomatis
        $data = $request->all();

        // Hitung persentase pendapatan
        if ($data['total_pendapatan'] > 0) {
            $data['pendapatan_pad_persen'] = round(($data['pendapatan_pad'] / $data['total_pendapatan']) * 100, 2);
            $data['pendapatan_transfer_persen'] = round(($data['pendapatan_transfer'] / $data['total_pendapatan']) * 100, 2);
            $data['pendapatan_lain_persen'] = round(($data['pendapatan_lain'] / $data['total_pendapatan']) * 100, 2);
        } else {
            $data['pendapatan_pad_persen'] = 0;
            $data['pendapatan_transfer_persen'] = 0;
            $data['pendapatan_lain_persen'] = 0;
        }

        // Hitung persentase belanja
        if ($data['total_belanja'] > 0) {
            $data['belanja_pemerintahan_persen'] = round(($data['belanja_pemerintahan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_pembangunan_persen'] = round(($data['belanja_pembangunan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_pembinaan_persen'] = round(($data['belanja_pembinaan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_pemberdayaan_persen'] = round(($data['belanja_pemberdayaan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_bencana_persen'] = round(($data['belanja_bencana'] / $data['total_belanja']) * 100, 2);
        } else {
            $data['belanja_pemerintahan_persen'] = 0;
            $data['belanja_pembangunan_persen'] = 0;
            $data['belanja_pembinaan_persen'] = 0;
            $data['belanja_pemberdayaan_persen'] = 0;
            $data['belanja_bencana_persen'] = 0;
        }

        // Hitung persentase pembiayaan
        $total_pembiayaan = $data['pembiayaan_penerimaan'] + $data['pembiayaan_pengeluaran'];
        if ($total_pembiayaan > 0) {
            $data['pembiayaan_penerimaan_persen'] = round(($data['pembiayaan_penerimaan'] / $total_pembiayaan) * 100, 2);
            $data['pembiayaan_pengeluaran_persen'] = round(($data['pembiayaan_pengeluaran'] / $total_pembiayaan) * 100, 2);
        } else {
            $data['pembiayaan_penerimaan_persen'] = 0;
            $data['pembiayaan_pengeluaran_persen'] = 0;
        }

        Apbd::create($data);

        return redirect()->route('apbd.index')
            ->with('success', 'Data APBD berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit data APBD
     */
    public function edit($id)
    {
        $apbd = Apbd::findOrFail($id);

        return view('pages.admin.apbd.edit', [
            'apbd' => $apbd,
            'menu' => 'apbd',
            'title' => 'Edit Data APBD Desa',
        ]);
    }

    /**
     * Memperbarui data APBD
     */
    public function update(Request $request, $id)
    {
        $apbd = Apbd::findOrFail($id);

        $request->validate([
            'tahun' => 'required|integer|min:2020|max:2030|unique:apbds,tahun,' . $id,
            'total_pendapatan' => 'required|numeric|min:0',
            'total_belanja' => 'required|numeric|min:0',
            'penerimaan' => 'required|numeric|min:0',
            'pengeluaran' => 'required|numeric|min:0',
            'surplus_defisit' => 'required|numeric',
            'pendapatan_pad' => 'required|numeric|min:0',
            'pendapatan_transfer' => 'required|numeric|min:0',
            'pendapatan_lain' => 'required|numeric|min:0',
            'belanja_pemerintahan' => 'required|numeric|min:0',
            'belanja_pembangunan' => 'required|numeric|min:0',
            'belanja_pembinaan' => 'required|numeric|min:0',
            'belanja_pemberdayaan' => 'required|numeric|min:0',
            'belanja_bencana' => 'required|numeric|min:0',
            'pembiayaan_penerimaan' => 'required|numeric|min:0',
            'pembiayaan_pengeluaran' => 'required|numeric|min:0',
        ]);

        // Hitung persentase otomatis
        $data = $request->all();

        // Hitung persentase pendapatan
        if ($data['total_pendapatan'] > 0) {
            $data['pendapatan_pad_persen'] = round(($data['pendapatan_pad'] / $data['total_pendapatan']) * 100, 2);
            $data['pendapatan_transfer_persen'] = round(($data['pendapatan_transfer'] / $data['total_pendapatan']) * 100, 2);
            $data['pendapatan_lain_persen'] = round(($data['pendapatan_lain'] / $data['total_pendapatan']) * 100, 2);
        } else {
            $data['pendapatan_pad_persen'] = 0;
            $data['pendapatan_transfer_persen'] = 0;
            $data['pendapatan_lain_persen'] = 0;
        }

        // Hitung persentase belanja
        if ($data['total_belanja'] > 0) {
            $data['belanja_pemerintahan_persen'] = round(($data['belanja_pemerintahan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_pembangunan_persen'] = round(($data['belanja_pembangunan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_pembinaan_persen'] = round(($data['belanja_pembinaan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_pemberdayaan_persen'] = round(($data['belanja_pemberdayaan'] / $data['total_belanja']) * 100, 2);
            $data['belanja_bencana_persen'] = round(($data['belanja_bencana'] / $data['total_belanja']) * 100, 2);
        } else {
            $data['belanja_pemerintahan_persen'] = 0;
            $data['belanja_pembangunan_persen'] = 0;
            $data['belanja_pembinaan_persen'] = 0;
            $data['belanja_pemberdayaan_persen'] = 0;
            $data['belanja_bencana_persen'] = 0;
        }

        // Hitung persentase pembiayaan
        $total_pembiayaan = $data['pembiayaan_penerimaan'] + $data['pembiayaan_pengeluaran'];
        if ($total_pembiayaan > 0) {
            $data['pembiayaan_penerimaan_persen'] = round(($data['pembiayaan_penerimaan'] / $total_pembiayaan) * 100, 2);
            $data['pembiayaan_pengeluaran_persen'] = round(($data['pembiayaan_pengeluaran'] / $total_pembiayaan) * 100, 2);
        } else {
            $data['pembiayaan_penerimaan_persen'] = 0;
            $data['pembiayaan_pengeluaran_persen'] = 0;
        }

        $apbd->update($data);

        return redirect()->route('apbd.index')
            ->with('success', 'Data APBD berhasil diperbarui');
    }

    /**
     * Menghapus data APBD
     */
    public function destroy($id)
    {
        $apbd = Apbd::findOrFail($id);
        $apbd->delete();

        return redirect()->route('apbd.index')
            ->with('success', 'Data APBD berhasil dihapus');
    }

    /**
     * Menampilkan data APBD untuk user landing page dengan fitur filtering
     */
    public function show(Request $request)
    {
        // Ambil tahun yang dipilih dari request
        $selectedYear = $request->get('tahun');
        
        // Query untuk mendapatkan data APBD berdasarkan tahun
        $apbdQuery = Apbd::query();
        
        if ($selectedYear) {
            $apbdQuery->where('tahun', $selectedYear);
        } else {
            // Jika tidak ada tahun yang dipilih, ambil tahun terbaru
            $selectedYear = Apbd::max('tahun');
            $apbdQuery->where('tahun', $selectedYear);
        }
        
        $apbd = $apbdQuery->first();
        
        // Ambil daftar tahun yang tersedia untuk dropdown
        $years = Apbd::distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        
        return view('pages.landing.profildesa.APBDDesa', compact('apbd', 'years', 'selectedYear'));
    }

    /**
     * API untuk mendapatkan data APBD berdasarkan tahun (untuk AJAX requests)
     */
    public function getByYear($year)
    {
        $apbd = Apbd::where('tahun', $year)->first();
        
        if (!$apbd) {
            return response()->json([
                'success' => false,
                'message' => 'Data APBD tidak ditemukan untuk tahun ' . $year
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $apbd
        ]);
    }
}