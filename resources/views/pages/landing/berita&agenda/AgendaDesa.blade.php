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
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  overflow: hidden;
  transition: transform .3s ease, box-shadow .3s ease;
  cursor: pointer;
}

.agenda-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
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
}

/* Sidebar */
.sidebar {
  display: flex;
  flex-direction: column;
  gap: 30px;
}

/* Form pencarian dan kategori tanpa judul */
.search-box, .kategori-box {
  margin-bottom: 25px;
}

.search-box input[type="text"] {
  width: 100%;
  padding: 12px 15px;
  border-radius: 10px;
  border: 1px solid #e0e0e0;
  font-size: 14px;
  transition: all 0.3s ease;
  background: #fafafa;
}

.search-box input[type="text"]:focus {
  outline: none;
  border-color: #4CAF50;
  box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
  background: #fff;
}

/* Dropdown Kategori dengan panah custom dan animasi */
.kategori-wrapper {
  position: relative;
  width: 100%;
}

.kategori-wrapper::after {
  content: "";
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  width: 12px;
  height: 12px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: center;
  pointer-events: none;
  transition: all 0.3s ease;
}

/* Animasi panah saat dropdown focus */
.kategori-dropdown:focus ~ .kategori-wrapper::after {
  transform: translateY(-50%) rotate(180deg);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath fill='%234CAF50' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
}

/* Animasi panah saat hover wrapper */
.kategori-wrapper:hover::after {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath fill='%234CAF50' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
}

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
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  position: relative;
  z-index: 2;
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

/* Agenda terbaru dengan card dan jarak */
.agenda-terbaru-box {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  padding: 25px;
  border: 1px solid #f0f0f0;
}

.agenda-terbaru-box h4 {
  font-weight: 700;
  margin-bottom: 20px;
  color: #2c3e50;
  font-size: 18px;
  padding-bottom: 12px;
  border-bottom: 2px solid #4CAF50;
}

.agenda-terbaru-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.agenda-terbaru-item {
  display: flex;
  align-items: flex-start;
  gap: 15px;
  padding: 15px;
  border-radius: 10px;
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration: none;
  color: inherit;
}

.agenda-terbaru-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(5px);
  text-decoration: none;
  color: inherit;
}

.agenda-terbaru-item img {
  width: 70px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  flex-shrink: 0;
}

.agenda-terbaru-content {
  flex: 1;
}

.agenda-terbaru-content .judul {
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 6px;
  font-size: 14px;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.agenda-terbaru-content .tanggal {
  color: #666;
  font-size: 12px;
  font-weight: 500;
}

/* Loading indicator untuk infinite scroll */
.loading-indicator {
  text-align: center;
  padding: 20px;
  display: none;
}

.loading-spinner {
  width: 40px;
  height: 40px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #4CAF50;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin: 0 auto;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Mobile Filter */
.mobile-filter {
  display: none;
  margin-bottom: 20px;
}

.mobile-search-box, .mobile-kategori-box {
  margin-bottom: 20px;
}

.mobile-search-box input[type="text"] {
  width: 100%;
  padding: 10px 15px;
  border-radius: 8px;
  border: 1px solid #e0e0e0;
  font-size: 14px;
  background: #fafafa;
}

.mobile-search-box input[type="text"]:focus {
  outline: none;
  border-color: #4CAF50;
  background: #fff;
}

/* Mobile Dropdown Kategori dengan animasi */
.mobile-kategori-wrapper {
  position: relative;
  width: 100%;
}

.mobile-kategori-wrapper::after {
  content: "";
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  width: 12px;
  height: 12px;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: center;
  pointer-events: none;
  transition: all 0.3s ease;
}

/* Animasi panah mobile saat focus */
.mobile-kategori-select:focus ~ .mobile-kategori-wrapper::after {
  transform: translateY(-50%) rotate(180deg);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath fill='%234CAF50' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E");
}

.mobile-kategori-select {
  width: 100%;
  padding: 10px 15px;
  border-radius: 8px;
  border: 1px solid #e0e0e0;
  background: #fafafa;
  color: #333;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  position: relative;
  z-index: 2;
}

.mobile-kategori-select:focus {
  outline: none;
  border-color: #4CAF50;
  background: #fff;
}

/* Mobile Agenda Terbaru */
.mobile-agenda-terbaru {
  display: none;
  margin-top: 20px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  padding: 20px;
  border: 1px solid #f0f0f0;
}

.mobile-agenda-terbaru h4 {
  font-weight: 700;
  margin-bottom: 15px;
  color: #222;
  font-size: 18px;
  padding-bottom: 10px;
  border-bottom: 2px solid #4CAF50;
}

.mobile-agenda-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.mobile-agenda-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 12px;
  border-radius: 10px;
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
  cursor: pointer;
  text-decoration: none;
  color: inherit;
}

.mobile-agenda-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(5px);
  text-decoration: none;
  color: inherit;
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
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
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
  
  .agenda-terbaru-box {
    padding: 20px;
  }
  
  .agenda-terbaru-item {
    padding: 12px;
  }
}
</style>

<!-- Mobile Filter Section (Hanya tampil di mobile) -->
<div class="mobile-filter mobile-only">
  <div class="mobile-search-box">
    <form method="GET" action="{{ route('agenda') }}" id="mobileSearchForm">
      <input type="text" name="search" placeholder="Cari agenda..." value="{{ request('search') }}" 
             onchange="document.getElementById('mobileSearchForm').submit()">
    </form>
  </div>
  
  <div class="mobile-kategori-box">
    <div class="mobile-kategori-wrapper">
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
</div>

