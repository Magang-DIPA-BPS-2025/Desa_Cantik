@extends('layouts.landing.app')

@section('content')
<div class="gallery-section py-5">
    <div class="container-fluid px-lg-5">
       
        {{-- Judul Halaman --}}
        <div class="text-start mb-4 mt-2 px-2 gallery-header">
            <h2 class="fw-semibold display-4 mb-2 gallery-title">
                <i class="bi bi-images me-2"></i> SEJARAH DESA
            </h2>
            <p class="text-secondary fs-5 mb-0">
                Mengenal asal-usul, perkembangan, dan kehidupan masyarakat Desa Manggalung
            </p>
        </div>

        {{-- Card Utama --}}
        <div class="card gallery-card shadow border-0 h-100 px-4 py-5 px-lg-6 py-lg-6">

            {{-- Bagian Gambar --}}
            <div class="gallery-image-wrapper mb-5">
                <img src="{{ asset('landing/images/footer/sejarah.png') }}" 
                     alt="Sejarah Desa Manggalung" 
                     class="gallery-img">
            </div>

            {{-- Meta Data --}}
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap small text-secondary border-bottom pb-3">
                <div class="d-flex flex-wrap">
                    <span class="me-3 mb-2 mb-sm-0"><i class="bi bi-geo-alt-fill me-1"></i> Desa Manggalung, Kec. Mandalle, Kab. Pangkajene dan Kepulauan</span>
                    <span class="me-3 mb-2 mb-sm-0"><i class="bi bi-person-fill me-1"></i> Sumber: Wikipedia & Arsip Desa</span>
                </div>
                <div>
                    <span class="mb-2 mb-sm-0"><i class="bi bi-calendar-event me-1"></i> Diperbarui: {{ date('d F Y') }}</span>
                </div>
            </div>

            {{-- Konten --}}
            <div class="content py-3 mx-auto" style="max-width: 1200px;">
                
                <h3>Profil Desa Manggalung</h3>
                <p><strong>Desa Manggalung</strong> adalah sebuah <strong>desa yang terletak di Kecamatan Mandalle, Kabupaten Pangkajene dan Kepulauan, Provinsi Sulawesi Selatan, Indonesia</strong>. Desa ini merupakan salah satu dari 8 desa dan kelurahan yang berada di Kecamatan Mandalle.</p>

                <h3 class="mt-5">Letak Geografis dan Wilayah</h3>
                <p>Desa Manggalung berada di wilayah Kecamatan Mandalle yang terletak di bagian barat daya Kabupaten Pangkajene dan Kepulauan. Secara geografis, desa ini memiliki kontur tanah yang bervariasi dengan pemandangan khas pedesaan Sulawesi Selatan yang hijau dan asri.</p>

                {{-- Informasi Wilayah --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-info-circle me-2"></i>Informasi Umum</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Provinsi:</strong> Sulawesi Selatan</li>
                                    <li><strong>Kabupaten:</strong> Pangkajene dan Kepulauan</li>
                                    <li><strong>Kecamatan:</strong> Mandalle</li>
                                    <li><strong>Kode Pos:</strong> 90655</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-geo me-2"></i>Data Wilayah</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Jumlah Dusun:</strong> 4 Dusun</li>
                                    <li><strong>Luas Wilayah:</strong> 2,04 km²</li>
                                    <li><strong>Ketinggian:</strong> 10-50 mdpl</li>
                                    <li><strong>Batas Wilayah:</strong> 
                                        <small>Utara: Desa X, Selatan: Desa Y, Barat: Desa Z, Timur: Desa A</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <blockquote class="blockquote border-start border-success border-4 ps-3 my-5">
                    <p class="mb-0 fst-italic text-dark">
                        "Desa Manggalung adalah permata tersembunyi di Kecamatan Mandalle, yang menyimpan potensi besar dalam sektor pertanian dan keindahan alamnya."
                    </p>
                </blockquote>

                <h3 class="mt-5">Sejarah Pembentukan</h3>
                <p>Desa Manggalung memiliki sejarah panjang yang bermula dari <strong>komunitas masyarakat Bugis-Makassar</strong> yang menetap di wilayah ini sejak ratusan tahun yang lalu.</p>

                <h3 class="mt-5">Kehidupan Sosial dan Budaya</h3>
                <p>Masyarakat Desa Manggalung dikenal dengan semangat gotong royong dan mempertahankan berbagai tradisi leluhur. Mayoritas penduduk berprofesi sebagai petani.</p>

                <h3 class="mt-5">Potensi dan Pembangunan</h3>
                <p>Desa Manggalung memiliki potensi besar di sektor pertanian dan pariwisata.</p>

                <div class="alert alert-info mt-4">
                    <h5><i class="bi bi-lightbulb me-2"></i>Fakta Menarik</h5>
                    <p class="mb-0">Desa Manggalung merupakan salah satu desa dengan tingkat partisipasi masyarakat dalam musyawarah desa yang sangat tinggi.</p>
                </div>

                <h3 class="mt-5">Visi Masa Depan</h3>
                <p>Desa Manggalung berkomitmen untuk menjadi <strong>desa yang mandiri, sejahtera, dan berkelanjutan</strong>.</p>
            </div>

            {{-- Informasi Tambahan --}}
            <div class="row mt-5 pt-4 border-top">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 h-100 text-center">
                        <div class="card-body">
                            <i class="bi bi-people-fill display-4 text-success mb-3"></i>
                            <h5>Kependudukan</h5>
                            <p class="text-muted">Masyarakat yang ramah dan menjunjung tinggi nilai kekeluargaan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 h-100 text-center">
                        <div class="card-body">
                            <i class="bi bi-tree-fill display-4 text-success mb-3"></i>
                            <h5>Potensi Alam</h5>
                            <p class="text-muted">Lahan pertanian subur dengan panorama alam yang mempesona</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 h-100 text-center">
                        <div class="card-body">
                            <i class="bi bi-house-heart-fill display-4 text-success mb-3"></i>
                            <h5>Budaya</h5>
                            <p class="text-muted">Tradisi dan adat istiadat yang tetap lestari di era modern</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="text-center mt-5 pt-3 border-top">
                <a href="{{ url('/') }}" class="btn btn-success btn-lg shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</div>

<!-- Google Fonts -->
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
@endsection
