@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Agenda</title>

<style>
/* Container utama */
.container-agenda {
  max-width: 1400px;
  margin: 40px auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: 1fr 350px;
  gap: 30px;
}

/* Grid agenda */
.agenda-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}

/* Card agenda */
.agenda-card {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  overflow: hidden;
  transition: transform .3s ease, box-shadow .3s ease;
  cursor: pointer;
}

.agenda-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.agenda-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.agenda-card .content {
  padding: 15px;
}

.agenda-card h4 {
  font-size: 1.2rem;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 8px;
  line-height: 1.3;
}

.agenda-card small {
  display: block;
  font-size: 0.85rem;
  color: #888;
  margin-bottom: 10px;
}

.agenda-card p {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 0;
  line-height: 1.5;
}

/* Sidebar */
.sidebar {
  display: flex;
  flex-direction: column;
  gap: 35px;
}

.sidebar-box {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.08);
  padding: 30px 25px;
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

.agenda-terbaru-item {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 20px;
  padding: 15px;
  border-radius: 12px;
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
}

.agenda-terbaru-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(8px);
}

.agenda-terbaru-item:last-child {
  margin-bottom: 0;
}

.agenda-terbaru-item img {
  width: 75px;
  height: 65px;
  object-fit: cover;
  border-radius: 10px;
  flex-shrink: 0;
}

.agenda-terbaru-content {
  flex: 1;
}

.agenda-terbaru-content .judul {
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 8px;
  font-size: 14px;
  line-height: 1.4;
}

