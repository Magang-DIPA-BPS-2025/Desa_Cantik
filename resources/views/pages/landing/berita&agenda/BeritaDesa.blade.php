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
  gap: 35px; /* Tambah jarak lebih besar antar card */
}

.sidebar-box {
  background: #fff;
  border-radius: 16px; /* Sedikit lebih rounded */
  box-shadow: 0 6px 20px rgba(0,0,0,0.08); /* Shadow lebih soft */
  padding: 30px 25px; /* Tambah padding atas-bawah lebih besar */
  border: 1px solid #f0f0f0;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.sidebar-box:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.sidebar-box h4 {
  font-weight: 700;
  margin-bottom: 20px;
  color: #2c3e50;
  font-size: 18px;
  padding-bottom: 15px;
  border-bottom: 3px solid #4CAF50;
}

.sidebar-box input[type="text"] {
  width: 100%;
  padding: 12px 15px;
  border-radius: 10px;
  border: 1px solid #e0e0e0;
  font-size: 14px;
  transition: all 0.3s ease;
  background: #fafafa;
}

.sidebar-box input[type="text"]:focus {
  outline: none;
  border-color: #4CAF50;
  box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
  background: #fff;
}

/* Dropdown Kategori untuk Desktop */
.kategori-dropdown {
  width: 100%;
  padding: 12px 15px;
  border-radius: 10px;
  border: 1px solid #e0e0e0;
  background: #fafafa;
  color: #333;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
}

.kategori-dropdown:hover {
  border-color: #4CAF50;
  background: #fff;
}

.kategori-dropdown:focus {
  outline: none;
  border-color: #4CAF50;
  box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
  background: #fff;
}

.kategori-dropdown option {
  padding: 12px;
  font-weight: 500;
  background: #fff;
}

.berita-terbaru-item {
  display: flex;
  align-items: center;
  gap: 15px; /* Tambah jarak antara gambar dan konten */
  margin-bottom: 20px;
  padding: 15px;
  border-radius: 12px;
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
}

.berita-terbaru-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(8px);
}

.berita-terbaru-item:last-child {
  margin-bottom: 0;
}

.berita-terbaru-item img {
  width: 75px; /* Sedikit lebih besar */
  height: 65px;
  object-fit: cover;
  border-radius: 10px;
  flex-shrink: 0;
}

.berita-terbaru-content {
  flex: 1;
}

.berita-terbaru-content .judul {
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 8px;
  font-size: 14px;
  line-height: 1.4;
}

.berita-terbaru-content .tanggal {
  color: #666;
  font-size: 12px;
  font-weight: 500;
}

/* Pagination Styles */
.pagination-container {
  display: flex;
  justify-content: flex-end;
  margin-top: 30px;
  padding: 15px 0;
}

.pagination {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
  gap: 5px;
}

.pagination li {
  display: inline-block;
}

.pagination li a,
.pagination li span {
  display: block;
  padding: 8px 15px;
  border-radius: 6px;
  text-decoration: none;
  border: 1px solid #dee2e6;
  color: #4CAF50;
  font-weight: 500;
  transition: all 0.2s ease;
}

.pagination li a:hover {
  background-color: #4CAF50;
  color: white;
  border-color: #4CAF50;
}

.pagination li.active span {
  background-color: #4CAF50;
  color: white;
  border-color: #4CAF50;
}

.pagination li.disabled span {
  color: #6c757d;
  background-color: #f8f9fa;
  border-color: #dee2e6;
}

/* Mobile Filter */
.mobile-filter {
  display: none;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  padding: 20px;
  margin-bottom: 20px;
}

.mobile-search-box {
  margin-bottom: 15px;
}

.mobile-search-box h4 {
  font-weight: 700;
  margin-bottom: 10px;
  color: #222;
  font-size: 16px;
}

.mobile-search-box input[type="text"] {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
}

.mobile-kategori-box {
  margin-bottom: 15px;
}

.mobile-kategori-box h4 {
  font-weight: 700;
  margin-bottom: 10px;
  color: #222;
  font-size: 16px;
}

.mobile-kategori-select {
  width: 100%;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  background: #fff;
  color: #333;
  font-size: 14px;
}

.mobile-kategori-select:focus {
  outline: none;
  border-color: #4CAF50;
}

/* Mobile Berita Terbaru */
.mobile-berita-terbaru {
  display: none;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  padding: 20px;
  margin-top: 20px;
}

.mobile-berita-terbaru h4 {
  font-weight: 700;
  margin-bottom: 15px;
  color: #222;
  font-size: 18px;
  padding-bottom: 10px;
  border-bottom: 2px solid #4CAF50;
}

.mobile-berita-item {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 15px;
  padding: 12px;
  border-radius: 10px;
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
}

.mobile-berita-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(5px);
}

.mobile-berita-item img {
  width: 70px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  flex-shrink: 0;
}

.mobile-berita-content {
  flex: 1;
}

.mobile-berita-content .judul {
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 5px;
  font-size: 14px;
  line-height: 1.3;
}

.mobile-berita-content .tanggal {
  color: #666;
  font-size: 12px;
  font-weight: 500;
}

/* Hide desktop sidebar elements on mobile */
.desktop-only {
  display: block;
}

.mobile-only {
  display: none;
}

/* Responsive */
@media (max-width: 1200px) {
  .berita-grid { 
    grid-template-columns: repeat(2, 1fr); 
  }
}

