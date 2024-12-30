<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Guru;

class SiswaController extends Controller
{
    private $menu = 'siswa';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Siswa::with(['kelas', 'guru'])->get();
        $menu = $this->menu;
        return view('pages.admin.siswa.index', compact('menu', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('pages.admin.siswa.create', compact('menu', 'kelas', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $r = $request->all();
        // dd($r);

        // Menyimpan data guru
        Siswa::create($r);

        return redirect()->route('siswa.index')->with('message', 'Data guru berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Siswa::findOrFail($id); 
        $kelas = Kelas::all();
        $guru = Guru::all();
        $menu = $this->menu;

        return view('pages.admin.siswa.edit', compact('data', 'kelas', 'guru', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request )
    {
        $r = $request->all();
        $data = Siswa::find($r['id']);

        // dd($r);
        $data->update($r);

        return redirect()->route('siswa.index')->with('message', 'Data guru berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Siswa::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Data siswa berhasil dihapus.']);
    }
}
