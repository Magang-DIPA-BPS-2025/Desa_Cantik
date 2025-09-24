<?php

namespace App\Http\Controllers;

use App\Models\PemerintahDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemerintahDesaController extends Controller
{
    public function index()
    {
        $datas = PemerintahDesa::all();

        return view('pages.admin.pemerintahDesa.index', [
            'datas' => $datas,
            'menu'  => 'pemerintah-desa',
            'title' => 'Pemerintah Desa'
        ]);
    }

    public function create()
    {
        return view('pages.admin.pemerintahDesa.create', [
            'menu'  => 'pemerintah-desa',
            'title' => 'Tambah Pemerintah Desa'
        ]);
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
        return view('pages.admin.pemerintahDesa.show', [
            'pemerintahDesa' => $pemerintahDesa,
            'menu'  => 'pemerintah-desa',
            'title' => 'Detail Pemerintah Desa'
        ]);
    }

    public function edit(PemerintahDesa $pemerintahDesa)
    {
        return view('pages.admin.pemerintahDesa.edit', [
            'pemerintahDesa' => $pemerintahDesa,
            'menu'  => 'pemerintah-desa',
            'title' => 'Edit Pemerintah Desa'
        ]);
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
}
