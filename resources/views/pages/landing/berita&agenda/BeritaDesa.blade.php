{{-- resources/views/pages/landing/berita&agenda/BeritaDesa.blade.php --}}
@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Berita Desa</title>

<style>
.berita-container {
  max-width: 1200px;
  margin: 40px auto;
  padding: 0 20px;
}

.berita-header {
  margin-bottom: 40px;
}

.berita-header h1 {
  font-size: 2.5rem;
  color: #2c3e50;
  margin-bottom: 10px;
}

.berita-header p {
  color: #7f8c8d;
  font-size: 1.1rem;
}

.berita-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 30px;
  margin-bottom: 40px;
}

.berita-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.berita-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.berita-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.berita-content {
  padding: 25px;
}

.berita-content h3 {
  font-size: 1.3rem;
  color: #2c3e50;
  margin-bottom: 15px;
  line-height: 1.4;
}

.berita-content p {
  color: #7f8c8d;
  line-height: 1.6;
  margin-bottom: 15px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.berita-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.9rem;
  color: #95a5a6;
  margin-bottom: 15px;
}

.berita-meta span {
  display: flex;
  align-items: center;
  gap: 5px;
}

<style>
.read-more {
  display: inline-block;
  background: #4CAF50;
  color: white !important;
  padding: 10px 20px;
  border-radius: 25px;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.3s ease;
}

.read-more:hover {
  background: #45a049;
  color: white !important;
  text-decoration: none;
}
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 40px;
}

.pagination .page-link {
  color: #4CAF50;
  border: 1px solid #4CAF50;
  padding: 8px 16px;
  margin: 0 2px;
  border-radius: 5px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.pagination .page-link:hover {
  background: #4CAF50;
  color: white;
}

.pagination .page-item.active .page-link {
  background: #4CAF50;
  color: white;
  border-color: #4CAF50;
}

@media (max-width: 768px) {
  .berita-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .berita-header h1 {
    font-size: 2rem;
  }
}
</style>

<div class="berita-container">
  <div class="berita-header">
    <h1>Berita Desa</h1>
    <p>Informasi terbaru dan terpercaya dari Desa Cantik</p>
  </div>

  <div class="berita-grid">
    @forelse($beritas as $berita)
    <div class="berita-card">
      <img src="{{ $berita->foto ? asset('storage/'.$berita->foto) : asset('img/example-image.jpg') }}" alt="{{ $berita->judul }}">
      <div class="berita-content">
        <h3>{{ $berita->judul }}</h3>
        <div class="berita-meta">
          <span><i class="far fa-calendar"></i> {{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d F Y') : \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
          <span><i class="far fa-eye"></i> {{ $berita->dilihat ?? 0 }}</span>
        </div>
        <p>{{ $berita->deskripsi_singkat }}</p>
        <a href="{{ route('berita.show', $berita->id) }}" class="read-more">Baca Selengkapnya</a>
      </div>
    </div>
    @empty
    <div class="col-12 text-center">
      <p>Tidak ada berita tersedia saat ini.</p>
    </div>
    @endforelse
  </div>

  @if($beritas->hasPages())
  <div class="pagination">
    {{ $beritas->links() }}
  </div>
  @endif
</div>
@endsection
