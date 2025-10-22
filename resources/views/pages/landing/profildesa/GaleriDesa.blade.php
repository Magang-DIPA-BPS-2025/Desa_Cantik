@extends('layouts.landing.app')

@section('content')
<div class="gallery-section py-5">
    <div class="container-fluid px-lg-5">
       
        <div class="text-start mb-4 mt-2 px-2 gallery-header">
            <h2 class="fw-bolder display-4 mb-2 gallery-title">
                <i class="bi bi-images me-2"></i> GALERI DESA
            </h2>
            <p class="text-secondary fs-5 mb-0">
                Kumpulan dokumentasi kegiatan & keindahan desa
            </p>
        </div>

        {{-- Grid Galeri --}}
        <div class="row g-4 justify-content-center align-items-start mt-2">
            @forelse ($galeris as $galeri)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card gallery-card shadow border-0 h-100">
                        <div class="gallery-item" 
                             onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}')" 
                             style="cursor: pointer; height: 100%;">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                 class="card-img-top gallery-img"
                                 alt="Foto Galeri Desa">
                            <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center p-3">
                                <i class="bi bi-zoom-in fs-2 text-white mb-2"></i>
                                <small class="text-white text-uppercase fw-bold">
                                    Klik untuk memperbesar
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center shadow-sm rounded-4 py-4">
                        <i class="bi bi-info-circle-fill me-2"></i> 
                        Belum ada foto galeri yang diunggah.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $galeris->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Modal Popup Gambar --}}
<div id="galeriModal" class="galeri-modal">
    <div class="galeri-modal-content">
        <span class="galeri-close" onclick="closeModal()">&times;</span>
        <img class="galeri-modal-image" id="modalImage" alt="Foto Galeri">
    </div>
</div>

 <!-- Google Fonts Modern -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
/* Terapkan font modern */
body, .gallery-section, .gallery-header, .gallery-card, .gallery-overlay, .galeri-modal, .galeri-close {
    font-family: 'Poppins', 'Open Sans', sans-serif;
}

/* Header Galeri */
.gallery-header {
    margin-bottom: 2rem;
    margin-top: -1rem;
}
.gallery-title {
    font-size: 2.8rem;
    font-weight: 600;
    color: #2E7D32;
    line-height: 1.1;
}
.gallery-header p {
    font-size: 1.1rem;
}

/* Card Galeri */
.gallery-card {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: none;
}
.gallery-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15) !important;
}

/* Gambar galeri */
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

/* Overlay hover */
.gallery-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(46, 125, 50, 0.85);
    opacity: 0;
    transition: opacity 0.3s ease;
}
.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

/* Modal Popup */
.galeri-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0,0,0,0.95);
    overflow: auto;
    animation: fadeIn 0.3s ease;
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
.galeri-modal-content {
    position: relative;
    margin: 2% auto;
    width: 95%;
    max-width: 900px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 95vh;
}
.galeri-modal-image {
    max-width: 100%;
    max-height: 90vh;
    border-radius: 12px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.6);
    object-fit: contain;
    cursor: zoom-in;
    transition: transform 0.3s ease;
}
.galeri-modal-image.zoomed {
    transform: scale(1.8);
    cursor: zoom-out;
}
.galeri-close {
    position: absolute;
    top: -50px; right: -10px;
    color: #fff;
    font-size: 45px;
    font-weight: bold;
    cursor: pointer;
    background: rgba(255,255,255,0.2);
    width: 60px; height: 60px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.3s ease;
    border: 2px solid #fff;
    z-index: 10000;
}
.galeri-close:hover {
    background: #ff4444;
    transform: rotate(90deg);
    border-color: #ff4444;
}

@media (max-width: 768px) {
    .gallery-title { font-size: 2.2rem; }
}
</style>

<script>
function openModal(imageSrc) {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImage.src = imageSrc;
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    const modal = document.getElementById('galeriModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}
window.addEventListener('click', e => {
    const modal = document.getElementById('galeriModal');
    if (e.target === modal) closeModal();
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});
document.addEventListener('DOMContentLoaded', () => {
    const modalImage = document.getElementById('modalImage');
    modalImage.addEventListener('click', e => {
        modalImage.classList.toggle('zoomed');
        e.stopPropagation();
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
