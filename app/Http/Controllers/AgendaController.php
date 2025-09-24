<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $datas = Agenda::all();

        return view('pages.admin.AgendaDesa.index', [
            'datas' => $datas,
            'menu'  => 'AgendaDesa',
            'title' => 'Agenda Desa'
        ]);
    }

    public function create()
    {
        $kategoriOptions = ['Umum', 'Rapat', 'Pelatihan', 'Sosialisasi', 'Acara Resmi', 'Internal', 'Eksternal'];

        return view('pages.admin.AgendaDesa.create', [
            'menu'      => 'AgendaDesa',
            'title'     => 'Tambah Agenda Desa',
            'kategoriOptions' => $kategoriOptions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'     => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|date',
            'deskripsi'         => 'nullable|string',
            'kategori'          => 'required|string',
        ]);

        Agenda::create([
            'nama_kegiatan'     => $request->nama_kegiatan,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'deskripsi'         => $request->deskripsi,
            'kategori'          => $request->kategori,
        ]);

        return redirect()->route('AgendaDesa.index')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $kategoriOptions = ['Umum', 'Rapat', 'Pelatihan', 'Sosialisasi', 'Acara Resmi', 'Internal', 'Eksternal'];

        return view('pages.admin.AgendaDesa.edit', [
            'agenda' => $agenda,
            'menu'   => 'AgendaDesa',
            'title'  => 'Edit Agenda Desa',
            'kategoriOptions' => $kategoriOptions
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan'     => 'required|string|max:255',
            'waktu_pelaksanaan' => 'required|date',
            'deskripsi'         => 'nullable|string',
            'kategori'          => 'required|string',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update([
            'nama_kegiatan'     => $request->nama_kegiatan,
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'deskripsi'         => $request->deskripsi,
            'kategori'          => $request->kategori,
        ]);

        return redirect()->route('AgendaDesa.index')
            ->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('AgendaDesa.index')
            ->with('success', 'Agenda berhasil dihapus');
    }
}
