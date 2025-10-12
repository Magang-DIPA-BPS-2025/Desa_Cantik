@extends('layouts.landing.app')

@section('content')
<div class="gallery-section py-5">
    <div class="text-start mb-5 px-4">
        <h2 class="fw-bolder display-4 mb-3 gallery-title">
            <i class="bi bi-images me-2"></i> GALERI DESA
        </h2>
        <p class="text-secondary fs-5">Kumpulan dokumentasi kegiatan & keindahan desa</p>
    </div>

    <div class="container-fluid px-lg-5">
        <div class="row g-5 justify-content-center">
            @forelse ($galeris as $galeri)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card gallery-card shadow border-0 h-100">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalGaleri{{ $galeri->id }}"
                           class="d-block w-100 h-100 overflow-hidden rounded-4 position-relative">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                 class="card-img-top gallery-img"
                                 alt="Foto Galeri Desa">
                            <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center p-3">
                                <i class="bi bi-zoom-in fs-2 text-white mb-2"></i>
                                <small class="text-white text-uppercase fw-bold">Perbesar Foto</small>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Modal Foto --}}
                <div class="modal fade" id="modalGaleri{{ $galeri->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-body p-0 position-relative">

                                {{-- Tombol Close (X) --}}
                                <button type="button"
                                        class="btn-close-custom"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    &times;
                                </button>

                                {{-- Gambar --}}
                                <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                     class="img-fluid rounded-4 shadow-lg d-block mx-auto modal-image"
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

    <div class="d-flex justify-content-center mt-5">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- CSS Tambahan --}}
<style>
.gallery-section {
    background: linear-gradient(145deg, #f8fffb 0%, #ffffff 100%);
    min-height: 100vh;
}

.gallery-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #000;
}

.gallery-card {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.gallery-card:hover {
    transform: translateY(-5px);
}

.gallery-img {
    object-fit: cover;
    aspect-ratio: 16/9;
    height: 300px;
    width: 100%;
    transition: transform 0.4s ease;
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
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.modal-body img {
    border-radius: 16px;
    max-height: 90vh;
    cursor: zoom-in;
    transition: transform 0.3s ease;
}

.modal-body img.zoomed {
    transform: scale(2);
    cursor: zoom-out;
}

/* Tombol X Custom */
.btn-close-custom {
    position: absolute;
    top: 15px;
    right: 20px;
    z-index: 1056;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    background: rgba(255, 255, 255, 0.85);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-close-custom:hover {
    background: rgba(255, 255, 255, 1);
    transform: scale(1.1);
    cursor: pointer;
}
</style>

{{-- JS --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const modals = document.querySelectorAll(".modal");

    modals.forEach(modal => {
        const img = modal.querySelector(".modal-body img");
        img.addEventListener("click", e => {
            img.classList.toggle("zoomed");
            e.stopPropagation();
        });
        modal.addEventListener("hidden.bs.modal", () => img.classList.remove("zoomed"));
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
