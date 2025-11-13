@extends('layouts.landing.app')

@section('content')
<title>Status Surat Pengantar Online</title>

<style>
    body { 
        background-color: #f8fafc; 
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
        color: #333;
    }
    
    /* Container utama */
    .status-pengaduan-container {
        max-width: 1400px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Card styling dengan shadow yang lebih soft */
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        margin-bottom: 25px;
    }

    .card:hover {
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        transform: translateY(-2px);
    }

    /* Header styling - posisi kiri */
    .header-left {
        text-align: left;
        margin-bottom: 2rem;
    }

    .header-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2E7D32;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .header-subtitle {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 0;
    }

    /* PERBAIKAN: Form styling untuk mobile */
    .form-container {
        padding: 1.5rem;
    }

    .form-control-lg {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control-lg:focus {
        border-color: #2E7D32;
        box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.15);
    }

    .btn-success {
        background: linear-gradient(135deg, #2E7D32, #4CAF50);
        border: none;
        border-radius: 10px;
        padding: 14px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
    }

    /* PERBAIKAN: Tabel responsive dengan scroll horizontal */
    .table-responsive-container {
        border-radius: 10px;
        overflow: hidden;
        margin: 1rem 0;
    }

    .table-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid #dee2e6;
        border-radius: 10px;
    }

    .table {
        margin-bottom: 0;
        min-width: 800px;
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        font-family: 'Open Sans', sans-serif;
    }

    .table thead {
        background: linear-gradient(135deg, #16a34a, #2E7D32);
        position: sticky;
        top: 0;
    }

    .table thead th {
        border: none;
        padding: 16px 12px;
        font-weight: 600;
        color: white;
        font-size: 0.95rem;
        white-space: nowrap;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }

    .table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #f1f3f4;
        font-size: 0.9rem;
        white-space: nowrap;
        text-align: center;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Badge styling */
    .badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-family: 'Open Sans', sans-serif;
        color: white !important;
    }

    .badge-success {
        background: #22c55e;
    }

    .badge-warning {
        background: #f59e0b;
    }

    .badge-danger {
        background: #ef4444;
    }

    .badge-info {
        background: #3b82f6;
    }

    .badge-primary {
        background: #8b5cf6;
    }

    .badge-secondary {
        background: #6b7280;
    }

    /* Status Info Cards */
    .status-cards-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
        margin: 20px 0;
    }

    .status-card {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid #2E7D32;
        flex: 1;
        min-width: 250px;
        max-width: 300px;
        text-align: center;
    }

    .status-info {
        display: flex;
        align-items: center;
        gap: 15px;
        justify-content: center;
    }

    .status-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .status-content {
        flex: 1;
        text-align: center;
    }

    .status-content strong {
        display: block;
        margin-bottom: 5px;
        font-family: 'Poppins', sans-serif;
    }

    .status-content small {
        color: #666;
        font-family: 'Open Sans', sans-serif;
    }

    /* Jenis Surat Cards */
    .jenis-surat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-top: 25px;
    }

    .jenis-surat-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .jenis-surat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .jenis-surat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.5rem;
        color: white;
    }

    .jenis-surat-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #2c3e50;
        font-family: 'Poppins', sans-serif;
    }

    .jenis-surat-desc {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 20px;
        line-height: 1.5;
        flex-grow: 1;
        font-family: 'Open Sans', sans-serif;
    }

    .btn-ajukan {
        background: linear-gradient(135deg, #2E7D32, #4CAF50);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        font-family: 'Poppins', sans-serif;
    }

    .btn-ajukan:hover {
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Loading state */
    #loadingCari, #loadingCariMobile {
        display: none;
    }

    #searchForm.submitting #textCari,
    #searchForm.submitting #textCariMobile {
        display: none;
    }

    #searchForm.submitting #loadingCari,
    #searchForm.submitting #loadingCariMobile {
        display: inline-block;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .status-pengaduan-container {
            margin: 20px auto;
            padding: 0 15px;
        }
        
        .header-title {
            font-size: 2rem;
            text-align: left;
        }
        
        .header-subtitle {
            font-size: 1rem;
            text-align: left;
        }
        
        .header-left {
            text-align: left;
            margin-bottom: 1.5rem;
        }
        
        .form-control-lg {
            font-size: 14px;
            padding: 10px 15px;
            margin-bottom: 1rem;
            width: 100%;
        }
        
        .btn-success {
            padding: 12px 15px;
            font-size: 14px;
            width: 100%;
            margin-top: 0.5rem;
        }
        
        .table thead th,
        .table tbody td {
            padding: 10px 8px;
            font-size: 0.85rem;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 6px 10px;
        }

        /* PERBAIKAN: Form layout untuk mobile */
        .form-row-mobile {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-md-flex {
            display: none !important;
        }

        .status-cards-container {
            flex-direction: column;
            align-items: center;
        }
        
        .status-card {
            width: 100%;
            max-width: 100%;
        }
        
        .jenis-surat-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 769px) {
        /* PERBAIKAN: Desktop layout untuk form */
        .form-row-desktop {
            display: flex;
            gap: 1rem;
            align-items: flex-end;
        }
        
        .form-input-desktop {
            flex: 1;
        }
        
        .form-button-desktop {
            flex: 0 0 auto;
        }
        
        .btn-success {
            width: auto;
        }
        
        .form-row-mobile {
            display: none !important;
        }
    }

    @media (max-width: 576px) {
        .header-title {
            font-size: 1.8rem;
        }
        
        .header-left {
            margin-bottom: 1.5rem;
        }
        
        .status-pengaduan-container {
            padding: 0 10px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 8px 6px;
            font-size: 0.8rem;
        }
        
        .form-container {
            padding: 1rem;
        }
    }

    /* Animation untuk loading */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .fa-spinner {
        animation: spin 1s linear infinite;
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="status-pengaduan-container">

    {{-- === JUDUL - POSISI KIRI === --}}
    <div class="header-left">
        <h2 class="header-title">STATUS SURAT PENGANTAR ONLINE</h2>
        <p class="header-subtitle">Masukkan NIK Anda untuk melihat status pengajuan surat warga Desa Manggalung</p>
    </div>

    {{-- === CARD FORM PENCARIAN === --}}
    <div class="card">
        <div class="card-body form-container">
            <form action="{{ route('status') }}" method="GET" id="searchForm">
                {{-- Desktop Layout --}}
                <div class="form-row-desktop d-md-flex">
                    <div class="form-input-desktop">
                        <label class="form-label fw-semibold mb-2">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control form-control-lg"
                            placeholder="Masukkan 16 digit NIK Anda" 
                            value="{{ request('nik') }}" pattern="[0-9]{16}" 
                            title="Masukkan 16 digit NIK" required>
                        <small class="text-muted mt-1 d-block">
                            <i class="bi bi-info-circle me-1"></i> Masukkan Nomor Induk Kependudukan (NIK) 16 digit
                        </small>
                    </div>
                    <div class="form-button-desktop">
                        <button class="btn btn-success" type="submit" id="btnCari" style="margin-bottom: 1.8rem;">
                            <span id="textCari"><i class="fas fa-search me-2"></i> Cek Status</span>
                            <span id="loadingCari"><i class="fas fa-spinner fa-spin me-2"></i> Memproses...</span>
                        </button>
                    </div>
                </div>
                
                {{-- Mobile Layout --}}
                <div class="form-row-mobile d-md-none">
                    <label class="form-label fw-semibold mb-2">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                    <input type="text" name="nik" class="form-control form-control-lg"
                        placeholder="Masukkan 16 digit NIK Anda" 
                        value="{{ request('nik') }}" pattern="[0-9]{16}" 
                        title="Masukkan 16 digit NIK" required>
                    <small class="text-muted mt-1 d-block">
                        <i class="bi bi-info-circle me-1"></i> Masukkan Nomor Induk Kependudukan (NIK) 16 digit
                    </small>
                    <button class="btn btn-success" type="submit" id="btnCariMobile">
                        <span id="textCariMobile"><i class="fas fa-search me-2"></i> Cek Status</span>
                        <span id="loadingCariMobile"><i class="fas fa-spinner fa-spin me-2"></i> Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- === HASIL PENCARIAN === --}}
    @if(request('nik'))
    <div class="card">
        <div class="card-body form-container">
            <h5 class="mb-4">
                <i class="bi bi-file-text me-2"></i>
                Hasil Pencarian untuk NIK: <strong>{{ request('nik') }}</strong>
            </h5>

            @if($datas && count($datas) > 0)
            <div class="table-responsive-container">
                <div class="table-wrapper">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Jenis Surat</th>
                                <th>Nama Pemohon</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tanggal Pengajuan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $index => $surat)
                                <tr>
                                    <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        @if(isset($surat->nama_usaha))
                                            <span class="badge badge-info">
                                                <i class="bi bi-shop me-1"></i>
                                                Surat Keterangan Usaha
                                            </span>
                                        @elseif(isset($surat->agama))
                                            <span class="badge badge-primary">
                                                <i class="bi bi-person-x me-1"></i>
                                                Surat Keterangan Tidak Mampu
                                            </span>
                                        @elseif(isset($surat->tanggal_kematian))
                                            <span class="badge badge-secondary">
                                                <i class="bi bi-flower1 me-1"></i>
                                                Surat Keterangan Kematian
                                            </span>
                                        @elseif(isset($surat->jenis_acara))
                                            <span class="badge badge-warning">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                Surat Izin Kegiatan
                                            </span>
                                        @else
                                            <span class="badge badge-info">
                                                <i class="bi bi-file-earmark-text me-1"></i>
                                                Surat Administrasi
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="d-block">{{ $surat->nama ?? $surat->nama_pemohon ?? '-' }}</strong>
                                            @if(isset($surat->nama_usaha))
                                                <small class="text-muted">
                                                    <i class="bi bi-shop me-1"></i>Usaha: {{ $surat->nama_usaha }}
                                                </small>
                                            @elseif(isset($surat->jenis_acara))
                                                <small class="text-muted">
                                                    <i class="bi bi-calendar-event me-1"></i>Acara: {{ $surat->jenis_acara }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($surat->status_verifikasi === 'Terverifikasi' || $surat->status === 'Disetujui')
                                            <span class="badge badge-success">
                                                <i class="bi bi-check-circle me-1"></i> Disetujui
                                            </span>
                                        @elseif($surat->status === 'Ditolak')
                                            <span class="badge badge-danger">
                                                <i class="bi bi-x-circle me-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="bi bi-clock me-1"></i> Menunggu Verifikasi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($surat->created_at)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if(($surat->status_verifikasi === 'Terverifikasi' || $surat->status === 'Disetujui'))
                                            @if(isset($surat->nama_usaha))
                                                <a class="btn btn-success btn-sm" href="{{ route('sku.cetak', $surat->id) }}" target="_blank">
                                                    <i class="bi bi-download me-1"></i> Unduh PDF
                                                </a>
                                            @elseif(isset($surat->agama))
                                                <a class="btn btn-success btn-sm" href="{{ route('sktm.cetak', $surat->id) }}" target="_blank">
                                                    <i class="bi bi-download me-1"></i> Unduh PDF
                                                </a>
                                            @elseif(isset($surat->tanggal_kematian))
                                                <a class="btn btn-success btn-sm" href="{{ route('kematian.cetak', $surat->id) }}" target="_blank">
                                                    <i class="bi bi-download me-1"></i> Unduh PDF
                                                </a>
                                            @elseif(isset($surat->jenis_acara))
                                                <a class="btn btn-success btn-sm" href="{{ route('izin.cetak', $surat->id) }}" target="_blank">
                                                    <i class="bi bi-download me-1"></i> Unduh PDF
                                                </a>
                                            @endif
                                        @elseif($surat->status === 'Ditolak')
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                <i class="bi bi-ban me-1"></i> Ditolak
                                            </button>
                                        @else
                                            <button class="btn btn-warning btn-sm" disabled>
                                                <i class="bi bi-clock me-1"></i> Diproses
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- Indikator bahwa tabel bisa di-scroll di mobile --}}
            <div class="d-md-none text-center mt-2">
                <small class="text-muted">
                    <i class="fas fa-arrows-left-right me-1"></i>
                    Geser tabel untuk melihat lebih banyak kolom
                </small>
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-search fa-3x text-muted mb-3"></i>
                <h5 class="text-muted mb-3">Tidak ada data surat ditemukan</h5>
                <p class="text-muted mb-4">Tidak ada pengajuan surat untuk NIK <strong>{{ request('nik') }}</strong></p>
                
                <!-- Tampilkan semua jenis surat yang tersedia -->
                <div class="jenis-surat-grid">
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Keterangan Usaha (SKU)</div>
                        <div class="jenis-surat-desc">Untuk keperluan administrasi usaha dan bisnis</div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                    
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                            <i class="bi bi-person-x"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Keterangan Tidak Mampu (SKTM)</div>
                        <div class="jenis-surat-desc">Untuk keperluan bantuan sosial dan pendidikan</div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                    
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                            <i class="bi bi-flower1"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Keterangan Kematian</div>
                        <div class="jenis-surat-desc">Untuk keperluan administrasi kematian</div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                    
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Izin Kegiatan</div>
                        <div class="jenis-surat-desc">Untuk keperluan izin kegiatan/event</div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @else
    <!-- Informasi Sebelum Pencarian -->
    <div class="card">
        <div class="card-body text-center py-4">
            <i class="bi bi-file-earmark-text fa-4x text-success mb-4"></i>
            <h4 class="text-success mb-3">Cek Status Pengajuan Surat Anda</h4>
            <p class="text-muted mb-4 fs-5">
                Masukkan NIK Anda di form pencarian di atas untuk melihat status pengajuan surat.<br>
                Anda dapat mengunduh surat yang sudah disetujui langsung dari halaman ini.
            </p>
            
            <!-- Status cards layout baru yang center -->
            <div class="status-cards-container">
                <div class="status-card">
                    <div class="status-info">
                        <div class="status-icon" style="background: #22c55e;">
                            <i class="bi bi-check"></i>
                        </div>
                        <div class="status-content">
                            <strong>Surat Disetujui</strong>
                            <small>Dapat mengunduh file PDF</small>
                        </div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-info">
                        <div class="status-icon" style="background: #f59e0b;">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="status-content">
                            <strong>Menunggu Verifikasi</strong>
                            <small>Sedang diproses oleh admin</small>
                        </div>
                    </div>
                </div>
                <div class="status-card">
                    <div class="status-info">
                        <div class="status-icon" style="background: #ef4444;">
                            <i class="bi bi-x"></i>
                        </div>
                        <div class="status-content">
                            <strong>Surat Ditolak</strong>
                            <small>Pengajuan tidak disetujui</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semua Jenis Surat yang Tersedia -->
            <div class="mt-5">
                <h5 class="mb-4 text-center">Jenis Surat yang Tersedia</h5>
                <div class="jenis-surat-grid">
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                            <i class="bi bi-shop"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Keterangan Usaha (SKU)</div>
                        <div class="jenis-surat-desc">
                            Untuk keperluan administrasi usaha, perizinan bisnis, pengajuan kredit, dan legalitas usaha lainnya.
                        </div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                    
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
                            <i class="bi bi-person-x"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Keterangan Tidak Mampu (SKTM)</div>
                        <div class="jenis-surat-desc">
                            Untuk keperluan bantuan sosial, pendidikan, kesehatan, dan program pemerintah bagi keluarga kurang mampu.
                        </div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                    
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                            <i class="bi bi-flower1"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Keterangan Kematian</div>
                        <div class="jenis-surat-desc">
                            Untuk keperluan administrasi kematian, pengurusan warisan, asuransi, dan pencatatan sipil.
                        </div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                    
                    <div class="jenis-surat-card">
                        <div class="jenis-surat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="jenis-surat-title">Surat Izin Kegiatan</div>
                        <div class="jenis-surat-desc">
                            Untuk keperluan izin kegiatan/event, perayaan, pertemuan, dan acara kemasyarakatan lainnya.
                        </div>
                        <a href="{{ route('pengantar') }}" class="btn-ajukan">
                            <i class="bi bi-plus-circle me-1"></i> Ajukan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- === SCRIPT LOADING TOMBOL === --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const btnCari = document.getElementById('btnCari');
    const btnCariMobile = document.getElementById('btnCariMobile');
    const textCari = document.getElementById('textCari');
    const textCariMobile = document.getElementById('textCariMobile');
    const loadingCari = document.getElementById('loadingCari');
    const loadingCariMobile = document.getElementById('loadingCariMobile');
    
    // Sembunyikan loading state awal
    loadingCari.style.display = 'none';
    loadingCariMobile.style.display = 'none';
    
    function handleFormSubmit(e) {
        // Validasi form
        const nikInput = document.querySelector('input[name="nik"]');
        if (!nikInput.value.trim()) {
            e.preventDefault();
            nikInput.focus();
            return;
        }
        
        // Validasi NIK harus 16 digit
        if (nikInput.value.length !== 16 || !/^\d+$/.test(nikInput.value)) {
            e.preventDefault();
            alert('NIK harus terdiri dari 16 digit angka');
            nikInput.focus();
            return;
        }
        
        // Tampilkan loading state
        if (window.innerWidth >= 768) {
            // Desktop
            btnCari.disabled = true;
            textCari.style.display = 'none';
            loadingCari.style.display = 'inline-block';
        } else {
            // Mobile
            btnCariMobile.disabled = true;
            textCariMobile.style.display = 'none';
            loadingCariMobile.style.display = 'inline-block';
        }
        searchForm.classList.add('submitting');
    }
    
    if (btnCari) {
        btnCari.addEventListener('click', handleFormSubmit);
    }
    
    if (btnCariMobile) {
        btnCariMobile.addEventListener('click', handleFormSubmit);
    }
    
    // Reset loading state jika form di-reset
    searchForm.addEventListener('reset', function() {
        btnCari.disabled = false;
        btnCariMobile.disabled = false;
        textCari.style.display = 'inline-block';
        textCariMobile.style.display = 'inline-block';
        loadingCari.style.display = 'none';
        loadingCariMobile.style.display = 'none';
        searchForm.classList.remove('submitting');
    });
});

// Auto focus pada input NIK jika ada error atau pertama kali load
document.addEventListener('DOMContentLoaded', function() {
    const nikInput = document.querySelector('input[name="nik"]');
    if (nikInput && !nikInput.value) {
        nikInput.focus();
    }
});
</script>
@endsection