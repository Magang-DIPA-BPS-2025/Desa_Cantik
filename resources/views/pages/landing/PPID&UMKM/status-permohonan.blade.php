@extends('layouts.landing.app')

@section('content')
<title>Status Permohonan Informasi Publik</title>

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
    
    .form-control-email { 
        width: 100%; 
        padding: 14px 16px; 
        border: 2px solid #e2e8f0; 
        border-radius: 8px; 
        font-size: 15px; 
        transition: all 0.3s ease;
        background: #f8fafc;
        text-align: left;
        font-family: 'Open Sans', sans-serif;
        height: 52px; /* TINGGI SAMA DENGAN TOMBOL */
        box-sizing: border-box;
    }
    
    .form-control-email:focus {
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
        text-align: center;
        font-family: 'Poppins', sans-serif;
        height: 52px; /* TINGGI SAMA DENGAN INPUT */
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }
    
    .btn-submit:hover { 
        background: linear-gradient(135deg, #1B5E20, #388E3C);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(46, 125, 50, 0.2);
    }

    .btn-download {
        background: transparent;
        color: #2E7D32;
        border: 2px solid #2E7D32;
        padding: 8px 16px;
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
        border-bottom: 1px solid #e5e7eb; 
    }

    .table thead { 
        background: linear-gradient(90deg, #16a34a, #16a34a); 
        color: #fff; 
        font-weight: 600; 
        font-family: 'Poppins', sans-serif; 
    }

    /* Badge Styles */
    .badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        font-family: 'Open Sans', sans-serif;
        font-size: 14px;
    }

    .badge-warning {
        background: #f59e0b;
        color: white;
    }

    .badge-success {
        background: #22c55e;
        color: white;
    }

    .badge-danger {
        background: #ef4444;
        color: white;
    }

    .badge-secondary {
        background: #6b7280;
        color: white;
    }

    /* Row dan Column Layout - PERBAIKAN UTAMA */
    .form-row {
        display: flex;
        gap: 15px;
        margin-bottom: 0;
        align-items: flex-start;
    }
    
    .form-col {
        display: flex;
        flex-direction: column;
    }
    
    .form-col-email {
        flex: 3;
    }
    
    .form-col-button {
        flex: 1;
        max-width: 200px;
    }

    /* Loading State */
    .loading {
        display: none;
    }
    
    /* Memastikan input dan tombol memiliki tinggi yang sama */
    .input-group {
        display: flex;
        align-items: stretch;
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
            max-width: 100%;
            width: 100%;
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
        
        .btn-submit {
            margin-top: 0;
        }
        
        .form-control-email,
        .btn-submit {
            height: 48px; /* Sesuaikan tinggi untuk mobile */
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
        
        .btn-submit {
            padding: 14px 20px;
            font-size: 14px;
        }
        
        .form-control-email {
            padding: 12px 14px;
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
            STATUS PERMOHONAN INFORMASI PUBLIK
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Masukkan email Anda untuk melihat status permohonan informasi publik yang telah diajukan
        </p>
    </div>

    <!-- Card Form Pencarian - PERBAIKAN UTAMA -->
    <div class="card">
        <form id="statusForm" action="{{ route('permohonan.userStatus') }}" method="GET">
            <div class="form-group">
                <label>Alamat Email <span class="text-danger">*</span></label>
                <div class="form-row">
                    <div class="form-col form-col-email">
                        <input type="email" name="email" class="form-control-email" 
                               placeholder="Masukkan email Anda untuk melihat status permohonan..." 
                               value="{{ request('email') }}" required>
                    </div>
                    <div class="form-col form-col-button">
                        <button class="btn-submit" type="submit" id="cekStatusBtn">
                            <span id="cekStatusText">
                                <i class="bi bi-search me-2"></i> Cek Status
                            </span>
                            <span id="cekStatusLoading" class="loading">
                                <i class="bi bi-arrow-repeat me-2"></i> Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Card Tabel Data -->
    <div class="card">
        <div class="form-group">
            <h5 style="color: #2E7D32; font-weight: 600; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">
                <i class="bi bi-table me-2"></i>
                Data Permohonan Informasi Publik
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemohon</th>
                        <th>Email</th>
                        <th>Permohonan</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Tanggal Permohonan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse((request('email') ? $permohonans : []) as $index => $data)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->alamat_email }}</td>
                            <td>{{ Str::limit($data->permohonan, 60) }}</td>
                            <td>
                                @if($data->status == 'diproses')
                                    <span class="badge badge-warning">Diproses</span>
                                @elseif($data->status == 'selesai')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif($data->status == 'ditolak')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-secondary">Belum Ditetapkan</span>
                                @endif
                            </td>
                            <td>
                                @if($data->file_path)
                                    <a href="{{ asset('storage/' . $data->file_path) }}" 
                                       class="btn-download" target="_blank">
                                        <i class="bi bi-download me-1"></i> Download
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                @if(request('email'))
                                    <i class="bi bi-search display-4 d-block mb-2"></i>
                                    Tidak ada permohonan ditemukan untuk email ini.
                                @else
                                    <i class="bi bi-envelope display-4 d-block mb-2"></i>
                                    Silakan masukkan email Anda untuk melihat status.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusForm = document.getElementById('statusForm');
    const cekStatusBtn = document.getElementById('cekStatusBtn');
    const cekStatusText = document.getElementById('cekStatusText');
    const cekStatusLoading = document.getElementById('cekStatusLoading');

    if (statusForm) {
        statusForm.addEventListener('submit', function() {
            cekStatusBtn.disabled = true;
            cekStatusText.style.display = 'none';
            cekStatusLoading.style.display = 'inline';
        });
    }

    // Reset loading state jika halaman direfresh
    if (cekStatusBtn) {
        cekStatusBtn.disabled = false;
        cekStatusText.style.display = 'inline';
        cekStatusLoading.style.display = 'none';
    }
});
</script>
@endsection