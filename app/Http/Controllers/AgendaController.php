<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'kategori'          => 'required|string|in:Umum,Rapat,Pelatihan,Sosialisasi,Acara Resmi,Internal,Eksternal',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi foto
        ]);

        // Upload foto (jika ada)
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('agenda_foto', 'public');
        }

        Agenda::create([
            'nama_kegiatan'     => trim($request->nama_kegiatan),
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'deskripsi'         => $request->filled('deskripsi') ? trim($request->deskripsi) : null,
            'kategori'          => trim($request->kategori),
            'foto'              => $fotoPath,
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
            'kategori'          => 'required|string|in:Umum,Rapat,Pelatihan,Sosialisasi,Acara Resmi,Internal,Eksternal',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validasi foto
        ]);

        $agenda = Agenda::findOrFail($id);

        // Update foto (jika ada foto baru)
        if ($request->hasFile('foto')) {
            // hapus foto lama kalau ada
            if ($agenda->foto && Storage::disk('public')->exists($agenda->foto)) {
                Storage::disk('public')->delete($agenda->foto);
            }
            $fotoPath = $request->file('foto')->store('agenda_foto', 'public');
            $agenda->foto = $fotoPath;
        }

        // Update data lain
        $agenda->update([
            'nama_kegiatan'     => trim($request->nama_kegiatan),
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'deskripsi'         => $request->filled('deskripsi') ? trim($request->deskripsi) : null,
            'kategori'          => trim($request->kategori),
            'foto'              => $agenda->foto,
        ]);

        return redirect()->route('AgendaDesa.index')
            ->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        // hapus foto dari storage
        if ($agenda->foto && Storage::disk('public')->exists($agenda->foto)) {
            Storage::disk('public')->delete($agenda->foto);
        }

        $agenda->delete();

        return redirect()->route('AgendaDesa.index')
            ->with('success', 'Agenda berhasil dihapus');
    }

    /**
     * Menampilkan agenda untuk user landing page
     */
    public function userIndex(Request $request)
    {
        $kategoriSelected = $request->query('kategori');

        $query = Agenda::query()->latest();
        if (!empty($kategoriSelected)) {
            $query->where('kategori', $kategoriSelected);
        }

        $agendas = $query->paginate(9)->appends($request->query());
        $latest_agendas = Agenda::latest()->take(5)->get();
        $kategoriList = Agenda::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        return view('pages.landing.berita&agenda.AgendaDesa', [
            'agendas' => $agendas,
            'latest_agendas' => $latest_agendas,
            'kategoriList' => $kategoriList,
            'kategoriSelected' => $kategoriSelected,
        ]);
    }

    /**
     * Menampilkan detail agenda untuk user
     */
    public function userShow($id)
    {
        $agenda = Agenda::findOrFail($id);
        $latest_agendas = Agenda::latest()->take(5)->get();

        return view('pages.landing.detail-agenda', [
            'data' => $agenda,
            'jenis' => 'agenda',
            'latest_post' => $latest_agendas
        ]);
    }
}
