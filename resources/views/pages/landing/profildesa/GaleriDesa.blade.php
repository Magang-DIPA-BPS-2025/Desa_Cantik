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
        <div class="row g-4 justify-content-center">
            @forelse ($galeris as $galeri)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card gallery-card shadow border-0 h-100">
                        <div class="gallery-item" onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}')" 
                             style="cursor: pointer; height: 100%;">
                            <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                 class="card-img-top gallery-img"
                                 alt="Foto Galeri Desa">
                            <div class="gallery-overlay d-flex flex-column align-items-center justify-content-center p-3">
                                <i class="bi bi-zoom-in fs-2 text-white mb-2"></i>
                                <small class="text-white text-uppercase fw-bold">Klik untuk memperbesar</small>
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

{{-- Modal Popup Gambar Custom --}}
<div id="galeriModal" class="galeri-modal">
    <div class="galeri-modal-content">
        <span class="galeri-close" onclick="closeModal()">&times;</span>
        <img class="galeri-modal-image" id="modalImage" alt="Foto Galeri">
    </div>
</div>

{{-- CSS --}}
<style>
.gallery-section {
    background: linear-gradient(145deg, #f8fffb 0%, #ffffff 100%);
    min-height: 100vh;
}

.gallery-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #1b5e20;
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
    top: 0; 
    left: 0;
    width: 100%; 
    height: 100%;
    background: rgba(46, 125, 50, 0.85);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

/* ---------------- Modal Galeri Custom ---------------- */
.galeri-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
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
    animation: zoomIn 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 95vh;
}

@keyframes zoomIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
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

/* Tombol Close Modal */
.galeri-close {
    position: absolute;
    top: -50px;
    right: -10px;
    color: #fff;
    font-size: 45px;
    font-weight: bold;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.2);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: 2px solid #fff;
    z-index: 10000;
}

.galeri-close:hover {
    background: #ff4444;
    transform: rotate(90deg);
    border-color: #ff4444;
}

/* Responsive untuk modal */
@media (max-width: 768px) {
    .galeri-modal-content {
        width: 98%;
        margin: 5% auto;
    }
    
    .galeri-close {
        top: -40px;
        right: 5px;
        width: 50px;
        height: 50px;
        font-size: 35px;
    }
    
    .galeri-modal-image.zoomed {
        transform: scale(1.3);
    }
}

@media (max-width: 576px) {
    .galeri-close {
        top: -35px;
        right: 10px;
        width: 45px;
        height: 45px;
        font-size: 30px;
    }
    
    .gallery-title {
        font-size: 2.2rem;
    }
}

/* Efek loading untuk gambar */
.galeri-modal-image.loading {
    opacity: 0.7;
}

/* Navigation untuk multiple images (jika ingin ditambahkan later) */
.galeri-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: none;
    font-size: 24px;
    padding: 15px;
    cursor: pointer;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.galeri-nav:hover {
    background: rgba(255, 255, 255, 0.3);
}

.galeri-nav.prev {
    left: 20px;
}

.galeri-nav.next {
    right: 20px;
}
</style>

{{-- JavaScript --}}
<script>
// ---------------- Modal Galeri Functions ----------------
function openModal(imageSrc) {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    
    // Tampilkan loading state
    modalImage.classList.add('loading');
    
    modal.style.display = 'block';
    modalImage.src = imageSrc;
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
    
    // Remove loading state when image is loaded
    modalImage.onload = function() {
        modalImage.classList.remove('loading');
    }
}

function closeModal() {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    
    modal.style.display = 'none';
    modalImage.classList.remove('zoomed');
    
    // Restore body scroll
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the image
window.addEventListener('click', function(event) {
    const modal = document.getElementById('galeriModal');
    if (event.target === modal) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// Zoom functionality
document.addEventListener('DOMContentLoaded', function() {
    const modalImage = document.getElementById('modalImage');
    
    modalImage.addEventListener('click', function(e) {
        this.classList.toggle('zoomed');
        e.stopPropagation();
    });
});

// Optional: Add keyboard navigation for zoom
document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    
    if (modal.style.display === 'block') {
        if (event.key === ' ' || event.key === 'z') {
            event.preventDefault();
            modalImage.classList.toggle('zoomed');
        }
    }
});

// Optional: Close modal when zoomed and clicking outside
document.getElementById('galeriModal').addEventListener('click', function(e) {
    const modalImage = document.getElementById('modalImage');
    if (modalImage.classList.contains('zoomed') && e.target !== modalImage) {
        modalImage.classList.remove('zoomed');
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection