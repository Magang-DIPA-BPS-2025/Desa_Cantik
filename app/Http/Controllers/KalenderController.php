<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kalender;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KalenderController extends Controller
{
    // Menampilkan halaman index
    public function index()
    {
        $kegiatans = Kalender::latest()->paginate(12);
        return view('pages.admin.kalender.index', compact('kegiatans'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('pages.admin.kalender.create');
    }

    // Simpan kegiatan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
        ]);

        Kalender::create($validated);

        return redirect()->route('kalender.index')
                        ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $kalender = Kalender::findOrFail($id);
        return view('pages.admin.kalender.edit', compact('kalender'));
    }

    // Update kegiatan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
        ]);

        $kalender = Kalender::findOrFail($id);
        $kalender->update($validated);

        return redirect()->route('kalender.index')
                        ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // Hapus kegiatan
    public function destroy($id)
    {
        $kalender = Kalender::findOrFail($id);
        $kalender->delete();

        return redirect()->route('kalender.index')
                        ->with('success', 'Kegiatan berhasil dihapus.');
    }

    // Ambil semua kegiatan berdasarkan tahun (untuk kalender dashboard) - OPSIONAL
    public function getEvents(Request $request)
    {
        $year = $request->query('year', now()->year);
        $events = Kalender::whereYear('tanggal', $year)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->nama_kegiatan,
                    'date' => $item->tanggal->format('Y-m-d'),
                ];
            });

        return response()->json($events);
    }

    public function getKalenderData()
{
    $kegiatan = \App\Models\Kalender::select('nama_kegiatan', 'tanggal_kegiatan')->get();
    return response()->json($kegiatan);
}



}
