<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
    /**
     * Tampilkan daftar penduduk
     */
    public function index()
    {
        $datas = DataPenduduk::latest()->paginate(10);

        return view('pages.admin.dataPenduduk.index', [
            'datas' => $datas,
            'menu'  => 'data_penduduk'
        ]);
    }

    /**
     * Form tambah penduduk
     */
    public function create()
    {
        return view('pages.admin.dataPenduduk.create', [
            'menu' => 'data_penduduk'
        ]);
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik'               => 'required|digits:16|unique:data_penduduks,nik',
            'nokk'              => 'required|string:16',
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
            'kewarganegaraan'   => 'required|string|max:50',
            'pendidikan'        => 'nullable|string|max:100',
            'disabilitas'       => 'nullable|string|max:100',
        ]);

        DataPenduduk::create($request->all());

        return redirect()->route('dataPenduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan');
    }

    /**
     * Detail penduduk
     */
    public function show($nik)
    {
        $dataPenduduk = DataPenduduk::findOrFail($nik);

        return view('pages.admin.dataPenduduk.show', [
            'dataPenduduk' => $dataPenduduk,
            'menu'         => 'data_penduduk'
        ]);
    }

    /**
     * Form edit penduduk
     */
    public function edit($nik)
    {
        $dataPenduduk = DataPenduduk::findOrFail($nik);

        return view('pages.admin.dataPenduduk.edit', [
            'dataPenduduk' => $dataPenduduk,
            'menu'         => 'data_penduduk'
        ]);
    }

    /**
     * Update data penduduk
     */
    public function update(Request $request, $nik)
    {
        $data = DataPenduduk::findOrFail($nik);

        $request->validate([
            'nik'               => 'required|digits:16|unique:data_penduduks,nik,' . $data->nik . ',nik',
            'nokk'              => 'required|string:16',
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
            'kewarganegaraan'   => 'required|string|max:50',
            'pendidikan'        => 'nullable|string|max:100',
            'disabilitas'       => 'nullable|string|max:100',
        ]);

        $data->update($request->all());

        return redirect()->route('dataPenduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui');
    }

    /**
     * Hapus data penduduk
     */
    public function destroy($nik)
    {
        $dataPenduduk = DataPenduduk::findOrFail($nik);
        $dataPenduduk->delete();

        return redirect()->route('dataPenduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus');
    }

    /**
     * Statistik penduduk (untuk grafik/chart)
     */
    public function statistik()
    {
        $totalPenduduk  = DataPenduduk::count();
        $laki           = DataPenduduk::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan      = DataPenduduk::where('jenis_kelamin', 'Perempuan')->count();
        $disabilitas    = DataPenduduk::whereNotNull('disabilitas')
                            ->where('disabilitas', '!=', 'Tidak Ada')->count();

        
        $kepalaKeluarga = DataPenduduk::select('nokk')
                            ->distinct()
                            ->count('nokk');

        return view('pages.landing.datastatistikdesa.jumlahPenduduk', compact(
            'totalPenduduk',
            'laki',
            'perempuan',
            'disabilitas',
            'kepalaKeluarga'
        ));
    }
}
