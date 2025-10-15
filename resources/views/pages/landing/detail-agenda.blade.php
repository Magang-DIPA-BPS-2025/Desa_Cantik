@extends('layouts.landing.app')
@section('content')

<style>
/* Container utama */
.container-detail {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    margin: 40px auto;
    max-width: 1200px;
    padding: 0 15px;
}

/* Konten utama */
.content {
    flex: 1 1 65%;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

/* Sidebar */
.sidebar {
    flex: 1 1 30%;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
    height: fit-content;
}

/* Meta info */
.meta {
    font-size: 14px;
    color: #777;
    margin-bottom: 20px;
}

.meta span {
    margin-right: 15px;
}

/* Gambar utama */
.content .thumb {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 20px;
    object-fit: cover;
}

/* Judul */
.content h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #333;
}

/* Isi konten */
.isi-berita {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
}

/* Share buttons */
.share-buttons a {
    transition: all 0.2s ease;
}

.share-buttons a:hover {
    opacity: 0.85;
}

/* Sidebar items */
.sidebar .item {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
    align-items: center;
}

.sidebar .item .thumb {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
}

.sidebar .desc h4 {
    margin: 0 0 5px;
    font-size: 16px;
    font-weight: 600;
}

.sidebar .desc small {
    color: #999;
}
</style>

<div class="container-detail">
    <!-- Konten utama -->
    <div class="content">
        <div class="meta">
          <h1>{{ $data->nama_kegiatan }}</h1>
            <span><i class="far fa-user"></i> {{ $data->penulis ?? 'Admin Desa' }}</span>
            @if($data->waktu_pelaksanaan)
            <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($data->waktu_pelaksanaan)->translatedFormat('d F Y') }}</span>
            @endif
            <span><i class="far fa-eye"></i> Dilihat {{ $data->dilihat ?? 0 }} kali</span>
        </div>

        <img class="thumb" src="{{ $data->foto ? asset('storage/'.$data->foto) : asset('img/example-image.jpg') }}" alt="{{ $data->nama_kegiatan }}">

        <div class="isi-berita">
            {!! nl2br(e($data->deskripsi)) !!}
        </div>

        <div class="share-buttons" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
            <h4 style="margin-bottom: 15px; color: #333;">Bagikan Agenda Ini:</h4>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" style="background: #3b5998; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px;">
                    <i class="fab fa-facebook"></i> Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $data->nama_kegiatan }}" target="_blank" style="background: #1da1f2; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px;">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
                <a href="https://wa.me/?text={{ urlencode($data->nama_kegiatan . ' - ' . url()->current()) }}" target="_blank" style="background: #25d366; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px;">
                    <i class="fab fa-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar agenda terbaru -->
    <div class="sidebar">
        <h2 style="font-size: 20px; margin-bottom: 20px;">Agenda Terbaru</h2>
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
