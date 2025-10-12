<?php

namespace App\Http\Controllers;

use App\Models\Ppid;
use Illuminate\Http\Request;

class PPIDController extends Controller
{
    public function index()
    {
        $ppids = Ppid::latest()->get();
        return view('', compact('ppids'));
    }

    public function create()
    {
        return view('pages.admin.ppid.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('ppid', 'public');
        }

        Ppid::create($data);

        return redirect()->route('ppid.index')->with('success', 'Data PPID berhasil ditambahkan.');
    }

       public function  userindex()
    {
        $ppids = Ppid::latest()->get();
        return view('pages.landing.PPID&UMKM.Ppid', compact('ppids'));
    }
}
