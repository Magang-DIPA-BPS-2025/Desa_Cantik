@extends('layouts.landing.app')

@section('content')
<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Open+Sans:wght@300;400;500;600&display=swap');

/* Font Variables */
:root {
    --font-heading: 'Poppins', sans-serif;
    --font-body: 'Open Sans', sans-serif;
}

/* Apply Fonts */
.ppid-heading {
    font-family: var(--font-heading) !important;
    font-weight: 700 !important;
    letter-spacing: -0.02em !important;
}

.ppid-text-content {
    font-family: var(--font-body) !important;
    font-weight: 400 !important;
    line-height: 1.6 !important;
}

.ppid-card-title {
    font-family: var(--font-heading) !important;
    font-weight: 600 !important;
}

/* === BAGIAN ATAS: TEKS KIRI + ICON KANAN === */
.ppid-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 60px;
    margin-bottom: 80px;
}

.ppid-text {
    flex: 1;
    min-width: 350px;
    max-width: 45%;
}

.ppid-text h2 {
    font-size: 3rem;
    font-weight: 800;
    color: #2E7D32;
    margin-bottom: 15px;
    font-family: var(--font-heading);
}

.ppid-text p {
    color: #333;
    font-size: 1.15rem;
    line-height: 1.8;
    text-align: justify;
    font-family: var(--font-body);
}

.ppid-text .btn {
    margin-top: 25px;
    padding: 14px 35px;
    font-size: 1.05rem;
    font-weight: 600;
    border-radius: 10px;
    font-family: var(--font-body);
}

.ppid-text .btn-primary {
    background-color: #2E7D32;
    border: none;
}

.ppid-text .btn-primary:hover {
    background-color: #2E7D32;
}

/* === KANAN: 3 ICON SEJEJAR === */
.ppid-icons {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: nowrap;
    width: 100%;
    max-width: 600px;
}

.ppid-icon-card {
    flex: 1 1 30%;
    max-width: 200px;
    min-width: 180px;
    background: #fff;
    border-radius: 20px;
    padding: 25px 15px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
}

.ppid-icon-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 22px rgba(0, 128, 0, 0.15);
}

.ppid-icon-card img {
    width: 95px;
    height: 95px;
    object-fit: contain;
    margin-bottom: 12px;
}

.ppid-icon-card h5 {
    font-weight: 700;
    font-size: 1rem;
    color: #1b7d48;
    line-height: 1.4;
    font-family: var(--font-heading);
}

/* === INFORMASI PUBLIK TERBARU === */
.ppid-section {
    background-color: #f8faf9;
    padding: 60px 0;
}

.ppid-header {
    color: #2E7D32;
    font-weight: 800;
    font-size: 2.2rem;
    margin-bottom: 10px;
    font-family: var(--font-heading);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ppid-subtitle {
    color: #4b4b4b;
    font-size: 1rem;
    margin-bottom: 40px;
    font-family: var(--font-body);
}

.ppid-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 35px 40px;
    margin-bottom: 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    transition: 0.3s;
    flex-wrap: wrap;
}

.ppid-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.1);
}

.ppid-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2E7D32;
    margin-bottom: 10px;
    font-family: var(--font-heading);
}

.ppid-desc {
    color: #444;
    font-size: 1rem;
    margin-bottom: 15px;
    font-family: var(--font-body);
}

.ppid-date {
    font-size: 0.9rem;
    color: #6c757d;
    font-family: var(--font-body);
}

/* === TOMBOL === */
.btn-view,
.btn-download {
    font-weight: 600;
    border-radius: 10px;
    padding: 14px 32px;
    font-size: 1.05rem;
    transition: 0.2s;
    width: 180px;
    text-align: center;
    font-family: var(--font-body);
}

.btn-view {
    background-color: #2E7D32;
    color: #fff;
    border: none;
}

.btn-view:hover {
    background-color: #2E7D32;
    color: #fff;
}

.btn-download {
    border: 2px solid #2E7D32;
    color: #2E7D32;
    background: #fff;
}

.btn-download:hover {
    background: #2E7D32;
    color: #fff;
}

/* === CARD AJUKAN PERMOHONAN === */
.permohonan-card {
    font-family: var(--font-body);
}

.permohonan-card .card-title {
    font-family: var(--font-heading);
    font-weight: 600;
}

