@extends('layouts.landing.app')

@section('content')
<div class="gallery-section py-5 py-lg-6">
    {{-- Judul --}}
    <div class="text-start mb-5 mb-lg-6" style="padding-left: 30px; padding-right: 15px;">
    <h2 class="fw-bolder text-success display-5 mb-3">
        <i class="bi bi-images me-2"></i> GALERI DESA
    </h2>
    <p class="text-secondary fs-5">Kumpulan dokumentasi kegiatan & keindahan desa</p>
    <div class="decor-line mt-4" style="margin-left:0;"></div>
</div>


    {{-- Grid Galeri: Menggunakan container-fluid untuk lebar penuh --}}
    <div class="container-fluid px-lg-5">
        <div class="row g-4 justify-content-center">
            @forelse ($galeris as $galeri)
                {{-- Gunakan col-lg-4 untuk 3 kolom, memastikan lebar horizontal per gambar maksimal. col-xl-3 dihapus. --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card gallery-card shadow border-0 h-100" data-aos="fade-up">
                        <a href="{{ asset('storage/' . $galeri->gambar) }}"
                           data-bs-toggle="modal"
                           data-bs-target="#modalGaleri{{ $galeri->id }}"
                           class="d-block w-100 h-100 overflow-hidden rounded-4">

                            <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                 class="card-img-top gallery-img w-100"
                                 alt="Foto Galeri Desa">

                            {{-- Overlay --}}
                            <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center p-3">
                                <i class="bi bi-zoom-in fs-2 text-white mb-2"></i>
                                <small class="text-white text-uppercase fw-bold">Perbesar Foto</small>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Modal (Lightbox) --}}
                <div class="modal fade" id="modalGaleri{{ $galeri->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content bg-transparent border-0">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" class="img-fluid rounded-4 shadow-lg" alt="Foto Galeri Desa">
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center shadow-sm rounded-4 py-4">
                        <i class="bi bi-info-circle-fill me-2"></i> Belum ada foto galeri yang diunggah.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-5 mt-lg-6">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- CSS tambahan --}}
<style>
    /* Background dan Dekorasi (dipertahankan) */
    .gallery-section {
        background: linear-gradient(145deg, #f8fffb 0%, #ffffff 100%);
        min-height: 100vh;
    }
    .decor-line {
        width: 100px;
        height: 6px;
        background: #198754;
        border-radius: 6px;
    }

    /* Card style (dipertahankan) */
    .gallery-card {
        border-radius: 16px;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    /* 🏞️ PERUBAHAN UTAMA: Agar gambar lebih lebar ke samping (Rasio 16:9) */
    .gallery-img {
        object-fit: cover;
        /* Ubah rasio aspek menjadi 16:9 (panorama/bioskop) */
        aspect-ratio: 16/9;

        /* Tinggi ditetapkan agar tidak terlalu panjang ke bawah */
        height: 300px;

        width: 100%;
        transition: transform 0.5s ease;
    }

    /* Penyesuaian responsif untuk tinggi gambar yang lebih baik */
    @media (min-width: 1200px) { /* Layar besar */
        .gallery-img {
            /* Sedikit dinaikkan agar tetap besar saat 3 kolom */
            height: 350px;
        }
    }
    @media (max-width: 992px) { /* Layar tablet/laptop kecil (2 kolom) */
        .gallery-img {
            /* Lebih pendek karena lebar kolom berkurang setengah */
            height: 220px;
        }
    }
    @media (max-width: 768px) { /* Layar HP/Tablet vertikal (1 kolom) */
        .gallery-img {
            /* Lebih tinggi di 1 kolom agar gambar tetap menonjol */
            height: 280px;
        }
    }

    /* Efek hover zoom pada gambar (dipertahankan) */
    .gallery-card:hover .gallery-img {
        transform: scale(1.1);
    }

    /* Overlay hover (dipertahankan) */
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(25, 135, 84, 0.85);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 16px;
        pointer-events: none;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
        pointer-events: auto;
    }

    /* Pagination custom (dipertahankan) */
    .pagination .page-item .page-link {
        border-radius: 8px;
        margin: 0 3px;
        color: #198754;
        border: 1px solid #ced4da;
    }
    .pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
        color: #fff;
        box-shadow: 0 2px 5px rgba(25, 135, 84, 0.5);
    }
    .pagination .page-item .page-link:hover {
        background-color: #e6f9ee;
        border-color: #198754;
        color: #198754;
    }
</style>
@endsection
