@extends('layouts.landing.app')

@section('content')
<div class="history-section py-5 py-lg-6" style="min-height: 100vh;">
    <div class="container-fluid px-0 px-lg-5">

        {{-- Judul --}}
        <div class="text-start mb-4 mt-2 px-2 gallery-header">
            <h2 class="fw-bolder display-4 mb-2 gallery-title">
                <i class="bi bi-images me-2"></i> SEJARAH DESA
            </h2>
            <p class="text-secondary fs-5 mb-0">
                Mengenal asal-usul, perkembangan, dan kehidupan masyarakat Desa Manggalung
            </p>
        </div>

        {{-- Card Konten UTAMA --}}
        <div class="card border-0 shadow-lg rounded-0 history-card px-4 py-5 px-lg-6 py-lg-6">

            {{-- 🖼️ BAGIAN FOTO --}}
            <div class="history-image-wrapper mb-5">
                <img src="{{ asset('landing/images/footer/sejarah.png') }}" 
                     alt="Sejarah Desa Manggalung" 
                     class="history-image">
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

            {{-- Isi Konten --}}
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

<style>
/* Sama persis dengan galeri */
.gallery-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #000000ff;
}

.history-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.history-card {
    background: #fff;
    border-radius: 16px !important;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}
.history-card:hover {
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
}

.history-image-wrapper {
    width: 100%;
    height: 420px;
    overflow: hidden;
}
.history-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.history-image:hover {
    transform: scale(1.03);
}

.content h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1B5E20;
    padding-bottom: 8px;
    position: relative;
}
.content h3::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 70px;
    height: 4px;
    background: #4CAF50;
    border-radius: 2px;
}
.content p {
    font-size: 1.15rem;
    line-height: 1.9;
    color: #343a40;
    text-align: justify;
}
@media (max-width: 768px) {
    .history-image-wrapper { height: 250px; }
    .gallery-title { font-size: 2.2rem; }
}
</style>
@endsection
