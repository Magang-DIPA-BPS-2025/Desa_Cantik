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

        $file = $request->file('pas_foto');

        // dd($file->getSize() / 1024);
        // if ($file->getSize() / 1024 >= 512) {
        //     return redirect()->route('guru.create')->with('message', 'size gambar');
        // }

        $foto = $request->file('pas_foto');
        $ext = $foto->getClientOriginalExtension();
        // $r['pas_foto'] = $request->file('pas_foto');

        $nameFoto = date('Y-m-d_H-i-s_') . "." . $ext;
        $destinationPath = public_path('upload/siswa');

        $foto->move($destinationPath, $nameFoto);

        $fileUrl = asset('upload/siswa/' . $nameFoto);
        // dd($destinationPath);
        $r['pas_foto'] = $nameFoto;
        // dd($r);

        // Menyimpan data guru
        Guru::create($r);

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
        $data = Guru::find($r['id']);

        $foto = $request->file('pas_foto');



        if ($request->hasFile('pas_foto')) {
            if ($foto->getSize() / 1024 >= 512) {
                return redirect()->route('siswa.edit', $r['id'])->with('message', 'size gambar');
            }
            $ext = $foto->getClientOriginalExtension();
            $nameFoto = date('Y-m-d_H-i-s_') . "." . $ext;
            $destinationPath = public_path('upload/siswa');

            $foto->move($destinationPath, $nameFoto);

            $fileUrl = asset('upload/siswa/' . $nameFoto);
            $r['pas_foto'] = $nameFoto;
        } else {
            $r['pas_foto'] = $request->thumbnail_old;
        }


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
