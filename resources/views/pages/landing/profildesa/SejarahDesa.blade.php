@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Sejarah Desa</title>

<style>
/* TERAPKAN STYLING SAMA PERSIS DENGAN HALAMAN BERITA */

/* Font modern sama seperti halaman berita */
body, .container-main, .gallery-card, .content, .card, .alert {
    font-family: 'Open Sans', sans-serif;
}

h1, h2, h3, h4, h5, h6, .gallery-title, .card-title {
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

/* PERBAIKAN: Header Sejarah - SAMA PERSIS dengan halaman berita */
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

/* Container utama sejarah */
.gallery-section {
    margin-top: 2rem;
}

/* Card utama - SAMA PERSIS dengan card berita */
.gallery-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease;
    border: none;
    padding: 30px;
}

.gallery-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* Gambar sejarah */
.gallery-image-wrapper {
    text-align: center;
    margin-bottom: 30px;
}

.gallery-img {
    width: 100%;
    max-width: 800px;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Meta Data */
.gallery-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e5e7eb;
    flex-wrap: wrap;
    font-size: 0.9rem;
    color: #666;
}

.gallery-meta span {
    margin-right: 20px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.gallery-meta i {
    margin-right: 5px;
}

/* Konten */
.content {
    max-width: 1200px;
    margin: 0 auto;
}

.content h3 {
    color: #2E7D32;
    margin-bottom: 15px;
    margin-top: 30px;
    font-weight: 600;
}

.content p {
    line-height: 1.7;
    margin-bottom: 20px;
    color: #374151;
}

/* Card informasi */
.card.bg-light {
    background: #f9fafb !important;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.card.bg-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.card-body h5 {
    color: #2E7D32;
    margin-bottom: 15px;
}

.list-unstyled li {
    margin-bottom: 8px;
    color: #374151;
}

.list-unstyled strong {
    color: #2E7D32;
}

/* Blockquote */
.blockquote {
    background: #f0fdf4;
    border-left: 4px solid #16a34a !important;
    padding: 20px;
    border-radius: 8px;
    margin: 30px 0;
}

.blockquote p {
    font-size: 1.1rem;
    color: #166534;
    margin-bottom: 0;
}

/* Alert */
.alert-info {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
    border-radius: 12px;
    border-left: 4px solid #16a34a;
}

.alert-info h5 {
    color: #166534;
    margin-bottom: 10px;
}

/* Card informasi tambahan */
.card.border-0 {
    border-radius: 12px;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.card.border-0:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.card.border-0 .card-body i {
    color: #16a34a;
}

.card.border-0 .card-body h5 {
    color: #2E7D32;
    margin-bottom: 15px;
}

/* Tombol kembali */
.btn-success {
    background: #16a34a;
    border: none;
    border-radius: 10px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background: #15803d;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
}

/* PERBAIKAN: Responsive design SAMA PERSIS dengan halaman berita */
@media (max-width: 1200px) {
    .content {
        max-width: 100%;
    }
}

@media (max-width: 992px) { 
    .gallery-meta {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .gallery-meta > div {
        margin-bottom: 10px;
    }
}

@media (max-width: 768px) {
    .gallery-title { 
        font-size: 2.2rem; 
    }
    
    .container-main {
        padding: 15px;
    }
    
    .gallery-card {
        padding: 20px;
    }
    
    .gallery-header {
        margin-top: 0rem;
    }
    
    .content h3 {
        font-size: 1.4rem;
    }
}

@media (max-width: 576px) {
    .gallery-title { 
        font-size: 1.8rem; 
    }
    
    .gallery-header p {
        font-size: 1rem;
    }
    
    .gallery-card {
        padding: 15px;
    }
    
    .gallery-img {
        border-radius: 8px;
    }
    
    .content h3 {
        font-size: 1.3rem;
    }
    
    .btn-success {
        width: 100%;
    }
}
</style>

<div class="container-main">
    <!-- PERBAIKAN: Judul dengan struktur dan styling sama persis seperti halaman berita -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            SEJARAH DESA
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Mengenal asal-usul, perkembangan, dan kehidupan masyarakat Desa Manggalung
        </p>
    </div>

    <div class="gallery-section">
        {{-- Card Utama --}}
        <div class="gallery-card">
            {{-- Bagian Gambar --}}
            <div class="gallery-image-wrapper">
                <img src="{{ asset('landing/images/footer/sejarah.png') }}" 
                     alt="Sejarah Desa Manggalung" 
                     class="gallery-img">
            </div>

            {{-- Meta Data --}}
            <div class="gallery-meta">
                <div class="d-flex flex-wrap">
                    <span><i class="bi bi-geo-alt-fill"></i> Desa Manggalung, Kec. Mandalle, Kab. Pangkajene dan Kepulauan</span>
                    <span><i class="bi bi-person-fill"></i> Sumber: Wikipedia & Arsip Desa</span>
                </div>
                <div>
                    <span><i class="bi bi-calendar-event"></i> Diperbarui: {{ date('d F Y') }}</span>
                </div>
            </div>

            {{-- Konten --}}
            <div class="content">
                
                <h3>Profil Desa Manggalung</h3>
                <p><strong>Desa Manggalung</strong> adalah sebuah <strong>desa yang terletak di Kecamatan Mandalle, Kabupaten Pangkajene dan Kepulauan, Provinsi Sulawesi Selatan, Indonesia</strong>. Desa ini merupakan salah satu dari 8 desa dan kelurahan yang berada di Kecamatan Mandalle.</p>

                <h3>Letak Geografis dan Wilayah</h3>
                <p>Desa Manggalung berada di wilayah Kecamatan Mandalle yang terletak di bagian barat daya Kabupaten Pangkajene dan Kepulauan. Secara geografis, desa ini memiliki kontur tanah yang bervariasi dengan pemandangan khas pedesaan Sulawesi Selatan yang hijau dan asri.</p>

                {{-- Informasi Wilayah --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-light h-100">
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
                        <div class="card bg-light h-100">
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

                <blockquote class="blockquote">
                    <p class="mb-0 fst-italic">
                        "Desa Manggalung adalah permata tersembunyi di Kecamatan Mandalle, yang menyimpan potensi besar dalam sektor pertanian dan keindahan alamnya."
                    </p>
                </blockquote>

                <h3>Sejarah Pembentukan</h3>
                <p>Desa Manggalung memiliki sejarah panjang yang bermula dari <strong>komunitas masyarakat Bugis-Makassar</strong> yang menetap di wilayah ini sejak ratusan tahun yang lalu.</p>

                <h3>Kehidupan Sosial dan Budaya</h3>
                <p>Masyarakat Desa Manggalung dikenal dengan semangat gotong royong dan mempertahankan berbagai tradisi leluhur. Mayoritas penduduk berprofesi sebagai petani.</p>

                <h3>Potensi dan Pembangunan</h3>
                <p>Desa Manggalung memiliki potensi besar di sektor pertanian dan pariwisata.</p>

                <div class="alert alert-info">
                    <h5><i class="bi bi-lightbulb me-2"></i>Fakta Menarik</h5>
                    <p class="mb-0">Desa Manggalung merupakan salah satu desa dengan tingkat partisipasi masyarakat dalam musyawarah desa yang sangat tinggi.</p>
                </div>

                <h3>Visi Masa Depan</h3>
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
                <a href="{{ url('/') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection