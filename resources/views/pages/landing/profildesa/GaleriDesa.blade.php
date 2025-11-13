@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Galeri Desa</title>

<style>

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

/* PERBAIKAN: Header Galeri - SAMA PERSIS dengan halaman agenda */
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
    color: #000;
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

/* Card Galeri - SAMA PERSIS dengan card agenda */
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

/* Loading indicator */
.loading-indicator {
    text-align: center;
    padding: 20px;
    display: none;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #16a34a;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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

/* PERBAIKAN: Responsive design SAMA PERSIS dengan halaman agenda */
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
            @forelse ($initialGaleris as $galeri)
                <div class="gallery-card">
                    <div class="gallery-item" 
                         onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}', '{{ addslashes($galeri->judul) }}')">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                             class="gallery-img"
                             alt="{{ $galeri->judul }}">
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

        {{-- Loading indicator untuk infinite scroll --}}
        <div class="loading-indicator" id="loading-indicator">
            <div class="loading-spinner"></div>
            <p style="margin-top: 10px;">Memuat galeri...</p>
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
// Infinite scroll implementation untuk galeri
let isLoading = false;
let page = 1;
let hasMore = true;

function openModal(imageSrc, title) {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImage.src = imageSrc;
    modalImage.alt = title;
    document.body.style.overflow = 'hidden';
    modalImage.classList.remove('zoomed');
}

function closeModal() {
    const modal = document.getElementById('galeriModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Check if we're at the bottom of the page
function isBottomOfPage() {
    return window.innerHeight + window.scrollY >= document.body.offsetHeight - 500;
}

// Load more galeri
async function loadMoreGaleri() {
    if (isLoading || !hasMore) return;
    
    isLoading = true;
    document.getElementById('loading-indicator').style.display = 'block';
    
    try {
        page++;
        const response = await fetch(`{{ route('galeri.user.index') }}?page=${page}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        if (!response.ok) throw new Error('Network response was not ok');
        
        const data = await response.json();
        
        if (data.html) {
            document.getElementById('gallery-container').insertAdjacentHTML('beforeend', data.html);
        }
        
        // Update status hasMore
        hasMore = data.hasMore;
        
    } catch (error) {
        console.error('Error loading more galeri:', error);
        hasMore = false;
    } finally {
        isLoading = false;
        document.getElementById('loading-indicator').style.display = 'none';
    }
}

// Event listeners
window.addEventListener('scroll', () => {
    if (isBottomOfPage()) loadMoreGaleri();
});

window.addEventListener('load', () => {
    if (isBottomOfPage()) loadMoreGaleri();
});

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
