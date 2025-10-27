<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
    /**
     * Method untuk landing page dengan statistik
     */
public function landingPage()
{
    $currentYear = date('Y');
    
    \Log::info('LandingPage method called'); // Debug log
    
    try {
        // Query untuk statistik
        $totalPenduduk = DataPenduduk::where('tahun', $currentYear)->count();
        $laki = DataPenduduk::where('tahun', $currentYear)->where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = DataPenduduk::where('tahun', $currentYear)->where('jenis_kelamin', 'Perempuan')->count();
        $disabilitas = DataPenduduk::where('tahun', $currentYear)
            ->whereNotNull('disabilitas')
            ->where('disabilitas', '!=', 'Tidak Ada')
            ->where('disabilitas', '!=', '')
            ->count();
        $kepalaKeluarga = DataPenduduk::where('tahun', $currentYear)->distinct('nokk')->count('nokk');
        
        // Hitung dusun, RT, RW
        $dusunCount = DataPenduduk::where('tahun', $currentYear)
            ->whereNotNull('dusun')
            ->where('dusun', '!=', '')
            ->distinct('dusun')
            ->count('dusun');
            
        $rtCount = DataPenduduk::where('tahun', $currentYear)
            ->whereNotNull('rt')
            ->where('rt', '!=', '')
            ->distinct('rt')
            ->count('rt');
            
        $rwCount = DataPenduduk::where('tahun', $currentYear)
            ->whereNotNull('rw')
            ->where('rw', '!=', '')
            ->distinct('rw')
            ->count('rw');

        $stats = [
            'tahun' => $currentYear,
            'dusun' => $dusunCount,
            'rt' => $rtCount,
            'rw' => $rwCount,
            'kepala_keluarga' => $kepalaKeluarga,
            'laki_laki' => $laki,
            'perempuan' => $perempuan,
            'disabilitas' => $disabilitas,
            'total_penduduk' => $totalPenduduk
        ];

        \Log::info('Stats calculated: ', $stats); // Debug log

    } catch (\Exception $e) {
        \Log::error('Error in landingPage: ' . $e->getMessage()); // Debug log
        
        // Fallback data
        $stats = [
            'tahun' => $currentYear,
            'dusun' => 7,
            'rt' => 23,
            'rw' => 12,
            'kepala_keluarga' => 2463,
            'laki_laki' => 4952,
            'perempuan' => 4716,
            'disabilitas' => 4,
            'total_penduduk' => 9668
        ];
    }

    // Debug: cek apakah stats ada
    \Log::info('Final stats: ', $stats);
    
    return view('pages.landing.index', compact('stats'));
}

    /**
     * Method untuk halaman admin - index data penduduk
     */
    public function index()
    {
        $datas = DataPenduduk::latest()->paginate(10);
        return view('pages.admin.dataPenduduk.index', [
            'datas' => $datas,
            'title' => 'Data Penduduk',
            'activeMenu' => 'datapenduduk' 
        ]);
    }

    public function create()
    {
        return view('pages.admin.dataPenduduk.create', [
            'title' => 'Tambah Data Penduduk',
            'activeMenu' => 'datapenduduk' 
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
            'kewarganegaraan'   => 'nullable|string|max:50',
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
            'title' => 'Detail Data Penduduk',
            'activeMenu' => 'datapenduduk' 
        ]);
    }

    public function edit($nik)
    {
        $dataPenduduk = DataPenduduk::findOrFail($nik);
        return view('pages.admin.dataPenduduk.edit', [
            'dataPenduduk' => $dataPenduduk,
            'title' => 'Edit Data Penduduk',
            'activeMenu' => 'datapenduduk' 
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
            'kewarganegaraan'   => 'nullable|string|max:50',
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

    /**
     * Method untuk statistik jumlah penduduk
     */
    public function statistik(Request $request)
    {
        $query = DataPenduduk::query();

        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $totalPenduduk  = $query->count();
        $laki           = (clone $query)->where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan      = (clone $query)->where('jenis_kelamin', 'Perempuan')->count();
        $disabilitas    = (clone $query)->whereNotNull('disabilitas')
            ->where('disabilitas', '!=', 'Tidak Ada')
            ->where('disabilitas', '!=', '')
            ->count();
        $kepalaKeluarga = (clone $query)->select('nokk')->distinct()->count('nokk');

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

    public function statistikPendidikan(Request $request)
    {
        $query = DataPenduduk::selectRaw('pendidikan, COUNT(*) as jumlah')
            ->whereNotNull('pendidikan')
            ->where('pendidikan', '!=', '');

        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $pendidikanStats = $query->groupBy('pendidikan')
            ->orderBy('jumlah', 'desc')
            ->get();

        $dusunList = DataPenduduk::select('dusun')->distinct()->orderBy('dusun')->get();

        return view('pages.landing.datastatistikdesa.DataPendidikan', [
            'pendidikanStats' => $pendidikanStats,
            'dusunList' => $dusunList,
        ]);
    }

    public function statistikPekerjaan(Request $request)
    {
        $query = DataPenduduk::selectRaw('pekerjaan, COUNT(*) as jumlah')
            ->whereNotNull('pekerjaan')
            ->where('pekerjaan', '!=', '');

        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $pekerjaanStats = $query->groupBy('pekerjaan')
            ->orderBy('jumlah', 'desc')
            ->get();

        $dusunList = DataPenduduk::select('dusun')->distinct()->orderBy('dusun')->get();

        return view('pages.landing.datastatistikdesa.DataPekerjaan', [
            'pekerjaanStats' => $pekerjaanStats,
            'dusunList' => $dusunList,
        ]);
    }

    public function statistikAgama(Request $request)
    {
        $query = DataPenduduk::selectRaw('agama, COUNT(*) as jumlah')
            ->whereNotNull('agama')
            ->where('agama', '!=', '');

        if ($request->has('dusun') && $request->dusun) {
            $query->where('dusun', $request->dusun);
        }

        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $agamaStats = $query->groupBy('agama')
            ->orderBy('jumlah', 'desc')
            ->get();

        $dusunList = DataPenduduk::select('dusun')->distinct()->orderBy('dusun')->get();

        return view('pages.landing.datastatistikdesa.DataAgama', [
            'agamaStats' => $agamaStats,
            'dusunList' => $dusunList,
        ]);
    }
}