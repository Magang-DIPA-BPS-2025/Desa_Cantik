{{-- resources/views/pages/landing/detail-berita.blade.php --}}
@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Detail Berita</title>

<!-- Font Awesome untuk icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
.container-detail {
  max-width: 1400px;
  margin: 40px auto;
  padding: 20px;
  display: flex;
  gap: 25px;
  flex-wrap: wrap;
}

.content {
  flex: 3;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  padding: 25px 30px;
}

.content img.thumb {
  width: 100%;
  max-height: 460px;
  object-fit: cover;
  border-radius: 12px;
  margin-bottom: 25px;
}

.content h1 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 15px;
  color: #000; /* Diubah dari #222 menjadi #000 */
}

.meta {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  color: #000; /* Diubah dari #777 menjadi #000 */
  font-size: 14px;
  margin-bottom: 15px;
}

.meta span {
  display: flex;
  align-items: center;
  gap: 5px;
}

.meta i {
  color: #4CAF50;
}

.isi-berita {
  line-height: 1.8;
  color: #000; /* Diubah dari #333 menjadi #000 */
  font-size: 16px;
  text-align: justify;
}

.share-buttons {
  margin-top: 30px;
  padding-top: 20px;
  border-top: 1px solid #eee;
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.share-buttons a {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  text-decoration: none;
  padding: 8px 15px;
  border-radius: 5px;
  font-size: 14px;
  font-weight: 600;
  transition: all 0.3s;
}

.share-buttons a i {
  font-size: 16px;
}

.share-buttons a.facebook { background: #3b5998; color: #fff; }
.share-buttons a.twitter { background: #1da1f2; color: #fff; }
.share-buttons a.whatsapp { background: #25d366; color: #fff; }

.share-buttons a:hover {
  opacity: 0.85;
}

/* ===== STYLING BERITA TERPOPULER ===== */
.berita-terbaru-box {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    padding: 22px;
    height: fit-content;
}

.berita-terbaru-box h4 {
    font-weight: 700;
    margin-bottom: 20px;
    color: #000;
    font-size: 22px;
    padding-bottom: 6px;
    border-bottom: 2px solid #4CAF50;
    font-family: 'Poppins', sans-serif;
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
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.berita-terbaru-item:hover {
    background: #f0fdf4;
    border-color: #16a34a;
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
    color: #000;
    margin-bottom: 6px;
    font-size: 14px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
}

.berita-terbaru-content .tanggal {
    color: #000;
    font-size: 12px;
    font-weight: 500;
    font-family: 'Open Sans', sans-serif;
}

/* Breadcrumb */
.breadcrumb {
    max-width: 1400px;
    margin: 20px auto;
    padding: 0 20px;
}

.breadcrumb nav {
    background: #258d15ff;
    padding: 10px 15px;
    border-radius: 5px;
}

.breadcrumb ol {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 10px;
    flex-wrap: wrap;
}

.breadcrumb a {
    color: #ffffff !important;
    text-decoration: none;
}

.breadcrumb li {
    color: #ffffff !important;
}

.breadcrumb li:not(:last-child)::after {
    content: "/";
    margin-left: 10px;
    color: #ffffff !important;
}

/* Responsive */
@media (max-width: 992px) {
  .container-detail {
    flex-direction: column;
  }
  
  .content {
    flex: none;
  }
  
  .berita-terbaru-box {
    flex: none;
  }
}

@media (max-width: 768px) {
  .container-detail {
    margin: 20px auto;
    padding: 0 15px;
    gap: 15px;
  }
  
  .content {
    padding: 20px;
  }
  
  .content h1 {
    font-size: 24px;
  }
  
  .meta {
    gap: 8px;
  }
  
  .share-buttons {
    justify-content: center;
  }

  .berita-terbaru-box {
    padding: 20px;
  }
  
  .berita-terbaru-item {
    padding: 12px;
    gap: 12px;
  }
  
  .berita-terbaru-item img {
    width: 60px;
    height: 50px;
  }
  
  .berita-terbaru-content .judul {
    font-size: 13px;
  }
  
  .berita-terbaru-content .tanggal {
    font-size: 11px;
  }
}
</style>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <nav>
        <ol>
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('berita') }}">Berita Desa</a></li>
            <li>{{ Str::limit($berita->judul, 30) }}</li>
        </ol>
    </nav>
</div>

<div class="container-detail">

  <div class="content">
    <h1>{{ $berita->judul }}</h1>
  
    <div class="meta">
      <span><i class="far fa-user"></i> {{ $berita->penulis ?? 'Admin Desa' }}</span>
      @if($berita->tanggal_event)
        <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d F Y') }}</span>
      @endif
      <span><i class="far fa-eye"></i> Dilihat {{ $berita->dilihat ?? 0 }} kali</span>
    </div>

    <img class="thumb" src="{{ $berita->foto ? asset('storage/'.$berita->foto) : asset('img/example-image.jpg') }}" alt="{{ $berita->judul }}">
    

    <div class="isi-berita">
      {!! nl2br(e($berita->deskripsi_singkat)) !!}
    </div>

    <!-- Share buttons -->
    <div class="share-buttons">
      <h4 style="margin-bottom: 15px; color: #000;">Bagikan Berita Ini:</h4>
      <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="facebook">
        <i class="fab fa-facebook"></i> Facebook
      </a>
      <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $berita->judul }}" target="_blank" class="twitter">
        <i class="fab fa-twitter"></i> Twitter
      </a>
      <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}" target="_blank" class="whatsapp">
        <i class="fab fa-whatsapp"></i> WhatsApp
      </a>
    </div>
  </div>

  <!-- Sidebar Berita Terpopuler -->
  <div class="berita-terbaru-box">
    <h4>BERITA TERPOPULER</h4> 
    <div class="berita-terbaru-list">
        @foreach($latest_beritas as $b)
        <a href="{{ route('berita.show', $b->id) }}" class="berita-terbaru-item">
            <img src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}" alt="{{ $b->judul }}">
            <div class="berita-terbaru-content">
                <div class="judul">{{ Str::limit($b->judul, 50) }}</div>
                <div class="tanggal">
                    📅 {{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->translatedFormat('d M Y') : $b->created_at->translatedFormat('d M Y') }}
                    | Dilihat {{ $b->dilihat }}
                </div>
            </div>
        </a>
        @endforeach
    </div>
  </div>
</div>
@endsection