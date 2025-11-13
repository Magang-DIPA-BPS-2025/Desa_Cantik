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

    /* PERBAIKAN: PPID Top Section - Layout dengan 3 card sejajar teks (bukan judul) */
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
        /* PERBAIKAN: Tambah jarak antara teks dan button */
        margin-bottom: 30px;
    }

    /* PERBAIKAN: 3 Icon Card - Turunkan posisi agar sejajar dengan teks */
    .ppid-icons-container {
        flex: 1;
        min-width: 350px;
        max-width: 45%;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        /* PERBAIKAN: Turunkan card agar sejajar dengan teks (bukan judul) */
        margin-top: 60px;
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
        text-decoration: none;
        color: inherit;
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

    .btn-view:hover {
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
    }

    .btn-download {
        background: linear-gradient(135deg, #2E7D32, #4CAF50);
        color: #ffffffff;
        border: none;
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
        border-left: 4px solid #2E7D32;
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
        line-height: 1.5;
    }

    .ppid-item-date {
        color: #888;
        font-size: 0.9rem;
        font-family: 'Open Sans', sans-serif;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
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

    /* PERBAIKAN: Modal Styles yang lebih sederhana dan fix */
    .custom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .custom-modal.show {
        display: flex;
    }

    .custom-modal-content {
        background: white;
        border-radius: 14px;
        width: 90%;
        max-width: 1000px;
        max-height: 90vh;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        display: flex;
        flex-direction: column;
    }

    .custom-modal-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8fafc;
        border-radius: 14px 14px 0 0;
        flex-shrink: 0;
    }

    .custom-modal-title {
        color: #2E7D32;
        font-weight: 600;
        font-size: 1.3rem;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        line-height: 1.3;
    }

    .custom-close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #6b7280;
        cursor: pointer;
        padding: 5px;
        line-height: 1;
        transition: all 0.3s ease;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }

    .custom-close-btn:hover {
        color: #374151;
        background: #f1f5f9;
    }

    .custom-modal-body {
        flex: 1;
        padding: 0;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .file-preview-container {
        flex: 1;
        width: 100%;
        border-radius: 0 0 14px 14px;
        overflow: hidden;
        background: #f8f9fa;
        position: relative;
    }

    .file-iframe {
        width: 100%;
        height: 100%;
        border: none;
        background: white;
    }

    .file-not-supported {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        padding: 40px;
        text-align: center;
        background: #f8f9fa;
    }

    .file-not-supported i {
        font-size: 3rem;
        color: #6b7280;
        margin-bottom: 15px;
    }

    .file-not-supported h5 {
        color: #374151;
        margin-bottom: 10px;
        font-family: 'Poppins', sans-serif;
    }

    .file-not-supported p {
        color: #6b7280;
        margin-bottom: 20px;
        font-family: 'Open Sans', sans-serif;
    }

    .loading-spinner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        padding: 40px;
        text-align: center;
        background: #f8f9fa;
    }

    .loading-spinner i {
        font-size: 2rem;
        color: #2E7D32;
        margin-bottom: 15px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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
            /* PERBAIKAN: Reset margin-top di tablet */
            margin-top: 0;
        }
        
        .custom-modal-content {
            width: 95%;
            max-width: 95%;
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

        .custom-modal-header {
            padding: 15px 20px;
        }

        .file-preview-container {
            height: 60vh;
        }
        
        .custom-modal-content {
            width: 98%;
            max-width: 98%;
            margin: 10px;
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

        .file-preview-container {
            height: 50vh;
        }
        
        .custom-modal-header {
            padding: 12px 15px;
        }
        
        .custom-modal-title {
            font-size: 1.1rem;
        }
        
        .btn-view, .btn-download {
            width: 100%;
            text-align: center;
        }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="container-main">
    
    <!-- PERBAIKAN: Layout dengan 3 card diturunkan agar sejajar dengan teks -->
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

        <!-- KANAN: 3 Icon Card Terpisah -->
        <div class="ppid-icons-container">
            <a href="{{ route('ppid.berkala') }}" class="ppid-icon-card">
                <img src="{{ asset('img/berkala.png') }}" alt="Informasi Berkala" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDIyQzE3LjUyMjggMjIgMjIgMTcuNTIyOCAyMiAxMkMyMiA2LjQ3NzE1IDE3LjUyMjggMiAxMiAyQzYuNDc3MTUgMiAyIDYuNDc3MTUgMiAxMkMyIDE3LjUyMjggNi40NzcxNSAyMiAxMiAyMloiIGZpbGw9IiMyRTdEMzIiIGZpbGwtb3BhY2l0eT0iMC4xIi8+CjxwYXRoIGQ9Ik0xMiAxNkMxNC4yMDkxIDE2IDE2IDE0LjIwOTEgMTYgMTJDMTYgOS43OTA4NiAxNC4yMDkxIDggMTIgOEM5Ljc5MDg2IDggOCA5Ljc5MDg2IDggMTJDOCAxNC4yMDkxIDkuNzkwODYgMTYgMTIgMTZaIiBmaWxsPSIjMkU3RDMyIi8+CjxwYXRoIGQ9Ik0xMiA3VjEzIiBzdHJva2U9IiMyRTdEMzIiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+CjxwYXRoIGQ9Ik03IDEySDE3IiBzdHJva2U9IiMyRTdEMzIiIHN0cm9rZS13aWR0aD0iIiBzdHJva2UtbGluZWNhcD0icm91bmQiLz4KPC9zdmc+Cg=='">
                <h5>INFORMASI SECARA BERKALA</h5>
            </a>

            <a href="{{ route('ppid.serta') }}" class="ppid-icon-card">
                <img src="{{ asset('img/serta.png') }}" alt="Informasi Serta Merta" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDIyQzE3LjUyMjggMjIgMjIgMTcuNTIyOCAyMiAxMkMyMiA2LjQ3NzE1IDE3LjUyMjggMiAxMiAyQzYuNDc3MTUgMiAyIDYuNDc3MTUgMiAxMkMyIDE3LjUyMjggNi40NzcxNSAyMiAxMiAyMloiIGZpbGw9IiMyRTdEMzIiIGZpbGwtb3BhY2l0eT0iMC4xIi8+CjxwYXRoIGQ9Ik0xMiA2VjEyTDE2IDE0IiBzdHJva2U9IiMyRTdEMzIiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cjwvc3ZnPgo='">
                <h5>INFORMASI SERTA MERTA</h5>
            </a>

            <a href="{{ route('ppid.setiap') }}" class="ppid-icon-card">
                <img src="{{ asset('img/setiap.png') }}" alt="Informasi Setiap Saat" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDIyQzE3LjUyMjggMjIgMjIgMTcuNTIyOCAyIg fill='%232E7D32'/%3E%3C/svg%3E">
                <h5>INFORMASI SETIAP SAAT</h5>
            </a>
        </div>
    </div>

    <!-- PERBAIKAN: Informasi Publik Terbaru dengan null safety -->
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

    {{-- PERBAIKAN UTAMA: Pastikan $ppids selalu ada --}}
    @php
        // Jika $ppids null, buat empty collection
        $ppidsData = $ppids ?? collect();
    @endphp

    @if($ppidsData->isNotEmpty())
        @foreach($ppidsData as $ppid)
        <div class="ppid-item">
            <div class="ppid-item-title">{{ $ppid->judul ?? 'Judul Tidak Tersedia' }}</div>
            <div class="ppid-item-desc">{{ Str::limit($ppid->deskripsi ?? 'Deskripsi tidak tersedia', 200) }}</div>
            <div class="ppid-item-date">
                <i class="bi bi-calendar me-1"></i>
                @if(isset($ppid->tanggal))
                    {{ \Carbon\Carbon::parse($ppid->tanggal)->translatedFormat('l, d F Y') }}
                @else
                    Tanggal tidak tersedia
                @endif
            </div>
            <div class="ppid-actions">
                @if(!empty($ppid->file))
                    <button class="btn-view" onclick="showFileModal('{{ asset('storage/' . $ppid->file) }}', '{{ $ppid->judul ?? 'Berkas' }}')">
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
            <i class="bi bi-info-circle me-2"></i>
            @if($ppids === null)
                <strong>Error:</strong> Data tidak dapat dimuat. Silakan hubungi administrator.
            @else
                Belum ada data PPID yang ditambahkan.
            @endif
        </div>
    @endif
</div>

    <!-- Card Ajukan Permohonan -->
    <div class="permohonan-card">
        <h5 class="ppid-section-title mb-3">
            <i class="bi bi-file-earmark-plus me-2"></i>
            Ingin mengajukan permohonan informasi?
        </h5>
        <p class="ppid-content text-muted mb-4">
            Ajukan permohonan informasi publik melalui sistem PPID Desa Manggalung
        </p>
        <a href="{{ route('permohonan.userStatus') }}" class="btn-primary">
            <i class="bi bi-send me-2"></i> Ajukan Permohonan
        </a>
    </div>
</div>

<!-- Modal dan JavaScript -->
<div id="fileModal" class="custom-modal">
    <div class="custom-modal-content">
        <div class="custom-modal-header">
            <h5 class="custom-modal-title" id="fileModalTitle">Pratinjau Berkas PPID</h5>
            <button type="button" class="custom-close-btn" onclick="closeFileModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="custom-modal-body">
            <div class="file-preview-container">
                <div id="loadingSpinner" class="loading-spinner" style="display: none;">
                    <i class="bi bi-arrow-clockwise"></i>
                    <p>Memuat berkas...</p>
                </div>
                <iframe id="fileFrame" class="file-iframe" src="" style="display: none;"></iframe>
                <div id="fileNotSupported" class="file-not-supported" style="display: none;">
                    <i class="bi bi-file-earmark-x"></i>
                    <h5>Berkas Tidak Dapat Ditampilkan</h5>
                    <p>Format berkas ini tidak dapat ditampilkan dalam pratinjau.</p>
                    <a href="#" id="directDownload" class="btn-primary">
                        <i class="bi bi-download me-2"></i> Unduh Berkas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// PERBAIKAN: Fungsi yang FIX untuk modal custom
function showFileModal(fileUrl, title) {
    console.log('Membuka modal untuk:', fileUrl, title);
    
    const modal = document.getElementById('fileModal');
    const modalTitle = document.getElementById('fileModalTitle');
    const fileFrame = document.getElementById('fileFrame');
    const fileNotSupported = document.getElementById('fileNotSupported');
    const directDownload = document.getElementById('directDownload');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    // Reset semua state
    fileFrame.style.display = 'none';
    fileNotSupported.style.display = 'none';
    loadingSpinner.style.display = 'flex';
    
    // Set judul modal
    modalTitle.textContent = title || 'Pratinjau Berkas PPID';
    
    // Tampilkan modal terlebih dahulu
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
    
    // PERBAIKAN: Pastikan URL file benar
    console.log('File URL:', fileUrl);
    
    // Cek apakah file adalah PDF
    if (fileUrl.toLowerCase().endsWith('.pdf')) {
        // Untuk PDF, gunakan Google Docs Viewer
        const pdfViewerUrl = `https://docs.google.com/gview?url=${encodeURIComponent(fileUrl)}&embedded=true`;
        console.log('PDF Viewer URL:', pdfViewerUrl);
        
        fileFrame.src = pdfViewerUrl;
        fileFrame.onload = function() {
            console.log('PDF berhasil dimuat');
            loadingSpinner.style.display = 'none';
            fileFrame.style.display = 'block';
        };
        fileFrame.onerror = function() {
            console.log('Error memuat PDF');
            loadingSpinner.style.display = 'none';
            showFallback(fileUrl);
        };
    } 
    // Cek format file yang didukung untuk preview
    else if (fileUrl.toLowerCase().match(/\.(jpg|jpeg|png|gif|bmp|webp)$/)) {
        // Untuk gambar, tampilkan langsung
        fileFrame.src = fileUrl;
        fileFrame.onload = function() {
            console.log('Gambar berhasil dimuat');
            loadingSpinner.style.display = 'none';
            fileFrame.style.display = 'block';
        };
        fileFrame.onerror = function() {
            console.log('Error memuat gambar');
            loadingSpinner.style.display = 'none';
            showFallback(fileUrl);
        };
    }
    // Untuk file teks
    else if (fileUrl.toLowerCase().match(/\.(txt|html|htm)$/)) {
        // Untuk teks, gunakan iframe langsung
        fileFrame.src = fileUrl;
        fileFrame.onload = function() {
            console.log('File teks berhasil dimuat');
            loadingSpinner.style.display = 'none';
            fileFrame.style.display = 'block';
        };
        fileFrame.onerror = function() {
            console.log('Error memuat file teks');
            loadingSpinner.style.display = 'none';
            showFallback(fileUrl);
        };
    }
    // Untuk format lain yang tidak didukung
    else {
        console.log('Format file tidak didukung untuk preview');
        loadingSpinner.style.display = 'none';
        showFallback(fileUrl);
    }
}

function showFallback(fileUrl) {
    const fileFrame = document.getElementById('fileFrame');
    const fileNotSupported = document.getElementById('fileNotSupported');
    const directDownload = document.getElementById('directDownload');
    
    fileFrame.style.display = 'none';
    fileNotSupported.style.display = 'flex';
    directDownload.href = fileUrl;
    directDownload.setAttribute('download', '');
    directDownload.onclick = function() {
        console.log('Download file:', fileUrl);
    };
}

function closeFileModal() {
    console.log('Menutup modal');
    
    const modal = document.getElementById('fileModal');
    const fileFrame = document.getElementById('fileFrame');
    const fileNotSupported = document.getElementById('fileNotSupported');
    const loadingSpinner = document.getElementById('loadingSpinner');
    
    // Sembunyikan modal
    modal.classList.remove('show');
    document.body.style.overflow = '';
    
    // Reset semua state
    setTimeout(function() {
        fileFrame.src = '';
        fileFrame.style.display = 'none';
        fileNotSupported.style.display = 'none';
        loadingSpinner.style.display = 'none';
    }, 300);
}

// Event listener untuk klik di luar modal
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('fileModal');
    
    // Tutup modal ketika klik di luar konten
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeFileModal();
        }
    });
    
    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeFileModal();
        }
    });
    
    console.log('Event listeners berhasil dipasang');
});

// Pastikan modal tertutup saat halaman dimuat
window.addEventListener('load', function() {
    closeFileModal();
});
</script>
@endsection