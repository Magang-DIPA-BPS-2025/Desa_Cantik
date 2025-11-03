<?php

    namespace App\Http\Controllers;

    use App\Models\BelanjaDesa;
    use App\Models\Agenda;
    use App\Models\Berita;
    use App\Models\Galeri;
    use App\Models\Kategori;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class BeritaController extends Controller
    {
           public function index()
    {
        $datas = Berita::with('kategori')->latest()->get(); // TAMBAHKAN ->get()

        return view('pages.admin.berita.index', [
            'datas' => $datas,
            'menu'  => 'berita',
            'title' => 'Manajemen Berita Desa'
        ]);
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('pages.admin.berita.create', [
        'kategoris' => $kategoris,
        'menu'      => 'berita',
        'title'     => 'Tambah Berita Desa'
        ]);
    }
        public function store(Request $request)
        {
            $request->validate([
                'id_kategori'        => 'nullable|exists:kategoris,id',
                'judul'              => 'required|string|max:255',
                'deskripsi_singkat'  => 'required|string',
                'tanggal_event'      => 'nullable|date',
                'foto'               => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = [
                'id_kategori'       => $request->id_kategori,
                'judul'             => $request->judul,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'tanggal_event'     => $request->tanggal_event,
                'dilihat'           => 0,
            ];

            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('berita_desa', 'public');
            }

            Berita::create($data);

            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
        }

        public function edit($id)
        {
            $berita = Berita::findOrFail($id);
            $kategoris = Kategori::all();

            return view('pages.admin.berita.edit', [
                'berita'    => $berita,
                'kategoris' => $kategoris,
                'menu'      => 'berita',
                'title'     => 'Edit Berita Desa'
            ]);
        }

        public function update(Request $request, $id)
        {
            $berita = Berita::findOrFail($id);

            $request->validate([
                'id_kategori'        => 'nullable|exists:kategoris,id',
                'judul'              => 'required|string|max:255',
                'deskripsi_singkat'  => 'required|string',
                'tanggal_event'      => 'nullable|date',
                'foto'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = [
                'id_kategori'       => $request->id_kategori,
                'judul'             => $request->judul,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'tanggal_event'     => $request->tanggal_event,
            ];

            if ($request->hasFile('foto')) {
                if ($berita->foto) {
                    Storage::disk('public')->delete($berita->foto);
                }
                $data['foto'] = $request->file('foto')->store('berita_desa', 'public');
            }

            $berita->update($data);

            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
        }

        public function show($id)
        {
            $berita = Berita::with('kategori')->findOrFail($id);

            return view('pages.admin.berita.show', [
                'berita' => $berita,
                'menu'  => 'berita',
                'title' => 'Detail Berita Desa'
            ]);
        }

        public function destroy($id)
        {
            $berita = Berita::findOrFail($id);

            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }

            $berita->delete();

            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
        }

        /**
         * Menampilkan berita untuk user landing page
         */
    public function userIndex(Request $request)
    {
        $kategoriSelected = $request->query('kategori');
        $search = $request->query('search');

        $query = Berita::with('kategori')->latest();

        if (!empty($kategoriSelected)) {
            $query->whereHas('kategori', function($q) use ($kategoriSelected) {
                $q->where('nama', $kategoriSelected);
            });
        }

        if (!empty($search)) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        $beritas = $query->paginate(6)->appends($request->query());
        $latest_beritas = Berita::latest()->take(5)->get();
        $kategoriList = Kategori::select('nama')->distinct()->orderBy('nama')->pluck('nama');

        return view('pages.landing.berita&agenda.BeritaDesa', [
            'beritas' => $beritas,
            'latest_beritas' => $latest_beritas,
            'kategoriList' => $kategoriList,
            'kategoriSelected' => $kategoriSelected,
            'search' => $search,
        ]);
    }

    public function userShow($id)
    {
        $berita = Berita::with('kategori')->findOrFail($id);
        $berita->increment('dilihat');

        $latest_beritas = Berita::latest()->take(5)->get();

        return view('pages.landing.detail-berita', [
            'berita' => $berita,
            'latest_beritas' => $latest_beritas,
        ]);
    }

    public function userBeranda()
        {
            $beritas = Berita::with('kategori')->latest()->take(6)->get();
            $latest_agendas = Agenda::latest()->take(6)->get();
            $belanjas = BelanjaDesa::latest()->take(6)->get();
            $galeris = Galeri::latest()->take(6)->get();

            return view('pages.landing.index', [
                'beritas' => $beritas,
                'latest_agendas' => $latest_agendas,
                'belanjas' => $belanjas,
                'galeris' => $galeris,
            ]);
        }

    }