/* === RESPONSIF === */
@media (max-width: 1200px) {
    .ppid-icons {
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 992px) {
    .ppid-top {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
        gap: 40px;
    }
    
    .ppid-text {
        max-width: 100%;
        text-align: left;
    }
    
    .ppid-icons {
        justify-content: flex-start;
        max-width: 100%;
    }
    
    .ppid-header {
        white-space: normal;
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .ppid-top {
        gap: 30px;
    }
    
    .ppid-text h2 {
        font-size: 2.2rem;
    }
    
    .ppid-icons {
        flex-direction: column;
        align-items: center;
    }
    
    .ppid-icon-card {
        min-width: 250px;
        max-width: 300px;
        width: 100%;
    }
    
    .ppid-header {
        font-size: 1.6rem;
        line-height: 1.3;
    }
}

@media (max-width: 576px) {
    .ppid-text h2 {
        font-size: 1.8rem;
    }
    
    .ppid-text p {
        font-size: 1rem;
        text-align: left;
    }
    
    .ppid-card {
        padding: 25px 20px;
    }
    
    .ppid-header {
        font-size: 1.4rem;
    }
}
</style>

<div class="container py-5">
    {{-- === TEKS KIRI + ICON KANAN === --}}
    <div class="ppid-top">
        <!-- KIRI -->
        <div class="ppid-text">
            <h2 class="ppid-heading">PPID</h2>
            <p class="ppid-text-content">
                Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang bertanggung jawab di bidang penyimpanan,
                pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik.
            </p>
            <a href="{{ route('ppid.dasar-hukum') }}" target="_blank" class="btn btn-primary ppid-text-content">Dasar Hukum PPID</a>
        </div>

        <!-- KANAN: 3 ICON SEJEJAR -->
        <div class="ppid-icons">
            <a href="{{ route('ppid.berkala') }}" class="ppid-icon-card">
                <img src="{{ asset('img/berkala.png') }}" alt="Informasi Berkala">
                <h5 class="ppid-card-title">INFORMASI SECARA BERKALA</h5>
            </a>

            <a href="{{ route('ppid.serta') }}" class="ppid-icon-card">
                <img src="{{ asset('img/serta.png') }}" alt="Informasi Serta Merta">
                <h5 class="ppid-card-title">INFORMASI SERTA MERTA</h5>
            </a>

            <a href="{{ route('ppid.setiap') }}" class="ppid-icon-card">
                <img src="{{ asset('img/setiap.png') }}" alt="Informasi Setiap Saat">
                <h5 class="ppid-card-title">INFORMASI SETIAP SAAT</h5>
            </a>
        </div>
    </div>

    {{-- === INFORMASI PUBLIK TERBARU === --}}
    <div class="ppid-section">
        <div class="mb-5">
            <h2 class="ppid-header">📗 Informasi Publik Terbaru</h2>
            <p class="ppid-subtitle">Update informasi publik resmi dari Desa</p>
        </div>

        @if($ppids->count() > 0)
            @foreach($ppids as $ppid)
            <div class="ppid-card">
                <div style="flex: 1; min-width: 300px;">
                    <h5 class="ppid-title">{{ strtoupper($ppid->judul) }}</h5>
                    <p class="ppid-desc">{{ Str::limit($ppid->deskripsi, 180) }}</p>
                    <p class="ppid-date"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($ppid->tanggal)->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="d-flex flex-column align-items-end gap-2">
                    @if($ppid->file)
                        <button class="btn btn-view mb-2 ppid-text-content" data-toggle="modal" data-target="#fileModal" data-file="{{ asset('storage/' . $ppid->file) }}">
                            <i class="fas fa-file-pdf"></i> Lihat Berkas
                        </button>
                        <a href="{{ asset('storage/' . $ppid->file) }}" download class="btn btn-download ppid-text-content">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                    @else
                        <span class="text-muted ppid-text-content">Tidak ada berkas</span>
                    @endif
                </div>
            </div>
            @endforeach
        @else
            <div class="alert alert-info text-center mt-4 ppid-text-content">
                Belum ada data PPID yang ditambahkan.
            </div>
        @endif
    </div>
    
    <div class="container my-5 d-flex justify-content-center">
        <div class="card shadow-sm border-0 text-center permohonan-card" style="max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title mb-4 ppid-heading" style="font-size: 1.5rem;">📄 Ingin mengajukan permohonan informasi?</h5>
                <a href="{{ route('userindex') }}" 
                   class="btn btn-success btn-lg ppid-text-content"
                   style="background-color: #2E7D32; border-color: #2E7D32;">
                    Ajukan Permohonan
                </a>
            </div>
        </div>
    </div>
</div>

<!-- === MODAL PRATINJAU FILE === -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ppid-heading">📄 Pratinjau Berkas PPID</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 80vh;">
        <iframe id="fileFrame" src="" style="width: 100%; height: 100%; border: none;"></iframe>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#fileModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const fileUrl = button.data('file');
        $(this).find('#fileFrame').attr('src', fileUrl);
    });

    $('#fileModal').on('hidden.bs.modal', function () {
        $('#fileFrame').attr('src', '');
    });
});
</script>
@endsection