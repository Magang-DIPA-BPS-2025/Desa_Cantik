@extends('layouts.landing.app')

@section('content')

<style>
    body { 
        background-color: #f8fafc; 
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
        color: #333;
    }
    
    /* Header Section - Mengikuti gaya dari halaman jumlah penduduk */
    .container-main { 
        max-width: 1400px; 
        margin: auto; 
        padding: 20px; 
    }

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
        font-family: 'Poppins', sans-serif;
    }

    .gallery-header p {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 0;
        font-family: 'Open Sans', sans-serif;
    }

    /* Card Style - Mengikuti gaya dari halaman jumlah penduduk */
    .card { 
        background: #fff; 
        border-radius: 14px; 
        padding: 25px; 
        box-shadow: 0 8px 20px rgba(0,0,0,0.06); 
        transition: .25s; 
        border: none;
        margin-bottom: 25px;
    }

    .card:hover { 
        transform: translateY(-3px); 
        box-shadow: 0 12px 28px rgba(0,0,0,0.12); 
    }

    /* PPID Top Section - Layout dengan 3 card terpisah */
    .ppid-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 60px;
        margin-bottom: 40px;
    }

    .ppid-text {
        flex: 1;
        min-width: 350px;
        max-width: 45%;
    }

    .ppid-text h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2E7D32;
        margin-bottom: 15px;
        font-family: 'Poppins', sans-serif;
    }

    .ppid-text p {
        color: #333;
        font-size: 1.1rem;
        line-height: 1.7;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }

    /* 3 Icon Card Terpisah - Masing-masing card sendiri */
    .ppid-icons-container {
        flex: 1;
        min-width: 350px;
        max-width: 45%;
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .ppid-icon-card {
        background: #fff;
        border-radius: 14px;
        padding: 30px 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        flex: 1;
        text-align: center;
        min-width: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .ppid-icon-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }

    .ppid-icon-card img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .ppid-icon-card h5 {
        font-weight: 600;
        font-size: 0.85rem;
        color: #2E7D32;
        line-height: 1.4;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        text-align: center;
    }

    /* Button Styles */
    .btn-primary { 
        background: linear-gradient(135deg, #2E7D32, #4CAF50); 
        color: #fff; 
        border: none; 
        padding: 12px 24px; 
        border-radius: 8px; 
        font-size: 14px; 
        cursor: pointer; 
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-primary:hover { 
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
        color: #fff;
        text-decoration: none;
    }

    .btn-view {
        background: linear-gradient(135deg, #2E7D32, #4CAF50);
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        text-align: center;
        font-family: 'Open Sans', sans-serif;
    }

    .btn-download {
        background: transparent;
        color: #2E7D32;
        border: 2px solid #2E7D32;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        text-align: center;
        font-family: 'Open Sans', sans-serif;
        text-decoration: none;
        display: inline-block;
    }

    .btn-download:hover {
        background: #2E7D32;
        color: #fff;
        text-decoration: none;
    }

    /* PPID Content Styles */
    .ppid-content {
        font-family: 'Open Sans', sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .ppid-section-title {
        color: #2E7D32;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.3rem;
        font-family: 'Poppins', sans-serif;
    }

    .ppid-item {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .ppid-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .ppid-item-title {
        color: #2E7D32;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.1rem;
        font-family: 'Poppins', sans-serif;
    }

    .ppid-item-desc {
        color: #666;
        margin-bottom: 15px;
        font-family: 'Open Sans', sans-serif;
    }

    .ppid-item-date {
        color: #888;
        font-size: 0.9rem;
        font-family: 'Open Sans', sans-serif;
    }

    .ppid-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 15px;
    }

    /* Alert Styles */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        border: none;
        font-weight: 500;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }
    
    .alert-info {
        background: #d1ecf1;
        color: #0c5460;
        border-left: 4px solid #17a2b8;
    }

    /* Permohonan Card di Tengah */
    .permohonan-card {
        background: #fff;
        border-radius: 14px;
        padding: 40px 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        transition: .25s;
        border: none;
        margin: 40px auto;
        max-width: 500px;
        text-align: center;
    }

    .permohonan-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }
    
    @media (max-width: 1200px) {
        .ppid-icons-container {
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
        
        .ppid-icons-container {
            max-width: 100%;
            justify-content: space-between;
        }
    }

    @media (max-width: 768px) {
        .ppid-top {
            gap: 30px;
        }
        
        .ppid-text h2 {
            font-size: 2.2rem;
        }
        
        .ppid-icons-container {
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        
        .ppid-icon-card {
            min-width: 250px;
            max-width: 300px;
            width: 100%;
        }
        
        .gallery-title {
            font-size: 2.2rem;
        }
        
        .ppid-actions {
            flex-direction: column;
        }

        .permohonan-card {
            margin: 30px auto;
            padding: 30px 20px;
        }
    }

    @media (max-width: 576px) {
        .gallery-title { 
            font-size: 1.8rem; 
        }
        
        .gallery-header p {
            font-size: 1rem;
        }
        
        .container-main {
            padding: 15px;
        }
        
        .ppid-item {
            padding: 20px;
        }

        .permohonan-card {
            padding: 25px 15px;
            margin: 20px auto;
        }

        .ppid-icons-container {
            gap: 10px;
        }

        .ppid-icon-card {
            padding: 20px 15px;
        }

        .ppid-icon-card img {
            width: 60px;
            height: 60px;
        }

        .ppid-icon-card h5 {
            font-size: 0.8rem;
        }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="container-main">
    <!-- Judul Halaman - Mengikuti gaya dari halaman jumlah penduduk -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
    <div class="ppid-top">
        <!-- KIRI: Tentang PPID TANPA CARD -->
        <div class="ppid-text">
            <h2>PPID</h2>
            <p class="ppid-content">
                Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang bertanggung jawab di bidang penyimpanan,
                pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik. PPID Desa Manggalung berkomitmen
                untuk memberikan pelayanan informasi yang transparan dan akuntabel kepada masyarakat.
            </p>
            <a href="{{ route('ppid.dasar-hukum') }}" class="btn-primary">
    <i class="bi bi-journal-text me-2"></i> Dasar Hukum PPID
</a>
        </div>

        <!-- KANAN: 3 Icon Card Terpisah - Masing-masing card sendiri -->
        <div class="ppid-icons-container">
            <a href="{{ route('ppid.berkala') }}" class="ppid-icon-card">
                <img src="{{ asset('img/berkala.png') }}" alt="Informasi Berkala" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDIyQzE3LjUyMjggMjIgMjIgMTcuNTIyOCAyMiAxMkMyMiA2LjQ3NzE1IDE3LjUyMjggMiAxMiAyQzYuNDc3MTUgMiAyIDYuNDc3MTUgMiAxMkMyIDE3LjUyMjggNi40NzcxNSAyMiAxMiAyMloiIGZpbGw9IiMyRTdEMzIiIGZpbGwtb3BhY2l0eT0iMC4xIi8+CjxwYXRoIGQ9Ik0xMiAxNkMxNC4yMDkxIDE2IDE2IDE0LjIwOTEgMTYgMTJDMTYgOS43OTA4NiAxNC4yMDkxIDggMTIgOEM5Ljc5MDg2IDggOCA5Ljc5MDg2IDggMTJDOCAxNC4yMDkxIDkuNzkwODYgMTYgMTIgMTZaIiBmaWxsPSIjMkU3RDMyIi8+CjxwYXRoIGQ9Ik0xMiA3VjEzIiBzdHJva2U9IiMyRTdEMzIiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+CjxwYXRoIGQ9Ik03IDEySDE3IiBzdHJva2U9IiMyRTdEMzIiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+Cjwvc3ZnPgo='">
                <h5>INFORMASI SECARA BERKALA</h5>
            </a>

            <a href="{{ route('ppid.serta') }}" class="ppid-icon-card">
                <img src="{{ asset('img/serta.png') }}" alt="Informasi Serta Merta" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDIyQzE3LjUyMjggMjIgMjIgMTcuNTIyOCAyMiAxMkMyMiA2LjQ3NzE1IDE3LjUyMjggMiAxMiAyQzYuNDc3MTUgMiAyIDYuNDc3MTUgMiAxMkMyIDE3LjUyMjggNi40NzcxNSAyMiAxMiAyMloiIGZpbGw9IiMyRTdEMzIiIGZpbGwtb3BhY2l0eT0iMC4xIi8+CjxwYXRoIGQ9Ik0xMiA2VjEyTDE2IDE0IiBzdHJva2U9IiMyRTdEMzIiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cjwvc3ZnPgo='">
                <h5>INFORMASI SERTA MERTA</h5>
            </a>

            <a href="{{ route('ppid.setiap') }}" class="ppid-icon-card">
                <img src="{{ asset('img/setiap.png') }}" alt="Informasi Setiap Saat" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDIyQzE3LjUyMjggMjIgMjIgMTcuNTIyOCAyMiAxMkMyMiA2LjQ3NzE1IDE3LjUyMjggMiAxMiAyQzYuNDc3MTUgMiAyIDYuNDc3MTUgMiAxMkMyIDE3LjUyMjggNi40NzcxNSAyMiAxMiAyMloiIGZpbGw9IiMyRTdEMzIiIGZpbGwtb3BhY2l0eT0iMC4xIi8+CjxwYXRoIGQ9Ik0xMiA2VjEyTDE2IDE0IiBzdHJva2U9IiMyRTdEMzIiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+CjxjaXJjbGUgY3g9IjEyIiBjeT0iMTIiIHI9IjkiIHN0cm9rZT0iIzJFN0QzMiIgc3Ryb2tlLXdpZHRoPSIyIi8+Cjwvc3ZnPgo='">
                <h5>INFORMASI SETIAP SAAT</h5>
            </a>
        </div>
    </div>

    <!-- Informasi Publik Terbaru dalam Card -->
    <div class="card">
        <div class="form-group">
            <h5 class="ppid-section-title">
                <i class="bi bi-info-circle me-2"></i>
                Informasi Publik Terbaru
            </h5>
            <p class="ppid-content text-muted">
                Update informasi publik resmi dari Desa Manggalung
            </p>
        </div>

        @if($ppids->count() > 0)
            @foreach($ppids as $ppid)
            <div class="ppid-item">
                <div class="ppid-item-title">{{ $ppid->judul }}</div>
                <div class="ppid-item-desc">{{ Str::limit($ppid->deskripsi, 200) }}</div>
                <div class="ppid-item-date">
                    <i class="bi bi-calendar me-1"></i>
                    {{ \Carbon\Carbon::parse($ppid->tanggal)->translatedFormat('l, d F Y') }}
                </div>
                <div class="ppid-actions">
                    @if($ppid->file)
                        <button class="btn-view" data-toggle="modal" data-target="#fileModal" data-file="{{ asset('storage/' . $ppid->file) }}">
                            <i class="bi bi-eye me-1"></i> Lihat Berkas
                        </button>
                        <a href="{{ asset('storage/' . $ppid->file) }}" download class="btn-download">
                            <i class="bi bi-download me-1"></i> Unduh
                        </a>
                    @else
                        <span class="text-muted ppid-content">Tidak ada berkas tersedia</span>
                    @endif
                </div>
            </div>
            @endforeach
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>Belum ada data PPID yang ditambahkan.
            </div>
        @endif
    </div>

    <!-- Card Ajukan Permohonan - DI TENGAH -->
    <div class="permohonan-card">
        <h5 class="ppid-section-title mb-3">
            <i class="bi bi-file-earmark-plus me-2"></i>
            Ingin mengajukan permohonan informasi?
        </h5>
        <p class="ppid-content text-muted mb-4">
            Ajukan permohonan informasi publik melalui sistem PPID Desa Manggalung
        </p>
        <a href="{{ route('userindex') }}" class="btn-primary">
            <i class="bi bi-send me-2"></i> Ajukan Permohonan
        </a>
    </div>
</div>
</div>

<!-- Modal Pratinjau File -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="ppid-section-title mb-0">Pratinjau Berkas PPID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 70vh;">
                <iframe id="fileFrame" src="" style="width: 100%; height: 100%; border: none; border-radius: 8px;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileModal = document.getElementById('fileModal');
    if (fileModal) {
        fileModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const fileUrl = button.getAttribute('data-file');
            document.getElementById('fileFrame').src = fileUrl;
        });

        fileModal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('fileFrame').src = '';
        });
    }
});
</script>
@endsection