<?php

namespace App\Http\Controllers;

use App\Models\Ppid;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PPIDController extends Controller
{
   
    public function userindex()
    {
       
        try {
            $ppids = Ppid::orderBy('tanggal', 'desc')->get();
        } catch (\Exception $e) {
          
            $ppids = collect(); 
        }
        
    
        \Log::info('PPID Data sent to view', [
            'count' => $ppids->count(),
            'is_collection' => $ppids instanceof \Illuminate\Support\Collection
        ]);
        
        return view('pages.landing.PPID&UMKM.Ppid', compact('ppids'));
    }

   
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Ppid::query();

    
        if ($search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $ppids = $query->latest()->paginate($perPage);
        $menu = 'ppid';

        return view('pages.admin.ppid.index', compact('ppids', 'menu'));
    }

  
    public function berkala()
    {
    
        $berkalas = Ppid::where('kategori', 'berkala')
                         ->orderBy('tanggal', 'desc')
                         ->get();
        return view('pages.landing.PPID&UMKM.informasi-berkala', compact('berkalas'));
    }

 
    public function serta()
    {
        
        $sertas = Ppid::where('kategori', 'serta')
                      ->orderBy('tanggal', 'desc')
                      ->get();
        return view('pages.landing.PPID&UMKM.informasi-serta', compact('sertas'));
    }

    public function setiap()
    {
       
        $setiaps = Ppid::where('kategori', 'setiap')
                        ->orderBy('tanggal', 'desc')
                        ->get();
        return view('pages.landing.PPID&UMKM.informasi-setiap', compact('setiaps'));
    }

   
    public function create()
    {
        $menu = 'ppid';
        return view('pages.admin.ppid.create', compact('menu'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('ppid', 'public');
        }

        Ppid::create($data);

        return redirect()->route('ppid.index')->with('success', 'Data PPID berhasil ditambahkan.');
    }

  
    public function edit($id)
    {
        $ppid = Ppid::findOrFail($id);
        $menu = 'ppid';
        return view('pages.admin.ppid.edit', compact('ppid', 'menu'));
    }

    public function update(Request $request, $id)
    {
        $ppid = Ppid::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

    
        if ($request->hasFile('file')) {
            if ($ppid->file && Storage::disk('public')->exists($ppid->file)) {
                Storage::disk('public')->delete($ppid->file);
            }
            $data['file'] = $request->file('file')->store('ppid', 'public');
        } else {
            unset($data['file']); 
        }

        $ppid->update($data);

        return redirect()->route('ppid.index')->with('success', 'Data PPID berhasil diupdate.');
    }

  
    public function destroy($id)
    {
        $ppid = Ppid::findOrFail($id);

        if ($ppid->file && Storage::disk('public')->exists($ppid->file)) {
            Storage::disk('public')->delete($ppid->file);
        }

        $ppid->delete();

        return redirect()->route('ppid.index')->with('success', 'Data PPID berhasil dihapus.');
    }
}