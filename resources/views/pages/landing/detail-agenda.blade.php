{{-- resources/views/pages/landing/detail-agenda.blade.php --}}
@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Detail Agenda</title>

<!-- Font Awesome untuk icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
/* ===== Container utama ===== */
.container-detail {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
    margin: 40px auto;
    max-width: 1400px;
    padding: 0 20px;
}

/* ===== Konten utama ===== */
.content {
    flex: 4;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    padding: 25px 30px;
}

/* Judul */
.content h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #222;
}

/* Meta info */
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

/* Gambar utama */
.content img.thumb {
    width: 100%;
    max-height: 460px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 25px;
}

/* Isi konten */
.isi-berita {
    line-height: 1.8;
    color: #333;
    font-size: 16px;
    text-align: justify;
}

/* Share buttons */
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

/* Sidebar */
.sidebar {
    flex: 1;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
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

/* Responsive */
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
      <li><a href="{{ route('agenda') }}" style="color: #4CAF50; text-decoration: none;">Agenda Desa</a></li>
      <li style="color: #ffffff;">/</li>
      <li style="color: #ffffff;">{{ Str::limit($data->nama_kegiatan, 50) }}</li>
    </ol>
  </nav>
</div>

<div class="container-detail">
    <!-- Konten utama -->
    <div class="content">
        <h1>{{ $data->nama_kegiatan }}</h1>
      
        <div class="meta">
          <span><i class="far fa-user"></i> {{ $data->penulis ?? 'Admin Desa' }}</span>
          @if($data->waktu_pelaksanaan)
            <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($data->waktu_pelaksanaan)->translatedFormat('d F Y') }}</span>
          @endif
          <span><i class="far fa-eye"></i> Dilihat {{ $data->dilihat ?? 0 }} kali</span>
        </div>

        @if($data->foto)
        <img class="thumb" src="{{ asset('storage/'.$data->foto) }}" alt="{{ $data->nama_kegiatan }}">
        @endif

        <div class="isi-berita">
          {!! nl2br(e($data->deskripsi)) !!}
        </div>

        <!-- Share buttons -->
        <div class="share-buttons" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="facebook">
            <i class="fab fa-facebook"></i> Facebook
          </a>
          <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $data->nama_kegiatan }}" target="_blank" class="twitter">
            <i class="fab fa-twitter"></i> Twitter
          </a>
          <a href="https://wa.me/?text={{ urlencode($data->nama_kegiatan . ' - ' . url()->current()) }}" target="_blank" class="whatsapp">
            <i class="fab fa-whatsapp"></i> WhatsApp
          </a>
        </div>
    </div>

    <!-- Sidebar agenda terbaru -->
    <div class="sidebar">
      <h2>Agenda Terbaru</h2>
      @foreach($latest_post as $b)
      <div class="item">
        <img class="thumb" src="{{ $b->foto ? asset('storage/'.$b->foto) : asset('img/example-image.jpg') }}" alt="{{ $b->nama_kegiatan }}">
        <div class="desc">
          <h4><a href="{{ route('agenda.show', $b->id) }}">{{ $b->nama_kegiatan }}</a></h4>
          <small>{{ $b->waktu_pelaksanaan ? \Carbon\Carbon::parse($b->waktu_pelaksanaan)->translatedFormat('d M Y') : '' }}</small>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection
