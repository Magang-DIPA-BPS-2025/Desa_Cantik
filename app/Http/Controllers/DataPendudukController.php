<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
    public function index()
    {
        $datas = DataPenduduk::latest()->paginate(10);
        return view('pages.admin.dataPenduduk.index', [
            'datas' => $datas,
            'menu'  => 'dataPenduduk',
            'title'    => 'Data Penduduk',
        ]);
    }

    public function create()
    {
        return view('pages.admin.dataPenduduk.create', [
            'menu' => 'data_penduduk'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik'               => 'required|digits:16|unique:data_penduduks,nik',
            'nokk'              => 'required|string|max:16',
            'nama'              => 'required|string|max:100',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'      => 'required|string|max:100',
            'tanggal_lahir'     => 'required|date',
            'alamat'            => 'required|string|max:200',
            'dusun'             => 'nullable|string|max:100',
            'rt'                => 'required|string|max:5',
            'rw'                => 'required|string|max:5',
            'keldesa'           => 'required|string|max:100',
            'kecamatan'         => 'required|string|max:100',
            'agama'             => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan'         => 'required|string|max:100',
            'tahun'             => 'required|integer|between:' . (date('Y') - 4) . ',' . date('Y'),
            'pendidikan'        => 'nullable|string|max:100',
            'disabilitas'       => 'nullable|string|max:100',
        ]);

        DataPenduduk::create($request->all());

        return redirect()->route('dataPenduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan');
    }

    public function show($nik)
    {
        $dataPenduduk = DataPenduduk::findOrFail($nik);
        return view('pages.admin.dataPenduduk.show', [
            'dataPenduduk' => $dataPenduduk,
            'menu'         => 'data_penduduk'
        ]);
    }

    public function edit($id)
    {
        $dataPenduduk = DataPenduduk::findOrFail($id);
        return view('pages.admin.dataPenduduk.edit', [
            'dataPenduduk' => $dataPenduduk,
            'menu'         => 'data_penduduk'
        ]);
    }

    public function update(Request $request, $nik)
    {
        $data = DataPenduduk::findOrFail($nik);

        $request->validate([
            'nik' => 'required|digits:16|unique:data_penduduks,nik,' . $data->nik . ',nik',
            'nokk'              => 'required|string|max:16',
            'nama'              => 'required|string|max:100',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'      => 'required|string|max:100',
            'tanggal_lahir'     => 'required|date',
            'alamat'            => 'required|string|max:200',
            'dusun'             => 'nullable|string|max:100',
            'rt'                => 'required|string|max:5',
            'rw'                => 'required|string|max:5',
            'keldesa'           => 'required|string|max:100',
            'kecamatan'         => 'required|string|max:100',
            'agama'             => 'required|string|max:50',
            'status_perkawinan' => 'required|string|max:50',
            'pekerjaan'         => 'required|string|max:100',
            'tahun'             => 'required|integer|between:' . (date('Y') - 4) . ',' . date('Y'),
            'pendidikan'        => 'nullable|string|max:100',
            'disabilitas'       => 'nullable|string|max:100',
        ]);

        $data->update($request->all());

        return redirect()->route('dataPenduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui');
    }

    public function destroy($nik)
    {
        $dataPenduduk = DataPenduduk::findOrFail($nik);
        $dataPenduduk->delete();

        return redirect()->route('dataPenduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus');
    }


    public function statistik(Request $request)
    {
        $query = DataPenduduk::query();

        // Filter dusun jika ada
        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        // Filter tahun jika ada
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $totalPenduduk  = $query->count();
        $laki           = (clone $query)->where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan      = (clone $query)->where('jenis_kelamin', 'Perempuan')->count();
        $disabilitas    = (clone $query)->whereNotNull('disabilitas')
            ->where('disabilitas', '!=', 'Tidak Ada')->count();
        $kepalaKeluarga = (clone $query)->select('nokk')->distinct()->count('nokk');

        // Data dusun untuk filter
        $dusunList = DataPenduduk::select('dusun')->distinct()->orderBy('dusun')->get();

        return view('pages.landing.datastatistikdesa.jumlahPenduduk', compact(
            'totalPenduduk',
            'laki',
            'perempuan',
            'disabilitas',
            'kepalaKeluarga',
            'dusunList'
        ));
    }


    /**
     * Statistik data pendidikan
     */
    public function statistikPendidikan(Request $request)
    {
        $query = DataPenduduk::selectRaw('pendidikan, COUNT(*) as jumlah')
            ->whereNotNull('pendidikan')
            ->where('pendidikan', '!=', '');

        // Filter dusun jika ada
        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        // Filter tahun jika ada
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }


        $pendidikanStats = $query->groupBy('pendidikan')
            ->orderBy('jumlah', 'desc')
            ->get();

        // Data dusun untuk filter
        $dusunList = DataPenduduk::select('dusun')->distinct()->orderBy('dusun')->get();

        return view('pages.landing.datastatistikdesa.DataPendidikan', [
            'pendidikanStats' => $pendidikanStats,
            'dusunList' => $dusunList,
        ]);
    }

    /**
     * Statistik data pekerjaan
     */
    public function statistikPekerjaan(Request $request)
    {
        $query = DataPenduduk::selectRaw('pekerjaan, COUNT(*) as jumlah')
            ->whereNotNull('pekerjaan')
            ->where('pekerjaan', '!=', '');

        // Filter dusun jika ada
        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        // Filter tahun jika ada
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }


        $pekerjaanStats = $query->groupBy('pekerjaan')
            ->orderBy('jumlah', 'desc')
            ->get();

        // Data dusun untuk filter
        $dusunList = DataPenduduk::select('dusun')->distinct()->orderBy('dusun')->get();

        return view('pages.landing.datastatistikdesa.DataPekerjaan', [
            'pekerjaanStats' => $pekerjaanStats,
            'dusunList' => $dusunList,
        ]);
    }

    /**
     * Statistik data agama
     */
    public function statistikAgama(Request $request)
    {
        $query = DataPenduduk::selectRaw('agama, COUNT(*) as jumlah')
            ->whereNotNull('agama')
            ->where('agama', '!=', '');

        // Filter dusun jika ada
        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        // Filter tahun jika ada
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }


        $agamaStats = $query->groupBy('agama')
            ->orderBy('jumlah', 'desc')
            ->get();

        // Data dusun untuk filter
        $dusunList = DataPenduduk::select('dusun')->distinct()->orderBy('dusun')->get();

        return view('pages.landing.datastatistikdesa.DataAgama', [
            'agamaStats' => $agamaStats,
            'dusunList' => $dusunList,
        ]);
    }
}
