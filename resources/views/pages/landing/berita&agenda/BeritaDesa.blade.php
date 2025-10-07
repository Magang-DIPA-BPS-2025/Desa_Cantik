@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Berita</title>
<style>
body {
  font-family: 'Segoe UI', Arial, sans-serif;
  margin: 0;
  background: #f5f6fa;
}

/* khusus halaman berita */
.berita-page .container {
  max-width: 1500px;
  margin: 30px auto;
  padding: 0 20px;
}

/* Wrapper isi berita + sidebar */
.berita-page .content-wrapper {
  display: flex;
  gap: 25px;
}

/* Judul section */
.berita-page .section-title {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 25px;
  color: #222;
  border-left: 6px solid #4CAF50;
  padding-left: 12px;
}

/* Grid Berita */
.berita-page .berita-grid {
  flex: 4;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 25px;
}
.berita-page .berita-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s, box-shadow 0.3s;
  position: relative;
  min-height: 320px;
}
.berita-page .berita-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.berita-page .berita-card .thumb {
  width: 100%;
  height: 180px;
  background: #ccc;
  object-fit: cover;
  transition: transform 0.3s;
}
.berita-page .berita-card:hover .thumb {
  transform: scale(1.05);
}
.berita-page .berita-card .info {
  padding: 12px 15px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.berita-page .berita-card .info span {
  color: #777;
  font-size: 12px;
}
.berita-page .berita-card .info .title {
  font-size: 16px;
  font-weight: 600;
  color: #222;
  margin: 0;
}
.berita-page .berita-card .info .desc-text {
  font-size: 13px;
  color: #555;
  line-height: 1.4;
  margin-bottom: 6px;
}
.berita-page .berita-card .date {
  background: #4CAF50;
  color: #fff;
  font-weight: 600;
  padding: 4px 8px;
  font-size: 11px;
  position: absolute;
  bottom: 12px;
  right: 12px;
  border-radius: 5px;
}
.berita-page .berita-card .views {
  font-size: 11px;
  color: #888;
  display: flex;
  align-items: center;
  gap: 4px;
}

/* Sidebar */
.berita-page .sidebar {
  flex: 1;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.08);
  padding: 22px;
  height: fit-content;
}
.berita-page .sidebar h2 {
  font-size: 22px;
  margin-bottom: 22px;
  border-bottom: 2px solid #4CAF50;
  padding-bottom: 8px;
  color: #222;
}
.berita-page .sidebar .item {
  display: flex;
  gap: 12px;
  margin-bottom: 18px;
  transition: background 0.2s;
  padding: 6px;
  border-radius: 8px;
}
.berita-page .sidebar .item:hover {
  background: #f0f9f0;
}
.berita-page .sidebar .item .thumb {
  width: 65px;
  height: 45px;
  background: #ccc;
  flex-shrink: 0;
  border-radius: 6px;
  object-fit: cover;
}
.berita-page .sidebar .item .desc h4 {
  font-size: 15px;
  margin: 0 0 3px 0;
  color: #333;
}
.berita-page .sidebar .item .desc small {
  color: #777;
  font-size: 12px;
  display: block;
}
.berita-page .sidebar .item .desc .views {
  display: flex;
  align-items: center;
  gap: 4px;
  color: #888;
}

/* Pagination */
.berita-page .pagination {
  margin: 30px 0;
  text-align: center;
  grid-column: span 4;
}
.berita-page .pagination ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: inline-flex;
  gap: 10px;
  align-items: center;
}
.berita-page .pagination li {
  display: inline-block;
}
.berita-page .pagination a {
  text-decoration: none;
  color: #333;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 14px;
  transition: all 0.3s;
  border: 1px solid #ddd;
}
.berita-page .pagination .active a {
  background: #4CAF50;
  color: #fff;
  border-color: #4CAF50;
}
.berita-page .pagination a:hover {
  background: #4CAF50;
  color: #fff;
  border-color: #4CAF50;
}

/* Responsive */
@media (max-width: 1200px) {
  .berita-page .berita-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}
@media (max-width: 992px) {
  .berita-page .content-wrapper {
    flex-direction: column;
  }
  .berita-page .berita-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 768px) {
  .berita-page .berita-grid {
    grid-template-columns: 1fr;
  }
  .berita-page .sidebar {
    margin-top: 25px;
  }
}
</style>

<div class="berita-page">
  <div class="container">
    <div class="content-wrapper">
      <!-- Grid Berita -->
      <div style="flex:4">
        <div class="section-title">Daftar Berita</div>

        <div class="berita-grid">
          @forelse ($beritas as $item)
          <div class="berita-card">
            <img class="thumb" src="{{ $item->foto ? asset('storage/'.$item->foto) : asset('img/example-image.jpg') }}" alt="{{ $item->judul }}">
            <div class="info">
              <span>{{ optional($item->tanggal_event ? \Carbon\Carbon::parse($item->tanggal_event) : null)?->translatedFormat('d F Y') }}</span>
              <h3 class="title"><a href="{{ route('berita.show', $item->id) }}" style="text-decoration:none;color:inherit;">{{ $item->judul }}</a></h3>
              <p class="desc-text">{{ Str::limit($item->deskripsi_singkat, 120) }}</p>
              <div class="views">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#888" viewBox="0 0 16 16">
                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 4a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                  <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                </svg>
                Dilihat {{ $item->dilihat ?? 0 }} kali
              </div>
              @if($item->tanggal_event)
              <div class="date">{{ \Carbon\Carbon::parse($item->tanggal_event)->isoFormat('DD MMM YYYY') }}</div>
              @endif
            </div>
          </div>
          @empty
            <p>Tidak ada data berita.</p>
          @endforelse

          <div class="pagination">
            {{ $beritas->links() }}
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">
        <h2>Berita Terbaru</h2>
        @foreach(($latest_beritas ?? []) as $b)
        <div class="item">
          <img class="thumb" src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image-50.jpg') }}" alt="{{ $b->judul }}">
          <div class="desc">
            <h4><a href="{{ route('berita.show', $b->id) }}" style="text-decoration:none;color:inherit;">{{ $b->judul }}</a></h4>
            <small>{{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->isoFormat('DD MMM YYYY') : '' }}</small>
            <div class="views">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#888" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 4a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
              </svg>
              Dilihat {{ $b->dilihat ?? 0 }} kali
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
