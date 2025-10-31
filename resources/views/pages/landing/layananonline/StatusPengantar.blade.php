@extends('layouts.landing.app')

@section('content')
<title>Status Surat Pengantar Online</title>

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
    
    input, select { 
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
    
    input:focus, select:focus {
        outline: none;
        border-color: #2E7D32;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        background: #fff;
    }
    
    .btn-submit { 
        background: linear-gradient(135deg, #2E7D32, #4CAF50); 
        color: #fff; 
        border: none; 
        padding: 16px 30px; 
        border-radius: 8px; 
        font-size: 16px; 
        cursor: pointer; 
        width: 100%; 
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 10px;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }
    
    .btn-submit:hover { 
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
    }

    /* Table Styles */
    .table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 18px; 
        font-size: 15px; 
        font-family: 'Open Sans', sans-serif; 
    }

    .table th, .table td { 
        padding: 12px; 
        text-align: center; 
        border-bottom: 1px solid #f8fafc; 
    }

    .table thead { 
        background: linear-gradient(90deg, #16a34a, #16a34a); 
        color: #f8fafc; 
        font-weight: 600; 
        font-family: 'Poppins', sans-serif; 
    }

    .badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-family: 'Open Sans', sans-serif;
    }

    .badge-success {
        background: #22c55e;
        color: white;
    }

    .badge-warning {
        background: #f59e0b;
        color: white;
    }

    .badge-danger {
        background: #ef4444;
        color: white;
    }

    .badge-info {
        background: #3b82f6;
        color: white;
    }

    .badge-primary {
        background: #8b5cf6;
        color: white;
    }

    /* Row dan Column Layout - DIPERBAIKI */
    .form-row {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: flex-end;
    }
    
    .form-col {
        flex: 1;
    }
    
    /* Kolom untuk input NIK lebih lebar, tombol lebih kecil */
    .form-col-input {
        flex: 3; /* Lebih lebar untuk input */
    }
    
    .form-col-button {
        flex: 1; /* Lebih kecil untuk tombol */
        max-width: 180px; /* Batas maksimal lebar tombol */
    }

    /* Status Info Cards */
    .status-card {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid #2E7D32;
    }

    .status-info {
        display: flex;
        align-items: center;
        gap: 15px;
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
    }

    .status-content {
        flex: 1;
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
    
    @media (max-width: 768px) {
        .card {
            padding: 20px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 15px;
        }
        
        .form-col-button {
            max-width: 100%; /* Tombol penuh lebar di mobile */
        }
        
        .gallery-title {
            font-size: 2.2rem;
        }
        
        .table {
            font-size: 14px;
        }
        
        .table th, .table td {
            padding: 8px;
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
        
        .card {
            padding: 15px;
        }
        
        .status-info {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

<div class="container-main">
    <!-- Judul Halaman - Mengikuti gaya dari halaman jumlah penduduk -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            STATUS SURAT PENGANTAR ONLINE
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Masukkan NIK Anda untuk melihat status pengajuan surat warga Desa Manggalung
        </p>
    </div>

    <!-- Card Pencarian - DIPERBAIKI LAYOUTNYA -->
    <div class="card">
        <form action="{{ route('status') }}" method="GET" id="searchForm">
            <div class="form-group">
                <label>Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                <div class="form-row">
                    <div class="form-col form-col-input">
                        <input type="text" name="nik" placeholder="Masukkan 16 digit NIK Anda" 
                               value="{{ request('nik') }}" pattern="[0-9]{16}" 
                               title="Masukkan 16 digit NIK" required>
                    </div>
                    <div class="form-col form-col-button">
                        <button class="btn-submit" type="submit" id="btnCari">
                            <i class="bi bi-search me-2"></i> Cek Status
                        </button>
                    </div>
                </div>
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i> Masukkan Nomor Induk Kependudukan (NIK) 16 digit
                </small>
            </div>
        </form>
    </div>

    <!-- Hasil Pencarian -->
    @if(request('nik'))
    <div class="card">
        <div class="form-group">
            <h5 class="form-section-title">
                <i class="bi bi-file-text me-2"></i>
                Hasil Pencarian untuk NIK: <strong>{{ request('nik') }}</strong>
            </h5>
        </div>

        @if($datas && count($datas) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Surat</th>
                        <th>Nama Pemohon</th>
                        <th>Status</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $index => $surat)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td>
                                @if(isset($surat->nama_usaha))
                                    <span class="badge badge-info">
                                        <i class="bi bi-shop me-1"></i>
                                        Surat Keterangan Usaha
                                    </span>
                                @else
                                    <span class="badge badge-primary">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Surat Keterangan Tidak Mampu
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
                                    @endif
                                </div>
                            </td>
                            <td>
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
                            <td>
                                {{ \Carbon\Carbon::parse($surat->created_at)->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                @if(($surat->status_verifikasi === 'Terverifikasi' || $surat->status === 'Disetujui'))
                                    @if(isset($surat->nama_usaha))
                                        <a class="btn-submit" href="{{ route('sku.cetak', $surat->id) }}" target="_blank" style="padding: 8px 16px; font-size: 14px;">
                                            <i class="bi bi-download me-1"></i> Unduh PDF
                                        </a>
                                    @else
                                        <a class="btn-submit" href="{{ route('sktm.cetak', $surat->id) }}" target="_blank" style="padding: 8px 16px; font-size: 14px;">
                                            <i class="bi bi-download me-1"></i> Unduh PDF
                                        </a>
                                    @endif
                                @elseif($surat->status === 'Ditolak')
                                    <button class="btn-submit" disabled style="background: #6b7280; padding: 8px 16px; font-size: 14px;">
                                        <i class="bi bi-ban me-1"></i> Ditolak
                                    </button>
                                @else
                                    <button class="btn-submit" disabled style="background: #f59e0b; padding: 8px 16px; font-size: 14px;">
                                        <i class="bi bi-clock me-1"></i> Diproses
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-search fa-3x text-muted mb-3"></i>
            <h5 class="text-muted mb-3">Tidak ada data surat ditemukan</h5>
            <p class="text-muted mb-4">Tidak ada pengajuan surat untuk NIK <strong>{{ request('nik') }}</strong></p>
            <div class="form-row justify-content-center">
                <div class="form-col" style="flex: 0 0 auto; width: 200px;">
                    <a href="{{ route('pengantar') }}" class="btn-submit">
                        <i class="bi bi-shop me-1"></i> Ajukan SKU
                    </a>
                </div>
                <div class="form-col" style="flex: 0 0 auto; width: 200px;">
                    <a href="{{ route('pengantar') }}" class="btn-submit" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                        <i class="bi bi-file-earmark-text me-1"></i> Ajukan SKTM
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
    @else
    <!-- Informasi Sebelum Pencarian -->
    <div class="card">
        <div class="text-center py-5">
            <i class="bi bi-file-earmark-text fa-4x text-success mb-4"></i>
            <h4 class="text-success mb-3">Cek Status Pengajuan Surat Anda</h4>
            <p class="text-muted mb-4 fs-5">
                Masukkan NIK Anda di form pencarian di atas untuk melihat status pengajuan surat.<br>
                Anda dapat mengunduh surat yang sudah disetujui langsung dari halaman ini.
            </p>
            
            <div class="form-row justify-content-center">
                <div class="form-col">
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
                </div>
                <div class="form-col">
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
                </div>
                <div class="form-col">
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
            </div>

            <div class="mt-5">
                <h5 class="mb-4">Jenis Surat yang Tersedia</h5>
                <div class="form-row justify-content-center">
                    <div class="form-col">
                        <div class="card border-info h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-shop fa-2x text-info mb-2"></i>
                                <h6 class="card-title">Surat Keterangan Usaha (SKU)</h6>
                                <p class="card-text small">Untuk keperluan administrasi usaha dan bisnis</p>
                                <a href="{{ route('pengantar') }}" class="btn-submit" style="background: linear-gradient(135deg, #3b82f6, #2563eb); padding: 8px 16px;">
                                    Ajukan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="card border-primary h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-file-earmark-text fa-2x text-primary mb-2"></i>
                                <h6 class="card-title">Surat Keterangan Tidak Mampu (SKTM)</h6>
                                <p class="card-text small">Untuk keperluan bantuan sosial dan pendidikan</p>
                                <a href="{{ route('pengantar') }}" class="btn-submit" style="padding: 8px 16px;">
                                    Ajukan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function() {
            const btnCari = document.getElementById('btnCari');
            if (btnCari) {
                btnCari.disabled = true;
                btnCari.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Memproses...';
            }
        });
    }

    // Auto remove loading state jika halaman direfresh
    const btnCari = document.getElementById('btnCari');
    if (btnCari) {
        btnCari.disabled = false;
        btnCari.innerHTML = '<i class="bi bi-search me-2"></i> Cek Status';
    }
});
</script>
@endsection