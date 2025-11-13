@extends('layouts.landing.app')

@section('content')
<title>Formulir Buku Tamu Desa Manggalung</title>

<style>
    body { 
        background-color: #f8fafc; 
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
        color: #333;
    }
    
    /* Header Section */
    .container-main { 
        max-width: 1600px;
        margin: auto; 
        padding: 30px;
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

    /* Card Style */
    .card { 
        background: #fff; 
        border-radius: 14px; 
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06); 
        transition: .25s; 
        border: none;
        margin-bottom: 30px;
    }

    .card:hover { 
        transform: translateY(-3px); 
        box-shadow: 0 12px 28px rgba(0,0,0,0.12); 
    }

    /* Form Styles */
    .form-group { 
        margin-bottom: 25px; 
        text-align: left;
    }
    
    label { 
        font-weight: 600; 
        margin-bottom: 10px; 
        display: block; 
        color: #2c3e50; 
        font-size: 15px;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }
    
    input, textarea, select { 
        width: 100%; 
        padding: 14px 16px; 
        border: 2px solid #e2e8f0; 
        border-radius: 8px; 
        font-size: 15px; 
        transition: all 0.3s ease;
        background: #f8fafc;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
    }
    
    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #2E7D32;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        background: #fff;
    }
    
    textarea {
        resize: vertical;
        min-height: 100px;
    }
    
    /* Tombol Simpan */
    .btn-submit { 
        background: linear-gradient(135deg, #2E7D32, #4CAF50); 
        color: #fff; 
        border: none; 
        padding: 10px 20px;
        border-radius: 8px; 
        font-size: 14px;
        cursor: pointer; 
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-submit:hover { 
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
    }

    .btn-export {
        background: linear-gradient(135deg, #1B5E20, #388E3C);
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
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-export:hover {
        background: linear-gradient(135deg, #1B5E20, #1B5E20);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }

    /* Dropdown Styles */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #fff;
        min-width: 200px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        border-radius: 8px;
        z-index: 1;
        margin-top: 8px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .dropdown-content a {
        color: #333;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
        font-family: 'Open Sans', sans-serif;
    }

    .dropdown-content a:last-child {
        border-bottom: none;
    }

    .dropdown-content a:hover {
        background-color: #f8fafc;
        color: #2E7D32;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .btn-export {
        background: linear-gradient(135deg, #1B5E20, #1B5E20);
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
        margin-top: 18px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }
    
    .data-table { 
        width: 100%; 
        border-collapse: collapse;
        font-size: 14px; 
        font-family: 'Open Sans', sans-serif;
        min-width: 1000px;
    }

    /* Garis untuk setiap sel */
    .data-table th, .data-table td { 
        padding: 12px 10px; 
        text-align: left; 
        border: 1px solid #e5e7eb;
        vertical-align: top;
    }

    .data-table thead { 
        background: linear-gradient(90deg, #16a34a, #16a34a); 
        color: #fff; 
        font-weight: 600; 
        font-family: 'Poppins', sans-serif; 
    }

    .data-table th {
        text-align: center;
        padding: 14px 10px;
        font-size: 14px;
        border-bottom: 2px solid #e5e7eb;
    }

    .data-table td {
        padding: 12px 10px;
        font-size: 13px;
    }

    /* Lebar kolom dengan garis */
    .data-table th:nth-child(1), .data-table td:nth-child(1) { 
        width: 70px; 
        text-align: center;
        border-left: 1px solid #e5e7eb;
    }
    .data-table th:nth-child(2), .data-table td:nth-child(2) { 
        width: 160px; 
        text-align: center;
    }
    .data-table th:nth-child(3), .data-table td:nth-child(3) { 
        width: 180px; 
    }
    .data-table th:nth-child(4), .data-table td:nth-child(4) { 
        width: 180px; 
    }
    .data-table th:nth-child(5), .data-table td:nth-child(5) { 
        width: 160px; 
    }
    .data-table th:nth-child(6), .data-table td:nth-child(6) { 
        min-width: 250px; 
        white-space: normal; 
    }
    .data-table th:nth-child(7), .data-table td:nth-child(7) { 
        width: 140px; 
        text-align: center;
        border-right: 1px solid #e5e7eb;
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
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left: 4px solid #28a745;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }

    /* Row dan Column Layout */
    .form-row {
        display: flex;
        gap: 25px;
        margin-bottom: 20px;
    }
    
    .form-col {
        flex: 1;
    }

    /* Header Table Container */
    .table-header-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .table-title-section {
        flex: 1;
        min-width: 250px;
    }

    .table-export-section {
        flex: 0 0 auto;
    }

    /* TTD Section */
    .ttd-section {
        border-top: 2px dashed #e2e8f0;
        padding-top: 25px;
        margin-top: 25px;
    }

    .ttd-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 25px;
        max-width: 800px;
    }

    .ttd-field {
        flex: 1;
        position: relative;
    }

    .ttd-input-area {
        position: relative;
        margin-bottom: 10px;
    }

    .ttd-placeholder {
        height: 120px;
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        cursor: crosshair;
    }

    /* Container untuk label dan tombol hapus */
    .ttd-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .ttd-label {
        font-weight: 600;
        color: #2c3e50;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        margin: 0;
    }

    /* Tombol hapus TTD di kanan sejajar dengan label */
    .ttd-clear-btn {
        background: #dc3545;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        line-height: 1;
    }

    .ttd-clear-btn:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .ttd-instruction {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
        font-family: 'Open Sans', sans-serif;
        text-align: left;
    }

    /* TTD Preview di Tabel */
    .ttd-preview {
        width: 60px;
        height: 30px;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin: 0 auto;
    }
    
    .ttd-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* Modal TTD */
    .ttd-modal .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .ttd-modal .modal-header {
        background: linear-gradient(135deg, #2E7D32, #4CAF50);
        color: white;
        border-bottom: none;
        padding: 15px 20px;
        position: relative;
    }
    
    .ttd-modal .modal-header .modal-title {
        font-size: 18px;
        font-weight: 600;
    }
    
    /* Tombol close (X) */
    .ttd-modal .modal-header .btn-close {
        filter: invert(1);
        opacity: 0.9;
        background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
        border: none;
        padding: 8px;
        margin: 0;
    }
    
    .ttd-modal .modal-header .btn-close:hover {
        opacity: 1;
        background-color: rgba(255,255,255,0.1);
    }
    
    .ttd-modal .modal-body {
        text-align: center;
        padding: 25px;
    }
    
    .ttd-modal .modal-footer {
        border-top: 1px solid #e5e7eb;
        justify-content: center;
        padding: 15px 20px;
        gap: 10px;
    }
    
    /* Tombol tutup modal */
    .ttd-modal .modal-footer .btn {
        padding: 8px 20px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        transition: all 0.2s ease;
        min-width: 80px;
        cursor: pointer;
    }
    
    .ttd-modal .modal-footer .btn-secondary {
        background: #6c757d;
        color: white;
    }
    
    .ttd-modal .modal-footer .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }

    /* Pagination */
    .pagination-info {
        font-family: 'Open Sans', sans-serif;
        color: #666;
        font-size: 14px;
    }

    .pagination {
        font-family: 'Open Sans', sans-serif;
    }
    
    @media (max-width: 1200px) {
        .container-main {
            max-width: 95%;
            padding: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .container-main {
            padding: 15px;
        }
        
        .card {
            padding: 20px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .table-header-container {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        
        .table-title-section {
            min-width: 100%;
            order: 1;
        }
        
        .table-export-section {
            order: 2;
            text-align: left !important;
        }
        
        .ttd-container {
            max-width: 100%;
            gap: 15px;
        }
        
        .ttd-placeholder {
            height: 100px;
        }
        
        .ttd-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .ttd-clear-btn {
            align-self: flex-end;
        }
        
        .gallery-title {
            font-size: 2.2rem;
        }
        
        .data-table {
            font-size: 12px;
            min-width: 800px;
        }
        
        .data-table th, .data-table td {
            padding: 10px 8px;
        }
        
        .btn-submit, .btn-export {
            width: 100%;
            justify-content: center;
        }
        
        .dropdown-content {
            min-width: 180px;
            right: 0;
            left: auto;
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
            padding: 10px;
        }
        
        .card {
            padding: 15px;
        }
        
        .table-header-container {
            gap: 12px;
        }
        
        .btn-submit, .btn-export {
            width: 100%;
        }
        
        .data-table {
            min-width: 700px;
            font-size: 11px;
        }
        
        .ttd-preview {
            width: 50px;
            height: 25px;
        }
        
        .dropdown-content {
            min-width: 160px;
        }
        
        /* Perbaikan khusus untuk tampilan mobile yang sangat kecil */
        @media (max-width: 400px) {
            .table-title-section h5 {
                font-size: 1.1rem;
            }
            
            .btn-export {
                padding: 10px 16px;
                font-size: 13px;
            }
            
            .dropdown-content {
                min-width: 140px;
            }
        }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="container-main">
    <!-- Judul Halaman -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            FORMULIR BUKU TAMU
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Data kunjungan tamu dan pengunjung Desa Manggalung
        </p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form Input -->
    <div class="card">
        <div class="form-group">
            <h5 class="form-section-title" style="color: #2E7D32; font-weight: 600; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">
                <i class="bi bi-person-plus me-2"></i>
                Form Input Data Tamu
            </h5>
        </div>

        <form action="{{ route('bukutamu') }}" method="POST" id="bukutamuForm">
            @csrf
            
            <!-- Data Pribadi -->
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label>Jabatan / Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan" placeholder="Contoh: Staff Dinas, Mahasiswa, Wiraswasta, dll" value="{{ old('jabatan') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label>Asal Instansi / Tempat <span class="text-danger">*</span></label>
                        <input type="text" name="asal" placeholder="Contoh: Dinas Kominfo, Universitas, Perusahaan, dll" value="{{ old('asal') }}" required>
                    </div>
                </div>
                <div class="form-col">
                    <!-- PERBAIKAN: Tambahkan input tanggal -->
                    <div class="form-group">
                        <label>Tanggal Kunjungan <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="waktu_kunjungan" value="{{ old('waktu_kunjungan') ? old('waktu_kunjungan') : date('Y-m-d\TH:i') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Keperluan <span class="text-danger">*</span></label>
                <textarea name="keperluan" placeholder="Tuliskan keperluan kunjungan Anda secara detail" rows="4" required>{{ old('keperluan') }}</textarea>
            </div>

            <!-- Section TTD -->
            <div class="ttd-section">
                <div class="form-group">
                    <h6 style="color: #2E7D32; font-weight: 600; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">
                        <i class="bi bi-pen me-2"></i>
                        Tanda Tangan Digital
                    </h6>
                </div>
                
                <div class="ttd-container">
                    <div class="ttd-field">
                        <div class="ttd-input-area">
                            <div class="ttd-placeholder" id="ttdPlaceholder">
                                <span style="color: #666; font-style: italic;">Klik dan tarik untuk membuat tanda tangan</span>
                            </div>
                        </div>
                        
                        <!-- Header dengan label dan tombol hapus sejajar -->
                        <div class="ttd-header">
                            <div class="ttd-label">Tanda Tangan Pengunjung</div>
                            <button type="button" class="ttd-clear-btn" onclick="clearSignature()">
                                <i class="bi bi-eraser"></i> Hapus TTD
                            </button>
                        </div>
                        
                        <div class="ttd-instruction">Gambar tanda tangan Anda di area di atas</div>
                        <input type="hidden" name="ttd_data" id="ttdData">
                    </div>
                </div>
            </div>

            <div class="form-group" style="text-align: right; margin-top: 30px;">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-save"></i> Simpan Data Tamu
                </button>
            </div>
        </form>
    </div>

    <!-- Card Tabel Data -->
    <div class="card">
        <!-- Header Tabel yang Diperbaiki -->
        <div class="table-header-container">
            <div class="table-title-section">
                <h5 class="form-section-title" style="color: #2E7D32; font-weight: 600; margin-bottom: 5px; font-family: 'Poppins', sans-serif;">
                    <i class="bi bi-table me-2"></i>
                    Data Pengunjung
                </h5>
            </div>
            <div class="table-export-section">
                <!-- Dropdown untuk download -->
                <div class="dropdown">
                    <button class="btn-export">
                        <i class="bi bi-download me-2"></i> Download Data
                        <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#" onclick="downloadExcel()">
                            <i class="bi bi-file-earmark-excel me-2"></i> Download Excel
                        </a>
                        <a href="#" onclick="downloadPDF()">
                            <i class="bi bi-file-earmark-pdf me-2"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Nama</th>
                        <th>Asal Instansi</th>
                        <th>Jabatan</th>
                        <th>Keperluan</th>
                        <th>Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukutamus as $index => $tamu)
                        <tr>
                            <td>{{ ($bukutamus->currentPage() - 1) * $bukutamus->perPage() + $index + 1 }}</td>
                            <td>
                                <small>
                                    {{ $tamu->waktu_kunjungan ? \Carbon\Carbon::parse($tamu->waktu_kunjungan)->format('d/m/Y') : $tamu->created_at->setTimezone('Asia/Makassar')->format('d/m/Y') }}
                                    <br>
                                    <span style="color: #666; font-size: 11px;">
                                        {{ $tamu->waktu_kunjungan ? \Carbon\Carbon::parse($tamu->waktu_kunjungan)->format('H:i') : $tamu->created_at->setTimezone('Asia/Makassar')->format('H:i') }} WITA
                                    </span>
                                </small>
                            </td>
                            <td><strong>{{ $tamu->nama }}</strong></td>
                            <td>{{ $tamu->asal }}</td>
                            <td>{{ $tamu->jabatan ? $tamu->jabatan : '-' }}</td>
                            <td>
                                <span title="{{ $tamu->keperluan }}">
                                    {{ Str::limit($tamu->keperluan, 60) }}
                                </span>
                            </td>
                            <td>
                                @if($tamu->tanda_tangan)
                                    <div class="ttd-preview" onclick="showSignature('{{ $tamu->tanda_tangan }}', '{{ $tamu->nama }}')">
                                        <img src="{{ $tamu->tanda_tangan }}" alt="TTD {{ $tamu->nama }}">
                                    </div>
                                    <small class="text-success d-block mt-1" style="font-size: 11px;">
                                        <i class="bi bi-check-circle"></i> TTD
                                    </small>
                                @else
                                    <span class="text-muted" style="font-size: 12px;">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                Belum ada data pengunjung
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bukutamus->count() > 0)
            <div class="form-row" style="align-items: center; margin-top: 20px;">
                <div class="form-col">
                    <small class="pagination-info">
                        Menampilkan {{ $bukutamus->count() }} dari {{ $bukutamus->total() }} data pengunjung
                    </small>
                </div>
                <div class="form-col" style="flex: 0 0 auto; text-align: right;">
                    {{ $bukutamus->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal untuk menampilkan TTD -->
<div class="modal fade ttd-modal" id="ttdModal" tabindex="-1" aria-labelledby="ttdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ttdModalLabel">Tanda Tangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <img id="ttdModalImage" src="" alt="Tanda Tangan" style="max-width: 100%; border: 1px solid #e2e8f0; border-radius: 4px;">
                <p id="ttdModalName" class="mt-3 mb-0 fw-bold text-dark"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Signature Pad Library -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Initialize Signature Pad
let signaturePad = null;
let ttdModal = null;

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Initializing components...');
    
    // Initialize Signature Pad
    const canvas = document.createElement('canvas');
    const ttdPlaceholder = document.getElementById('ttdPlaceholder');

    canvas.width = ttdPlaceholder.offsetWidth;
    canvas.height = ttdPlaceholder.offsetHeight;
    canvas.style.border = 'none';
    canvas.style.borderRadius = '6px';
    canvas.style.backgroundColor = '#f8fafc';
    canvas.style.cursor = 'crosshair';

    ttdPlaceholder.innerHTML = '';
    ttdPlaceholder.appendChild(canvas);

    signaturePad = new SignaturePad(canvas, {
        backgroundColor: '#f8fafc',
        penColor: '#2E7D32',
        minWidth: 1,
        maxWidth: 2
    });

    // Inisialisasi modal dengan benar
    const modalElement = document.getElementById('ttdModal');
    if (modalElement) {
        ttdModal = new bootstrap.Modal(modalElement);
        console.log('Modal initialized successfully');
    } else {
        console.error('Modal element not found');
    }

    // Handle form submission
    document.getElementById('bukutamuForm').addEventListener('submit', function(e) {
        if (signaturePad.isEmpty()) {
            if (!confirm('Anda belum memberikan tanda tangan. Lanjutkan tanpa tanda tangan?')) {
                e.preventDefault();
                return;
            }
        } else {
            // Convert signature to data URL
            const ttdData = signaturePad.toDataURL();
            document.getElementById('ttdData').value = ttdData;
        }
    });

    // Tambah event listener untuk tombol close manual
    const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            closeModal();
        });
    });
});

// Fungsi untuk menampilkan TTD di modal
function showSignature(ttdData, nama) {
    console.log('Showing signature modal');
    document.getElementById('ttdModalImage').src = ttdData;
    document.getElementById('ttdModalName').textContent = 'Tanda Tangan: ' + nama;
    
    if (ttdModal) {
        ttdModal.show();
    } else {
        console.error('Modal not initialized');
        // Fallback: show modal manually
        const modalElement = document.getElementById('ttdModal');
        if (modalElement) {
            modalElement.classList.add('show');
            modalElement.style.display = 'block';
            modalElement.style.background = 'rgba(0,0,0,0.5)';
        }
    }
}

// Fungsi untuk menutup modal dengan beberapa cara
function closeModal() {
    console.log('Closing modal');
    
    // Cara 1: Gunakan Bootstrap modal method
    if (ttdModal) {
        ttdModal.hide();
        return;
    }
    
    // Cara 2: Manual hide modal
    const modalElement = document.getElementById('ttdModal');
    if (modalElement) {
        modalElement.classList.remove('show');
        modalElement.style.display = 'none';
        document.body.classList.remove('modal-open');
        
        // Hapus backdrop
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => {
            backdrop.remove();
        });
    }
}

function clearSignature() {
    if (signaturePad) {
        signaturePad.clear();
    }
}

function downloadExcel() {
    const table = document.querySelector('.data-table');
    const rows = table.querySelectorAll('tbody tr');
    
    if(rows.length === 0 || (rows[0].querySelector('td') && rows[0].querySelector('td').colSpan > 1)) {
        alert('Tidak ada data untuk diekspor!');
        return;
    }
    
    if (!confirm('Apakah Anda yakin ingin mengekspor data buku tamu ke Excel?')) return;

    const wb = XLSX.utils.book_new();
    const excelData = [
        ["DATA BUKU TAMU DESA MANGGAUNG"],
        ["Tanggal Ekspor: " + new Date().toLocaleDateString('id-ID', { timeZone: 'Asia/Makassar' })],
        ["Waktu Ekspor: " + new Date().toLocaleTimeString('id-ID', { timeZone: 'Asia/Makassar' }) + " WITA"],
        ["Zona Waktu: Asia/Makassar (WITA)"],
        [""],
        ["No", "Tanggal Kunjungan", "Nama", "Asal Instansi", "Jabatan/Pekerjaan", "Keperluan", "Tanda Tangan"]
    ];

    @foreach($bukutamus as $index => $tamu)
    excelData.push([
        {{ $index + 1 }},
        "{{ $tamu->waktu_kunjungan ? \Carbon\Carbon::parse($tamu->waktu_kunjungan)->format('d/m/Y H:i') . ' WITA' : $tamu->created_at->setTimezone('Asia/Makassar')->format('d/m/Y H:i') . ' WITA' }}",
        "{{ $tamu->nama }}",
        "{{ $tamu->asal }}",
        "{{ $tamu->jabatan ?? '-' }}",
        "{{ $tamu->keperluan }}",
        "{{ $tamu->tanda_tangan ? 'Ya' : 'Tidak' }}"
    ]);
    @endforeach

    const ws = XLSX.utils.aoa_to_sheet(excelData);
    ws['!cols'] = [
        {wch: 6}, 
        {wch: 20}, 
        {wch: 25}, 
        {wch: 25}, 
        {wch: 20}, 
        {wch: 50}, 
        {wch: 12}
    ];
    XLSX.utils.book_append_sheet(wb, ws, "Buku Tamu");
    XLSX.writeFile(wb, `Buku_Tamu_Desa_Manggalung_${new Date().toISOString().split('T')[0]}.xlsx`);
}

function downloadPDF() {
    const table = document.querySelector('.data-table');
    const rows = table.querySelectorAll('tbody tr');
    
    if(rows.length === 0 || (rows[0].querySelector('td') && rows[0].querySelector('td').colSpan > 1)) {
        alert('Tidak ada data untuk diekspor!');
        return;
    }
    
    if (!confirm('Apakah Anda yakin ingin mengekspor data buku tamu ke PDF?')) return;

    // Menggunakan jsPDF
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape');
    
    // Judul
    doc.setFontSize(16);
    doc.setFont('helvetica', 'bold');
    doc.text('DATA BUKU TAMU DESA MANGGAUNG', 15, 15);
    
    // Informasi ekspor
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.text(`Tanggal Ekspor: ${new Date().toLocaleDateString('id-ID', { timeZone: 'Asia/Makassar' })}`, 15, 22);
    doc.text(`Waktu Ekspor: ${new Date().toLocaleTimeString('id-ID', { timeZone: 'Asia/Makassar' })} WITA`, 15, 27);
    doc.text('Zona Waktu: Asia/Makassar (WITA)', 15, 32);
    
    // Data tabel
    const tableData = [];
    
    // Header tabel
    tableData.push([
        'No', 
        'Tanggal Kunjungan', 
        'Nama', 
        'Asal Instansi', 
        'Jabatan', 
        'Keperluan', 
        'Tanda Tangan'
    ]);
    
    // Isi tabel
    @foreach($bukutamus as $index => $tamu)
    tableData.push([
        '{{ $index + 1 }}',
        '{{ $tamu->waktu_kunjungan ? \Carbon\Carbon::parse($tamu->waktu_kunjungan)->format('d/m/Y H:i') . ' WITA' : $tamu->created_at->setTimezone('Asia/Makassar')->format('d/m/Y H:i') . ' WITA' }}',
        '{{ $tamu->nama }}',
        '{{ $tamu->asal }}',
        '{{ $tamu->jabatan ?? '-' }}',
        '{{ Str::limit($tamu->keperluan, 40) }}',
        '{{ $tamu->tanda_tangan ? 'Ya' : 'Tidak' }}'
    ]);
    @endforeach
    
    // Generate tabel
    doc.autoTable({
        startY: 40,
        head: [tableData[0]],
        body: tableData.slice(1),
        theme: 'grid',
        styles: {
            fontSize: 8,
            cellPadding: 3,
            overflow: 'linebreak'
        },
        headStyles: {
            fillColor: [22, 163, 74],
            textColor: 255,
            fontStyle: 'bold'
        },
        columnStyles: {
            0: { cellWidth: 10 },
            1: { cellWidth: 25 },
            2: { cellWidth: 30 },
            3: { cellWidth: 30 },
            4: { cellWidth: 25 },
            5: { cellWidth: 50 },
            6: { cellWidth: 20 }
        },
        margin: { top: 40 }
    });
    
    // Simpan PDF
    doc.save(`Buku_Tamu_Desa_Manggalung_${new Date().toISOString().split('T')[0]}.pdf`);
}
</script>
@endsection