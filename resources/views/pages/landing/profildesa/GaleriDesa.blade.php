@extends('layouts.landing.app')

@section('content')
<div class="gallery-section py-5">
    {{-- Judul --}}
    <div class="text-start mb-5 px-4">
        <h2 class="fw-bolder display-4 mb-3 gallery-title">
            <i class="bi bi-images me-2"></i> GALERI DESA
        </h2>
        <p class="text-secondary fs-5">Kumpulan dokumentasi kegiatan & keindahan desa</p>
    </div>

    {{-- Grid Galeri --}}
    <div class="container-fluid px-lg-5">
        <div class="row g-5 justify-content-center">
            @forelse ($galeris as $galeri)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card gallery-card shadow border-0 h-100" data-aos="fade-up">
                        <a href="{{ asset('storage/' . $galeri->gambar) }}"
                           data-bs-toggle="modal"
                           data-bs-target="#modalGaleri{{ $galeri->id }}"
                           class="d-block w-100 h-100 overflow-hidden rounded-4 position-relative">

                            <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                 class="card-img-top gallery-img w-100"
                                 alt="Foto Galeri Desa">

                            <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center p-3">
                                <i class="bi bi-zoom-in fs-2 text-white mb-2"></i>
                                <small class="text-white text-uppercase fw-bold">Perbesar Foto</small>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Modal Foto --}}
                <div class="modal fade" 
                     id="modalGaleri{{ $galeri->id }}" 
                     tabindex="-1" 
                     aria-hidden="true" 
                     data-bs-backdrop="true" 
                     data-bs-keyboard="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-body p-0 position-relative">
                                <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                                     class="img-fluid rounded-4 shadow-lg d-block mx-auto" 
                                     alt="Foto Galeri Desa">
                            </div>
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
    <div class="d-flex justify-content-center mt-5">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- CSS tambahan --}}
<style>
    .gallery-section {
        background: linear-gradient(145deg, #f8fffb 0%, #ffffff 100%);
        min-height: 100vh;
    }

    .gallery-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #000 !important;
        letter-spacing: 1px;
    }

    .gallery-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .gallery-img {
        object-fit: cover;
        aspect-ratio: 16/9;
        height: 300px;
        width: 100%;
        transition: transform 0.5s ease;
    }

    .gallery-card:hover .gallery-img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(25, 135, 84, 0.8);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 16px;
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }

    .row.g-5 {
        row-gap: 2.5rem !important;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 16px;
        backdrop-filter: blur(5px);
    }

.modal-body img {
    border-radius: 16px;
    max-height: 90vh;
    object-fit: contain;
    cursor: zoom-in;
    transition: transform 0.3s ease;
}

.modal-body img.zoomed {
    transform: scale(2);
    cursor: zoom-out;
}


    /* Pagination */
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modals = document.querySelectorAll(".modal");

    modals.forEach(modal => {
        const modalInstance = new bootstrap.Modal(modal);
        const img = modal.querySelector(".modal-body img");

        // Klik gambar → toggle zoom
        img.addEventListener("click", function (e) {
            img.classList.toggle("zoomed");
            e.stopPropagation(); // penting agar modal tidak tertutup saat klik gambar
        });

        // Klik di backdrop → tutup modal
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                modalInstance.hide();
            }
        });

        // Reset gambar saat modal ditutup
        modal.addEventListener("hidden.bs.modal", function () {
            img.classList.remove("zoomed");
        });
    });
});
</script>
@endsection
