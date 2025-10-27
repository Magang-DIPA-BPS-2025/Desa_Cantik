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
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  overflow: hidden;
  transition: transform .3s ease, box-shadow .3s ease;
  cursor: pointer;
}

.berita-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
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

/* Berita terbaru dengan card dan jarak */
.berita-terbaru-box {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  padding: 25px;
  border: 1px solid #f0f0f0;
}

.berita-terbaru-box h4 {
  font-weight: 700;
  margin-bottom: 20px;
  color: #2c3e50;
  font-size: 18px;
  padding-bottom: 12px;
  border-bottom: 2px solid #4CAF50;
}

.berita-terbaru-list {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.berita-terbaru-item {
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

.berita-terbaru-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(5px);
  text-decoration: none;
  color: inherit;
}

.berita-terbaru-item img {
  width: 70px;
  height: 60px;
  object-fit: cover;
  border-radius: 8px;
  flex-shrink: 0;
}

.berita-terbaru-content {
  flex: 1;
}

.berita-terbaru-content .judul {
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

.berita-terbaru-content .tanggal {
  color: #666;
  font-size: 12px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 5px;
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

/* Mobile Berita Terbaru */
.mobile-berita-terbaru {
  display: none;
  margin-top: 20px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  padding: 20px;
  border: 1px solid #f0f0f0;
}

.mobile-berita-terbaru h4 {
  font-weight: 700;
  margin-bottom: 15px;
  color: #222;
  font-size: 18px;
  padding-bottom: 10px;
  border-bottom: 2px solid #4CAF50;
}

.mobile-berita-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.mobile-berita-item {
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

.mobile-berita-item:hover {
  background: #e8f5e9;
  border-color: #4CAF50;
  transform: translateX(5px);
  text-decoration: none;
  color: inherit;
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
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.mobile-berita-content .tanggal {
  color: #666;
  font-size: 12px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 5px;
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
  
  .berita-terbaru-box {
    padding: 20px;
  }
  
  .berita-terbaru-item {
    padding: 12px;
  }
}
</style>

<!-- Mobile Filter Section (Hanya tampil di mobile) -->
<div class="mobile-filter mobile-only">
  <div class="mobile-search-box">
    <form method="GET" action="{{ route('berita') }}" id="mobileSearchForm">
      <input type="text" name="search" placeholder="Cari berita..." value="{{ $search }}" 
             onchange="document.getElementById('mobileSearchForm').submit()">
    </form>
  </div>
  
  <div class="mobile-kategori-box">
    <div class="mobile-kategori-wrapper">
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
</div>

<div class="container-berita">
  <!-- Bagian kiri: Berita -->
  <div>
    <h2 style="margin-bottom:20px; font-weight:700;">Berita Desa</h2>
    <div class="berita-grid" id="berita-container">
      @forelse($beritas as $berita)
      <a href="{{ route('berita.show', $berita->id) }}" style="text-decoration: none; color: inherit;">
        <div class="berita-card">
          <img src="{{ $berita->foto ? asset('storage/'.$berita->foto) : asset('img/example-image.jpg') }}" alt="{{ $berita->judul }}">
          <div class="content">
            <h4>{{ $berita->judul }}</h4>
            <small>
              📅 {{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d F Y') : $berita->created_at->translatedFormat('d F Y') }}
              @if($berita->kategori) | 📍 {{ $berita->kategori->nama ?? 'Umum' }} @endif
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

    <!-- Loading indicator untuk infinite scroll -->
    <div class="loading-indicator" id="loading-indicator">
      <div class="loading-spinner"></div>
      <p style="margin-top: 10px;">Memuat berita...</p>
    </div>
  </div>

  <!-- Sidebar (Desktop Only) -->
  <div class="sidebar desktop-only">
    {{-- Pencarian --}}
    <div class="search-box">
      <form method="GET" action="{{ route('berita') }}">
        <input type="text" name="search" placeholder="Cari berita..." value="{{ $search }}">
      </form>
    </div>

    {{-- Kategori --}}
    <div class="kategori-box">
      <div class="kategori-wrapper">
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
    </div>

    {{-- Berita Terbaru --}}
    <div class="berita-terbaru-box">
      <h4>BERITA TERBARU</h4>
      <div class="berita-terbaru-list">
        @foreach($latest_beritas as $b)
        <a href="{{ route('berita.show', $b->id) }}" class="berita-terbaru-item">
          <img src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}" alt="{{ $b->judul }}">
          <div class="berita-terbaru-content">
            <div class="judul">{{ Str::limit($b->judul, 50) }}</div>
            <div class="tanggal">
              📅 {{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->translatedFormat('d M Y') : $b->created_at->translatedFormat('d M Y') }}
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Mobile Berita Terbaru Section (Hanya tampil di mobile) -->
<div class="mobile-berita-terbaru mobile-only">
  <h4>BERITA TERBARU</h4>
  <div class="mobile-berita-list">
    @foreach($latest_beritas as $b)
    <a href="{{ route('berita.show', $b->id) }}" class="mobile-berita-item">
      <img src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}" alt="{{ $b->judul }}">
      <div class="mobile-berita-content">
        <div class="judul">{{ Str::limit($b->judul, 50) }}</div>
        <div class="tanggal">
          📅 {{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->translatedFormat('d M Y') : $b->created_at->translatedFormat('d M Y') }}
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

// Load more berita
async function loadMoreBerita() {
  if (isLoading || !hasMore) return;
  
  isLoading = true;
  document.getElementById('loading-indicator').style.display = 'block';
  
  try {
    page++;
    const searchParams = new URLSearchParams(window.location.search);
    searchParams.set('page', page);
    
    const response = await fetch(`{{ route('berita') }}?${searchParams.toString()}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    });
    
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    
    const data = await response.json();
    
    if (data.html) {
      document.getElementById('berita-container').insertAdjacentHTML('beforeend', data.html);
    }
    
    // Check if there are more pages
    if (!data.hasMore) {
      hasMore = false;
    }
  } catch (error) {
    console.error('Error loading more berita:', error);
    hasMore = false;
  } finally {
    isLoading = false;
    document.getElementById('loading-indicator').style.display = 'none';
  }
}

// Scroll event listener
window.addEventListener('scroll', () => {
  if (isBottomOfPage()) {
    loadMoreBerita();
  }
});

// Initial check in case the page is already at the bottom
window.addEventListener('load', () => {
  if (isBottomOfPage()) {
    loadMoreBerita();
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