.agenda-terbaru-content .tanggal {
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

/* Mobile Agenda Terbaru */
.mobile-agenda-terbaru {
  display: none;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  padding: 20px;
  margin-top: 20px;
}

.mobile-agenda-terbaru h4 {
  font-weight: 700;
  margin-bottom: 15px;
  color: #222;
  font-size: 18px;
  padding-bottom: 10px;
  border-bottom: 2px solid #4CAF50;
}

.mobile-agenda-item {
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

.mobile-agenda-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(5px);
}

.mobile-agenda-item img {
  width: 70px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  flex-shrink: 0;
}

.mobile-agenda-content {
  flex: 1;
}

.mobile-agenda-content .judul {
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 5px;
  font-size: 14px;
  line-height: 1.3;
}

.mobile-agenda-content .tanggal {
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
  .agenda-grid { 
    grid-template-columns: repeat(2, 1fr); 
  }
}

@media (max-width: 768px) {
  .container-agenda { 
    grid-template-columns: 1fr; 
    gap: 20px;
  }
  
  .agenda-grid { 
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
  
  .mobile-agenda-terbaru {
    display: block;
  }
  
  .desktop-only {
    display: none;
  }
  
  .mobile-only {
    display: block;
  }
  
  /* Adjust main content spacing */
  .container-agenda > div:first-child {
    order: 2;
  }
  
  .sidebar {
    order: 3;
  }
}

@media (max-width: 480px) {
  .container-agenda {
    margin: 20px auto;
    padding: 0 15px;
  }
  
  .agenda-card .content {
    padding: 12px;
  }
  
  .agenda-card h4 {
    font-size: 1.1rem;
  }
  
  .pagination li a,
  .pagination li span {
    padding: 6px 12px;
    font-size: 14px;
  }
  
  .mobile-agenda-item {
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  
  .mobile-agenda-item img {
    width: 100%;
    height: 80px;
  }
  
  .mobile-agenda-content .judul {
    font-size: 13px;
  }
}
</style>

<!-- Mobile Filter Section (Hanya tampil di mobile) -->
<div class="mobile-filter mobile-only">
  <div class="mobile-search-box">
    <h4>CARI AGENDA</h4>
    <form method="GET" action="{{ route('agenda') }}" id="mobileSearchForm">
      <input type="text" name="search" placeholder="Cari agenda..." value="{{ request('search') }}" 
             onchange="document.getElementById('mobileSearchForm').submit()">
    </form>
  </div>
  
  <div class="mobile-kategori-box">
    <h4>KATEGORI AGENDA</h4>
    <select class="mobile-kategori-select" onchange="window.location.href=this.value">
      <option value="{{ route('agenda') }}" {{ !request('kategori') ? 'selected' : '' }}>Semua Kategori</option>
      @foreach($kategoriList as $kategori)
      <option value="{{ route('agenda', ['kategori' => $kategori]) }}" 
              {{ request('kategori') == $kategori ? 'selected' : '' }}>
        {{ $kategori }}
      </option>
      @endforeach
    </select>
  </div>
</div>

<div class="container-agenda">
  <!-- Bagian kiri: Agenda -->
  <div>
    <h2 style="margin-bottom:20px; font-weight:700;">Agenda Desa</h2>
    <div class="agenda-grid">
      @forelse($agendas as $agenda)
      <a href="{{ route('agenda.show', $agenda->id) }}" style="text-decoration: none; color: inherit;">
        <div class="agenda-card">
          <img src="{{ $agenda->foto ? asset('storage/'.$agenda->foto) : asset('img/example-image.jpg') }}" alt="{{ $agenda->nama_kegiatan }}">
          <div class="content">
            <h4>{{ $agenda->nama_kegiatan }}</h4>
            <small>
              📅 {{ $agenda->waktu_pelaksanaan ? \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->translatedFormat('d F Y') : 'Tanggal belum ditentukan' }}
              @if($agenda->kategori) | 📍 {{ $agenda->kategori }} @endif
            </small>
            <p>{{ Str::limit($agenda->deskripsi, 120) }}</p>
          </div>
        </div>
      </a>
      @empty
      <div class="col-12">
        <p class="text-center text-muted">Tidak ada agenda ditemukan.</p>
      </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($agendas->hasPages())
    <div class="pagination-container">
      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($agendas->onFirstPage())
          <li class="disabled" aria-disabled="true">
            <span>&laquo;</span>
          </li>
        @else
          <li>
            <a href="{{ $agendas->previousPageUrl() }}" rel="prev">&laquo;</a>
          </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($agendas->getUrlRange(1, $agendas->lastPage()) as $page => $url)
          @if ($page == $agendas->currentPage())
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
        @if ($agendas->hasMorePages())
          <li>
            <a href="{{ $agendas->nextPageUrl() }}" rel="next">&raquo;</a>
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
      <h4>CARI AGENDA</h4>
      <form method="GET" action="{{ route('agenda') }}">
        <input type="text" name="search" placeholder="Cari agenda..." value="{{ request('search') }}">
      </form>
    </div>

    {{-- Kategori --}}
    <div class="sidebar-box">
      <h4>KATEGORI AGENDA</h4>
      <select class="kategori-dropdown" onchange="window.location.href=this.value">
        <option value="{{ route('agenda') }}" {{ !request('kategori') ? 'selected' : '' }}>Semua Kategori</option>
        @foreach($kategoriList as $kategori)
        <option value="{{ route('agenda', ['kategori' => $kategori]) }}" 
                {{ request('kategori') == $kategori ? 'selected' : '' }}>
          {{ $kategori }}
        </option>
        @endforeach
      </select>
    </div>

    {{-- Agenda Terbaru - Dapat diklik --}}
    <div class="sidebar-box">
      <h4>AGENDA TERBARU</h4>
      @foreach($latest_agendas as $a)
      <a href="{{ route('agenda.show', $a->id) }}" style="text-decoration: none; color: inherit;">
        <div class="agenda-terbaru-item">
          <img src="{{ $a->foto ? asset('storage/'.$a->foto) : asset('img/example-image.jpg') }}" alt="{{ $a->nama_kegiatan }}">
          <div class="agenda-terbaru-content">
            <div class="judul">{{ Str::limit($a->nama_kegiatan, 50) }}</div>
            <div class="tanggal">
              📅 {{ $a->waktu_pelaksanaan ? \Carbon\Carbon::parse($a->waktu_pelaksanaan)->translatedFormat('d M Y') : 'Tanggal belum ditentukan' }}
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>

<!-- Mobile Agenda Terbaru Section (Hanya tampil di mobile) -->
<div class="mobile-agenda-terbaru mobile-only">
  <h4>AGENDA TERBARU</h4>
  @foreach($latest_agendas as $a)
  <a href="{{ route('agenda.show', $a->id) }}" style="text-decoration: none; color: inherit;">
    <div class="mobile-agenda-item">
      <img src="{{ $a->foto ? asset('storage/'.$a->foto) : asset('img/example-image.jpg') }}" alt="{{ $a->nama_kegiatan }}">
      <div class="mobile-agenda-content">
        <div class="judul">{{ Str::limit($a->nama_kegiatan, 50) }}</div>
        <div class="tanggal">
          📅 {{ $a->waktu_pelaksanaan ? \Carbon\Carbon::parse($a->waktu_pelaksanaan)->translatedFormat('d M Y') : 'Tanggal belum ditentukan' }}
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