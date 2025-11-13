<?php

namespace App\Http\Controllers;

use App\Models\BelanjaDesa;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Kalender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KalenderExport;

class AgendaController extends Controller
{
    /* ======================= AGENDA DESA ======================= */

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Agenda::query();

        // Tambahkan pencarian jika ada
        if ($search) {
            $query->where('nama_kegiatan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $datas = $query->paginate($perPage);

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
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('agenda_foto', 'public');
        }

        Agenda::create([
            'nama_kegiatan'     => trim($request->nama_kegiatan),
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'deskripsi'         => $request->deskripsi,
            'kategori'          => $request->kategori,
            'foto'              => $fotoPath,
            'dilihat'           => 0,
        ]);

        return redirect()->route('AgendaDesa.index')->with('success', 'Agenda berhasil ditambahkan');
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
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $agenda = Agenda::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($agenda->foto && Storage::disk('public')->exists($agenda->foto)) {
                Storage::disk('public')->delete($agenda->foto);
            }
            $agenda->foto = $request->file('foto')->store('agenda_foto', 'public');
        }

        $agenda->update([
            'nama_kegiatan'     => trim($request->nama_kegiatan),
            'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
            'deskripsi'         => $request->deskripsi,
            'kategori'          => $request->kategori,
            'foto'              => $agenda->foto,
        ]);

        return redirect()->route('AgendaDesa.index')->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        if ($agenda->foto && Storage::disk('public')->exists($agenda->foto)) {
            Storage::disk('public')->delete($agenda->foto);
        }
        $agenda->delete();

        return redirect()->route('AgendaDesa.index')->with('success', 'Agenda berhasil dihapus');
    }

    /* ======================= KALENDER DESA ======================= */

    public function kalenderIndex()
    {
        $kalenders = Kalender::latest()->paginate(10);

        return view('pages.admin.KalenderDesa.index', [
            'kalenders' => $kalenders,
            'menu' => 'KalenderDesa',
            'title' => 'Kalender Desa'
        ]);
    }

    public function kalenderCreate()
    {
        return view('pages.admin.KalenderDesa.create', [
            'menu' => 'KalenderDesa',
            'title' => 'Tambah Kegiatan Kalender'
        ]);
    }

    public function kalenderStore(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        Kalender::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('kalenderDesa.index')->with('success', 'Kegiatan berhasil ditambahkan ke kalender.');
    }

    public function kalenderEdit($id)
    {
        $kalender = Kalender::findOrFail($id);

        return view('pages.admin.KalenderDesa.edit', [
            'kalender' => $kalender,
            'menu' => 'KalenderDesa',
            'title' => 'Edit Kegiatan Kalender'
        ]);
    }

    public function kalenderUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $kalender = Kalender::findOrFail($id);
        $kalender->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('kalenderDesa.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function kalenderDestroy($id)
    {
        $kalender = Kalender::findOrFail($id);
        $kalender->delete();

        return redirect()->route('kalenderDesa.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    // ✅ Export Excel
    public function kalenderExportExcel()
    {
        return Excel::download(new KalenderExport, 'kalender_desa.xlsx');
    }

    /* ======================= UNTUK USER LANDING ======================= */

    public function userIndex(Request $request)
{
    $kategoriSelected = $request->query('kategori');
    $search = $request->query('search');

    $query = Agenda::query()->latest();
    
    if (!empty($kategoriSelected)) {
        $query->where('kategori', $kategoriSelected);
    }
    
    if (!empty($search)) {
        $query->where('nama_kegiatan', 'like', '%' . $search . '%');
    }

    // Tampilkan SEMUA agenda tanpa pagination
    $agendas = $query->get();

    $latest_agendas = Agenda::orderBy('dilihat', 'desc')
                           ->take(5)
                           ->get();
    
    $kategoriList = Agenda::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

    return view('pages.landing.berita&agenda.AgendaDesa', [
        'agendas' => $agendas,
        'latest_agendas' => $latest_agendas,
        'kategoriList' => $kategoriList,
        'kategoriSelected' => $kategoriSelected,
        'search' => $search,
    ]);
}

    public function userShow($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->increment('dilihat');

        // PERBAIKAN: Untuk sidebar detail agenda, urutkan berdasarkan dilihat
        $latest_agendas = Agenda::where('id', '!=', $id)
                               ->orderBy('dilihat', 'desc')
                               ->take(6)
                               ->get();

        return view('pages.landing.detail-agenda', [
            'data' => $agenda,
            'jenis' => 'agenda',
            'latest_agendas' => $latest_agendas
        ]);
    }

    public function userBeranda()
    {
        // PERBAIKAN: Untuk homepage, tampilkan agenda dengan dilihat terbanyak
        $latest_agendas = Agenda::orderBy('dilihat', 'desc')
                               ->take(6)
                               ->get();
        
        $beritas = Berita::with('kategori')->latest()->take(6)->get();
        $belanjas = BelanjaDesa::latest()->take(6)->get();
        $galeris = Galeri::latest()->take(6)->get();
        $kalenders = Kalender::latest()->take(6)->get();

        return view('pages.landing.index', [
            'beritas' => $beritas,
            'latest_agendas' => $latest_agendas,
            'belanjas' => $belanjas,
            'galeris' => $galeris,
            'kalenders' => $kalenders,
        ]);
    }
}