<div class="container-agenda">
  <!-- Bagian kiri: Agenda -->
  <div>
    <h2 style="margin-bottom:20px; font-weight:700;">Agenda Desa</h2>
    <div class="agenda-grid" id="agenda-container">
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

    <!-- Loading indicator untuk infinite scroll -->
    <div class="loading-indicator" id="loading-indicator">
      <div class="loading-spinner"></div>
      <p style="margin-top: 10px;">Memuat agenda...</p>
    </div>
  </div>

  <!-- Sidebar (Desktop Only) -->
  <div class="sidebar desktop-only">
    {{-- Pencarian --}}
    <div class="search-box">
      <form method="GET" action="{{ route('agenda') }}">
        <input type="text" name="search" placeholder="Cari agenda..." value="{{ request('search') }}">
      </form>
    </div>

    {{-- Kategori --}}
    <div class="kategori-box">
      <div class="kategori-wrapper">
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
    </div>

    {{-- Agenda Terbaru --}}
    <div class="agenda-terbaru-box">
      <h4>AGENDA TERBARU</h4>
      <div class="agenda-terbaru-list">
        @foreach($latest_agendas as $a)
        <a href="{{ route('agenda.show', $a->id) }}" class="agenda-terbaru-item">
          <img src="{{ $a->foto ? asset('storage/'.$a->foto) : asset('img/example-image.jpg') }}" alt="{{ $a->nama_kegiatan }}">
          <div class="agenda-terbaru-content">
            <div class="judul">{{ Str::limit($a->nama_kegiatan, 50) }}</div>
            <div class="tanggal">
              📅 {{ $a->waktu_pelaksanaan ? \Carbon\Carbon::parse($a->waktu_pelaksanaan)->translatedFormat('d M Y') : 'Tanggal belum ditentukan' }}
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Mobile Agenda Terbaru Section (Hanya tampil di mobile) -->
<div class="mobile-agenda-terbaru mobile-only">
  <h4>AGENDA TERBARU</h4>
  <div class="mobile-agenda-list">
    @foreach($latest_agendas as $a)
    <a href="{{ route('agenda.show', $a->id) }}" class="mobile-agenda-item">
      <img src="{{ $a->foto ? asset('storage/'.$a->foto) : asset('img/example-image.jpg') }}" alt="{{ $a->nama_kegiatan }}">
      <div class="mobile-agenda-content">
        <div class="judul">{{ Str::limit($a->nama_kegiatan, 50) }}</div>
        <div class="tanggal">
          📅 {{ $a->waktu_pelaksanaan ? \Carbon\Carbon::parse($a->waktu_pelaksanaan)->translatedFormat('d M Y') : 'Tanggal belum ditentukan' }}
        </div>
      </div>
    </a>
    @endforeach
  </div>
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

// Infinite scroll implementation
let isLoading = false;
let page = 1;
let hasMore = true;

// Check if we're at the bottom of the page
function isBottomOfPage() {
  return window.innerHeight + window.scrollY >= document.body.offsetHeight - 500;
}

// Load more agenda
async function loadMoreAgenda() {
  if (isLoading || !hasMore) return;
  
  isLoading = true;
  document.getElementById('loading-indicator').style.display = 'block';
  
  try {
    page++;
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set('page', page);
    
    const response = await fetch(`{{ route('agenda') }}?${searchParams.toString()}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    });
    
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    
    const data = await response.json();
    
    if (data.html) {
      document.getElementById('agenda-container').insertAdjacentHTML('beforeend', data.html);
    }
    
    // Check if there are more pages
    if (!data.hasMore) {
      hasMore = false;
    }
  } catch (error) {
    console.error('Error loading more agenda:', error);
    hasMore = false;
  } finally {
    isLoading = false;
    document.getElementById('loading-indicator').style.display = 'none';
  }
}

// Scroll event listener
window.addEventListener('scroll', () => {
  if (isBottomOfPage()) {
    loadMoreAgenda();
  }
});

// Initial check in case the page is already at the bottom
window.addEventListener('load', () => {
  if (isBottomOfPage()) {
    loadMoreAgenda();
  }
});

// JavaScript untuk animasi panah dropdown dengan class toggle
document.addEventListener('DOMContentLoaded', function() {
  // Untuk dropdown desktop
  const desktopDropdown = document.querySelector('.kategori-dropdown');
  const desktopWrapper = document.querySelector('.kategori-wrapper');
  
  if (desktopDropdown && desktopWrapper) {
    desktopDropdown.addEventListener('focus', function() {
      desktopWrapper.classList.add('dropdown-focused');
    });
    
    desktopDropdown.addEventListener('blur', function() {
      desktopWrapper.classList.remove('dropdown-focused');
    });
  }
  
  // Untuk dropdown mobile
  const mobileDropdown = document.querySelector('.mobile-kategori-select');
  const mobileWrapper = document.querySelector('.mobile-kategori-wrapper');
  
  if (mobileDropdown && mobileWrapper) {
    mobileDropdown.addEventListener('focus', function() {
      mobileWrapper.classList.add('dropdown-focused');
    });
    
    mobileDropdown.addEventListener('blur', function() {
      mobileWrapper.classList.remove('dropdown-focused');
    });
  }
});
</script>

<style>
/* Tambahan CSS untuk animasi dengan JavaScript */
.kategori-wrapper.dropdown-focused::after {
  transform: translateY(-50%) rotate(180deg) !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath fill='%234CAF50' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E") !important;
}

.mobile-kategori-wrapper.dropdown-focused::after {
  transform: translateY(-50%) rotate(180deg) !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'%3E%3Cpath fill='%234CAF50' d='M6 8.825L1.175 4 2.238 2.938 6 6.7l3.763-3.762L10.825 4z'/%3E%3C/svg%3E") !important;
}
</style>

@endsection