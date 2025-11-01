<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use App\Models\PemerintahDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // IMPORT CARBON DI SINI

class PemerintahDesaController extends Controller
{
    // ===================== ADMIN =====================
    public function index(Request $request)
{
    $perPage = $request->get('perPage', 10);
    $search = $request->get('search', '');

    $query = PemerintahDesa::query();

    // Filter berdasarkan pencarian
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%')
              ->orWhere('jabatan', 'like', '%' . $search . '%')
              ->orWhere('tupoksi', 'like', '%' . $search . '%');
        });
    }

    $datas = $query->paginate($perPage);

    return view('pages.admin.pemerintahDesa.index', compact('datas', 'search', 'perPage'))
        ->with(['menu' => 'pemerintah-desa', 'title' => 'Pemerintah Desa']);
}
    public function create()
    {
        return view('pages.admin.pemerintahDesa.create')
            ->with(['menu' => 'pemerintah-desa', 'title' => 'Tambah Pemerintah Desa']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tupoksi' => 'nullable|string',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pemerintah-desa', 'public');
        }

        PemerintahDesa::create($validated);

        return redirect()->route('pemerintah-desa.index')
            ->with('success', 'Data Pemerintah Desa berhasil ditambahkan.');
    }

    public function show(PemerintahDesa $pemerintahDesa)
    {
        return view('pages.admin.pemerintahDesa.show', compact('pemerintahDesa'))
            ->with(['menu' => 'pemerintah-desa', 'title' => 'Detail Pemerintah Desa']);
    }

    public function edit(PemerintahDesa $pemerintahDesa)
    {
        return view('pages.admin.pemerintahDesa.edit', compact('pemerintahDesa'))
            ->with(['menu' => 'pemerintah-desa', 'title' => 'Edit Pemerintah Desa']);
    }

    public function update(Request $request, PemerintahDesa $pemerintahDesa)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tupoksi' => 'nullable|string',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($pemerintahDesa->foto) {
                Storage::disk('public')->delete($pemerintahDesa->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pemerintah-desa', 'public');
        }

        $pemerintahDesa->update($validated);

        return redirect()->route('pemerintah-desa.index')
            ->with('success', 'Data Pemerintah Desa berhasil diperbarui.');
    }

    public function destroy(PemerintahDesa $pemerintahDesa)
    {
        if ($pemerintahDesa->foto && Storage::disk('public')->exists($pemerintahDesa->foto)) {
            Storage::disk('public')->delete($pemerintahDesa->foto);
        }

        $pemerintahDesa->delete();

        return redirect()->route('pemerintah-desa.index')
            ->with('success', 'Data Pemerintah Desa berhasil dihapus.');
    }

    // ===================== USER =====================
public function userIndex()
{
    $pemerintahDesas = PemerintahDesa::all();

    // Ambil bulan & tahun dari query string, default sekarang
    $month = request('month', \Carbon\Carbon::now()->month);
    $year  = request('year', \Carbon\Carbon::now()->year);

    // Query events dari model Kalender - dengan namespace lengkap Carbon
    $events = Kalender::whereMonth('tanggal_kegiatan', $month)
            ->whereYear('tanggal_kegiatan', $year)
            ->get()
            ->groupBy(function ($kalender) {
                return \Carbon\Carbon::parse($kalender->tanggal_kegiatan)->format('Y-m-d');
            });

    $firstDay = \Carbon\Carbon::create($year, $month, 1);
    $daysInMonth = $firstDay->daysInMonth;
    $startDayOfWeek = $firstDay->dayOfWeek; // Minggu=0, Senin=1, dst

    // Data untuk navigasi
    $prevMonth = $month == 1 ? 12 : $month - 1;
    $prevYear = $month == 1 ? $year - 1 : $year;
    $nextMonth = $month == 12 ? 1 : $month + 1;
    $nextYear = $month == 12 ? $year + 1 : $year;

    return view('pages.landing.profildesa.PemerintahDesa', compact(
        'pemerintahDesas',
        'month',
        'year',
        'events',
        'daysInMonth',
        'startDayOfWeek',
        'prevMonth',
        'prevYear',
        'nextMonth',
        'nextYear'
    ));
}
}