@media (max-width: 768px) {
  .container-berita { 
    grid-template-columns: 1fr; 
    gap: 20px;
  }
  
  .berita-grid { 
    grid-template-columns: 1fr; 
  }
  
  .pagination-container {
    justify-content: center;
  }
  
  .pagination {
    flex-wrap: wrap;
    justify-content: center;
  }
  
  /* Show mobile sections and hide desktop sidebar */
  .mobile-filter {
    display: block;
  }
  
  .mobile-berita-terbaru {
    display: block;
  }
  
  .desktop-only {
    display: none;
  }
  
  .mobile-only {
    display: block;
  }
  
  /* Adjust main content spacing */
  .container-berita > div:first-child {
    order: 2;
  }
  
  .sidebar {
    order: 3;
  }
}

@media (max-width: 480px) {
  .container-berita {
    margin: 20px auto;
    padding: 0 15px;
  }
  
  .berita-card .content {
    padding: 12px;
  }
  
  .berita-card h4 {
    font-size: 1.1rem;
  }
  
  .pagination li a,
  .pagination li span {
    padding: 6px 12px;
    font-size: 14px;
  }
  
  .mobile-berita-item {
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  
  .mobile-berita-item img {
    width: 100%;
    height: 80px;
  }
  
  .mobile-berita-content .judul {
    font-size: 13px;
  }
}
</style>

<!-- Mobile Filter Section (Hanya tampil di mobile) -->
<div class="mobile-filter mobile-only">
  <div class="mobile-search-box">
    <h4>CARI BERITA</h4>
    <form method="GET" action="{{ route('berita') }}" id="mobileSearchForm">
      <input type="text" name="search" placeholder="Cari berita..." value="{{ $search }}" 
             onchange="document.getElementById('mobileSearchForm').submit()">
    </form>
  </div>
  
  <div class="mobile-kategori-box">
    <h4>KATEGORI BERITA</h4>
    <select class="mobile-kategori-select" onchange="window.location.href=this.value">
      <option value="{{ route('berita') }}" {{ !$kategoriSelected ? 'selected' : '' }}>Semua Kategori</option>
      @foreach($kategoriList as $kategori)
      <option value="{{ route('berita', ['kategori' => $kategori]) }}" 
              {{ $kategoriSelected == $kategori ? 'selected' : '' }}>
        {{ $kategori }}
      </option>
      @endforeach
    </select>
  </div>
</div>

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
      <div class="col-12">
        <p class="text-center text-muted">Tidak ada berita ditemukan.</p>
      </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($beritas->hasPages())
    <div class="pagination-container">
      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($beritas->onFirstPage())
          <li class="disabled" aria-disabled="true">
            <span>&laquo;</span>
          </li>
        @else
          <li>
            <a href="{{ $beritas->previousPageUrl() }}" rel="prev">&laquo;</a>
          </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
          @if ($page == $beritas->currentPage())
            <li class="active" aria-current="page">
              <span>{{ $page }}</span>
            </li>
          @else
            <li>
              <a href="{{ $url }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($beritas->hasMorePages())
          <li>
            <a href="{{ $beritas->nextPageUrl() }}" rel="next">&raquo;</a>
          </li>
        @else
          <li class="disabled" aria-disabled="true">
            <span>&raquo;</span>
          </li>
        @endif
      </ul>
    </div>
    @endif
  </div>

  <!-- Sidebar (Desktop Only) -->
  <div class="sidebar desktop-only">
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
      <select class="kategori-dropdown" onchange="window.location.href=this.value">
        <option value="{{ route('berita') }}" {{ !$kategoriSelected ? 'selected' : '' }}>Semua Kategori</option>
        @foreach($kategoriList as $kategori)
        <option value="{{ route('berita', ['kategori' => $kategori]) }}" 
                {{ $kategoriSelected == $kategori ? 'selected' : '' }}>
          {{ $kategori }}
        </option>
        @endforeach
      </select>
    </div>

    {{-- Berita Terbaru - Dapat diklik --}}
    <div class="sidebar-box">
      <h4>BERITA TERBARU</h4>
      @foreach($latest_beritas as $b)
      <a href="{{ route('berita.show', $b->id) }}" style="text-decoration: none; color: inherit;">
        <div class="berita-terbaru-item">
          <img src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}" alt="{{ $b->judul }}">
          <div class="berita-terbaru-content">
            <div class="judul">{{ Str::limit($b->judul, 50) }}</div>
            <div class="tanggal">
              {{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->translatedFormat('d M Y') : $b->created_at->translatedFormat('d M Y') }}
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>

<!-- Mobile Berita Terbaru Section (Hanya tampil di mobile) -->
<div class="mobile-berita-terbaru mobile-only">
  <h4>BERITA TERBARU</h4>
  @foreach($latest_beritas as $b)
  <a href="{{ route('berita.show', $b->id) }}" style="text-decoration: none; color: inherit;">
    <div class="mobile-berita-item">
      <img src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}" alt="{{ $b->judul }}">
      <div class="mobile-berita-content">
        <div class="judul">{{ Str::limit($b->judul, 50) }}</div>
        <div class="tanggal">
          {{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->translatedFormat('d M Y') : $b->created_at->translatedFormat('d M Y') }}
        </div>
      </div>
    </div>
  </a>
  @endforeach
</div>

<script>
// Auto submit form ketika pencarian selesai (setelah user berhenti mengetik)
let searchTimeout;
document.querySelectorAll('input[name="search"]').forEach(input => {
  input.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
      this.form.submit();
    }, 800); // Submit setelah 800ms berhenti mengetik
  });
});

// Untuk kategori dropdown (desktop dan mobile)
document.querySelectorAll('.kategori-dropdown, .mobile-kategori-select').forEach(select => {
  select.addEventListener('change', function() {
    window.location.href = this.value;
  });
});
</script>

@endsection