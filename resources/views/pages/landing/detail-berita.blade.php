{{-- resources/views/pages/landing/detail-berita.blade.php --}}
@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Detail Berita</title>

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
  flex: 4;
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
  color: #222;
}

.meta {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  color: #777;
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
  color: #333;
  font-size: 16px;
  text-align: justify;
}

.sidebar {
  flex: 1;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
  padding: 22px;
  height: fit-content;
}

.sidebar h2 {
  font-size: 22px;
  margin-bottom: 20px;
  border-bottom: 2px solid #4CAF50;
  padding-bottom: 6px;
  color: #222;
}

.sidebar .item {
  display: flex;
  gap: 10px;
  margin-bottom: 18px;
  border-radius: 8px;
  padding: 6px;
  transition: background 0.2s;
}
.sidebar .item:hover {
  background: #f0f9f0;
}

.sidebar img.thumb {
  width: 70px;
  height: 50px;
  object-fit: cover;
  border-radius: 6px;
}

.sidebar .desc h4 {
  font-size: 15px;
  color: #333;
  margin: 0 0 4px 0;
}

.sidebar .desc small {
  font-size: 12px;
  color: #777;
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

@media (max-width: 992px) {
  .container-detail {
    flex-direction: column;
  }
}
</style>

<!-- Breadcrumb -->
<div class="breadcrumb" style="max-width: 1400px; margin: 20px auto; padding: 0 20px;">
  <nav style="background: #0fb000; padding: 10px 15px; border-radius: 5px;">
    <ol style="display: flex; list-style: none; margin: 0; padding: 0; gap: 10px;">
      <li><a href="{{ route('home') }}" style="color: #4CAF50; text-decoration: none;">Beranda</a></li>
      <li style="color: #ffffff;">/</li>
      <li><a href="{{ route('berita') }}" style="color: #4CAF50; text-decoration: none;">Berita Desa</a></li>
      <li style="color: #ffffff;">/</li>
      <li style="color: #ffffff;">{{ Str::limit($berita->judul, 50) }}</li>
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
    <div class="share-buttons" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
      <h4 style="margin-bottom: 15px; color: #333;">Bagikan Berita Ini:</h4>
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

  <!-- Sidebar berita terbaru -->
  <div class="sidebar">
    <h2>Berita Terbaru</h2>
    @foreach($latest_beritas as $b)
      <div class="item">
        <img class="thumb" src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}" alt="{{ $b->judul }}">
        <div class="desc">
          <h4><a href="{{ route('berita.show', $b->id) }}">{{ $b->judul }}</a></h4>
          <small>{{ $b->tanggal_event ? \Carbon\Carbon::parse($b->tanggal_event)->translatedFormat('d M Y') : '' }}</small>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
