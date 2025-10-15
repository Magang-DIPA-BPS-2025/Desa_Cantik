@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Berita Desa</title>

<style>
/* Container utama */
.container-berita {
  max-width: 1400px;
  margin: 40px auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: 1fr 350px;
  gap: 30px;
}

/* Grid berita */
.berita-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

/* Card berita */
.berita-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  overflow: hidden;
  transition: transform .3s ease, box-shadow .3s ease;
  cursor: pointer;
}

.berita-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.berita-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.berita-card .content {
  padding: 15px;
}

.berita-card h4 {
  font-size: 1.2rem;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 8px;
}

.berita-card small {
  display: block;
  font-size: 0.85rem;
  color: #888;
  margin-bottom: 10px;
}

.berita-card p {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 0;
}

/* Sidebar */
.sidebar {
  display: flex;
  flex-direction: column;
  gap: 25px;
}

.sidebar-box {
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  padding: 20px;
}

.sidebar-box h4 {
  font-weight: 700;
  margin-bottom: 15px;
  color: #222;
}

.sidebar-box input[type="text"] {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
}

.kategori-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.kategori-item {
  display: block;
  padding: 10px;
  border-radius: 8px;
  text-align: center;
  background: #e8f5e9;
  color: #388e3c;
  font-weight: 600;
  text-decoration: none;
  transition: background .2s, color .2s;
}

.kategori-item:hover {
  background: #4CAF50;
  color: white;
}

.kategori-item.active {
  background: #4CAF50;
  color: white;
}

.berita-terbaru-item {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}

.berita-terbaru-item img {
  width: 60px;
  height: 50px;
  object-fit: cover;
  border-radius: 6px;
}

.berita-terbaru-item a {
  color: #2c3e50;
  font-weight: 600;
  text-decoration: none;
}

.berita-terbaru-item small {
  display: block;
  color: #888;
  font-size: 0.8rem;
}

/* Responsive */
@media (max-width: 1200px) {
  .berita-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
  .container-berita { grid-template-columns: 1fr; }
  .berita-grid { grid-template-columns: 1fr; }
}
</style>

<div class="container-berita">
  <!-- Bagian kiri: Berita -->
  <div>
    <h2 style="margin-bottom:20px; font-weight:700;">Berita Desa</h2>
    <div class="berita-grid">
      @forelse($beritas as $berita)
      <a href="{{ route('berita.show', $berita->id) }}" style="text-decoration: none; color: inherit;">
        <div class="berita-card">
          <img src="{{ $berita->foto ? asset('storage/'.$berita->foto) : asset('img/example-image.jpg') }}" alt="{{ $berita->judul }}">
          <div class="content">
            <h4>{{ $berita->judul }}</h4>
            <small>
              {{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
              | {{ $berita->kategori->nama ?? 'Umum' }}
            </small>
            <p>{{ Str::limit($berita->deskripsi_singkat, 120) }}</p>
          </div>
        </div>
      </a>
      @empty
      <p>Tidak ada berita ditemukan.</p>
      @endforelse
    </div>

    <div class="mt-4">
      {{ $beritas->links() }}
    </div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    {{-- Pencarian --}}
    <div class="sidebar-box">
      <h4>CARI BERITA</h4>
      <form method="GET" action="{{ route('berita') }}">
        <input type="text" name="search" placeholder="Cari berita..." value="{{ $search }}">
      </form>
    </div>

    {{-- Kategori --}}
    <div class="sidebar-box">
      <h4>KATEGORI BERITA</h4>
      <div class="kategori-list">
        <a href="{{ route('berita') }}" 
           class="kategori-item {{ !$kategoriSelected ? 'active' : '' }}">Semua</a>
        @foreach($kategoriList as $kategori)
        <a href="{{ route('berita', ['kategori' => $kategori]) }}" 
           class="kategori-item {{ $kategoriSelected == $kategori ? 'active' : '' }}">
          {{ $kategori }}
        </a>
        @endforeach
      </div>
    </div>

    {{-- Berita Terbaru --}}
    <div class="sidebar-box">
      <h4>BERITA TERBARU</h4>
      @foreach($latest_beritas as $b)
      <div class="berita-terbaru-item">
        <img src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}">
        <div>
          <a href="{{ route('berita.show', $b->id) }}">{{ Str::limit($b->judul, 40) }}</a>
          <small>{{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->translatedFormat('d M Y') : $b->created_at->translatedFormat('d M Y') }}</small>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
