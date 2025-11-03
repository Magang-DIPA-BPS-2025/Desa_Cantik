<!-- resources/views/galeri/user/index.blade.php -->
@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Galeri Desa</title>

<style>
/* TERAPKAN STYLING SAMA PERSIS DENGAN HALAMAN BERITA */

/* Font modern sama seperti halaman berita */
body, .container-main, .gallery-card, .gallery-overlay, .galeri-modal, .galeri-close {
    font-family: 'Open Sans', sans-serif;
}

h1, h2, h3, h4, h5, h6, .gallery-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

body { 
    color: #000; 
    background: #f8fafc; 
}

.container-main { 
    max-width: 1400px; 
    margin: auto; 
    padding: 20px; 
}

/* PERBAIKAN: Header Galeri - SAMA PERSIS dengan halaman berita */
.gallery-header {
    margin-bottom: 2rem;
    margin-top: -1rem;
}

.gallery-title {
    font-size: 2.8rem;
    font-weight: 600;
    color: #2E7D32;
    line-height: 1.1;
    margin-bottom: 0.5rem;
}

.gallery-header p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 0;
}

/* Container utama galeri */
.gallery-section {
    margin-top: 2rem;
}

/* Grid Galeri */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* Card Galeri - SAMA PERSIS dengan card berita */
.gallery-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease;
    cursor: pointer;
    border: none;
}

.gallery-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

.gallery-item {
    position: relative;
    height: 100%;
}

/* Gambar galeri */
.gallery-img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-card:hover .gallery-img {
    transform: scale(1.05);
}

/* Overlay hover */
.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(22, 163, 74, 0.85);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    text-align: center;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    font-size: 2rem;
    color: #fff;
    margin-bottom: 10px;
}

.gallery-overlay small {
    color: #fff;
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
}

/* Alert untuk galeri kosong */
.alert-info {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
    border-radius: 14px;
    font-family: 'Open Sans', sans-serif;
}

/* Pagination */
.pagination {
    margin-top: 3rem;
}

.page-link {
    border-radius: 10px;
    margin: 0 5px;
    border: 1px solid #e5e7eb;
    color: #374151;
    font-family: 'Open Sans', sans-serif;
}

.page-link:hover {
    background: #f0fdf4;
    border-color: #16a34a;
    color: #16a34a;
}

.page-item.active .page-link {
    background: #16a34a;
    border-color: #16a34a;
}

/* Modal Popup */
.galeri-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.95);
    overflow: auto;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn { 
    from { opacity: 0; } 
    to { opacity: 1; } 
}

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

/* Container untuk gambar dan tombol close */
.image-container {
    position: relative;
    display: inline-block;
    max-width: 100%;
}

.galeri-modal-image {
    max-width: 100%;
    max-height: 90vh;
    border-radius: 12px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.6);
    object-fit: contain;
    cursor: zoom-in;
    transition: transform 0.3s ease;
    display: block;
}

.galeri-modal-image.zoomed {
    transform: scale(1.8);
    cursor: zoom-out;
}

/* Tombol Close */
.galeri-close {
    position: absolute;
    top: 15px;
    right: 15px;
    color: #fff;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
    background: rgba(0, 0, 0, 0.6);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: 2px solid #fff;
    z-index: 10000;
    margin: 0;
}

.galeri-close:hover {
    background: #ff4444;
    transform: rotate(90deg);
    border-color: #ff4444;
}

/* PERBAIKAN: Responsive design SAMA PERSIS dengan halaman berita */
@media (max-width: 1200px) {
    .gallery-grid { 
        grid-template-columns: repeat(2, 1fr); 
    }
}

@media (max-width: 992px) { 
    .gallery-grid { 
        grid-template-columns: repeat(2, 1fr); 
    }
}

@media (max-width: 768px) {
    .gallery-title { 
        font-size: 2.2rem; 
    }
    
    .container-main {
        padding: 15px;
    }
    
    .gallery-grid { 
        grid-template-columns: 1fr; 
    }
    
    .gallery-header {
        margin-top: 0rem;
    }
    
    .galeri-close {
        top: 10px;
        right: 10px;
        width: 45px;
        height: 45px;
        font-size: 30px;
    }
}

@media (max-width: 576px) {
    .gallery-title { 
        font-size: 1.8rem; 
    }
    
    .gallery-header p {
        font-size: 1rem;
    }
    
    .gallery-grid {
        gap: 15px;
    }
    
    .galeri-close {
        top: 5px;
        right: 5px;
        width: 40px;
        height: 40px;
        font-size: 25px;
    }
    
    .gallery-img {
        height: 250px;
    }
}
</style>

<div class="container-main">
    <!-- PERBAIKAN: Judul dengan struktur dan styling sama persis seperti halaman berita -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            GALERI DESA
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Kumpulan dokumentasi kegiatan & keindahan desa
        </p>
    </div>

    <div class="gallery-section">
        {{-- Grid Galeri --}}
        <div class="gallery-grid" id="gallery-container">
            @forelse ($galeris as $galeri)
                <div class="gallery-card">
                    <div class="gallery-item" 
                         onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}')">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                             class="gallery-img"
                             alt="Foto Galeri Desa">
                        <div class="gallery-overlay">
                            <i class="bi bi-zoom-in"></i>
                            <small class="text-uppercase fw-bold">
                                Klik untuk memperbesar
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center shadow-sm py-4">
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
        <div class="image-container">
            <span class="galeri-close" onclick="closeModal()">&times;</span>
            <img class="galeri-modal-image" id="modalImage" alt="Foto Galeri">
        </div>
    </div>
</div>

<script>
function openModal(imageSrc) {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImage.src = imageSrc;
    document.body.style.overflow = 'hidden';
    
    // Reset zoom state ketika modal dibuka
    modalImage.classList.remove('zoomed');
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
@endsection