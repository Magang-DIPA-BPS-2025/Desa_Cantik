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
    flex: 3;
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
    color: #000;
}

/* Meta info */
.meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    color: #000;
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
    color: #000;
    font-size: 16px;
    text-align: justify;
}

/* Share buttons */
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

/* ===== BREADCRUMB - SEMUA WARNA PUTIH ===== */
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
    color: #ffffff !important; /* Warna putih untuk link */
    text-decoration: none;
}

.breadcrumb li {
    color: #ffffff !important; /* Warna putih untuk semua teks */
}

.breadcrumb li:not(:last-child)::after {
    content: "/";
    margin-left: 10px;
    color: #ffffff !important; /* Warna putih untuk separator */
}

/* ===== STYLING AGENDA TERPOPULER ===== */
.agenda-terbaru-box {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    padding: 22px;
    height: fit-content;
}

.agenda-terbaru-box h4 {
    font-weight: 700;
    margin-bottom: 20px;
    color: #000;
    font-size: 22px;
    padding-bottom: 6px;
    border-bottom: 2px solid #4CAF50;
    font-family: 'Poppins', sans-serif;
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
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.agenda-terbaru-item:hover {
    background: #f0fdf4;
    border-color: #16a34a;
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

.agenda-terbaru-content .tanggal {
    color: #000;
    font-size: 12px;
    font-weight: 500;
    font-family: 'Open Sans', sans-serif;
}

/* Responsive */
@media (max-width: 992px) {
    .container-detail {
        flex-direction: column;
    }
    
    .content {
        flex: none;
    }
    
    .agenda-terbaru-box {
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

    .agenda-terbaru-box {
        padding: 20px;
    }
    
    .agenda-terbaru-item {
        padding: 12px;
        gap: 12px;
    }
    
    .agenda-terbaru-item img {
        width: 60px;
        height: 50px;
    }
    
    .agenda-terbaru-content .judul {
        font-size: 13px;
    }
    
    .agenda-terbaru-content .tanggal {
        font-size: 11px;
    }
}
</style>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <nav>
        <ol>
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('agenda') }}">Agenda Desa</a></li>
            <li>{{ Str::limit($data->nama_kegiatan, 30) }}</li>
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
            @if($data->kategori)
                <span><i class="fas fa-tag"></i> {{ $data->kategori }}</span>
            @endif
        </div>

        @if($data->foto)
            <img class="thumb" src="{{ asset('storage/'.$data->foto) }}" alt="{{ $data->nama_kegiatan }}">
        @endif

        <div class="isi-berita">
            {!! nl2br(e($data->deskripsi)) !!}
        </div>

        <!-- Share buttons -->
        <div class="share-buttons">
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

    <!-- Sidebar Agenda Terpopuler -->
    <div class="agenda-terbaru-box">
        <h4>AGENDA TERPOPULER</h4> 
        <div class="agenda-terbaru-list">
            @foreach($latest_agendas as $a)
            <a href="{{ route('agenda.show', $a->id) }}" class="agenda-terbaru-item">
                <img src="{{ $a->foto ? asset('storage/'.$a->foto) : asset('img/example-image.jpg') }}" alt="{{ $a->nama_kegiatan }}">
                <div class="agenda-terbaru-content">
                    <div class="judul">{{ Str::limit($a->nama_kegiatan, 50) }}</div>
                    <div class="tanggal">
                        📅 {{ $a->waktu_pelaksanaan ? \Carbon\Carbon::parse($a->waktu_pelaksanaan)->translatedFormat('d M Y') : 'Tanggal belum ditentukan' }}
                        | Dilihat {{ $a->dilihat ?? 0 }}  
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection