@extends('layouts.landing.app')

@section('content')
<style>
/* Custom styles untuk halaman status pengaduan */
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
}

.form-control-lg:focus {
    border-color: #2E7D32;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}

.btn-success {
    background: #2E7D32;
    border: none;
    border-radius: 10px;
    padding: 14px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background: #2E7D32;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
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
}

.table thead {
    background: linear-gradient(135deg, #198754, #2E7D32);
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
}

.table tbody td {
    padding: 14px 12px;
    vertical-align: middle;
    border-color: #f1f3f4;
    font-size: 0.9rem;
    white-space: nowrap;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Scrollbar styling untuk tabel */
.table-wrapper::-webkit-scrollbar {
    height: 8px;
}

.table-wrapper::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 0 0 10px 10px;
}

.table-wrapper::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* PERBAIKAN: Badge styling dengan font putih untuk SEMUA status */
.badge {
    font-size: 0.8rem;
    font-weight: 600;
    padding: 8px 12px;
    border-radius: 8px;
    color: white !important;
    min-width: 80px;
    display: inline-block;
    text-align: center;
    border: none;
}

.badge.bg-primary { 
    background: linear-gradient(135deg, #0d6efd, #0b5ed7) !important; 
}

.badge.bg-warning { 
    background: linear-gradient(135deg, #ff9800, #f57c00) !important;
}

.badge.bg-success { 
    background: linear-gradient(135deg, #198754, #157347) !important; 
}

.badge.bg-danger { 
    background: linear-gradient(135deg, #dc3545, #c82333) !important; 
}

.badge.bg-secondary { 
    background: linear-gradient(135deg, #6c757d, #5a6268) !important; 
}

/* Text muted untuk empty state */
.text-muted {
    color: #6c757d !important;
    font-style: italic;
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
        text-align: center;
    }
    
    .header-subtitle {
        font-size: 1rem;
        text-align: center;
    }
    
    .header-left {
        text-align: center;
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
        min-width: 70px;
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
    
    /* Hide some columns on mobile */
    .table thead th:nth-child(2),
    .table tbody td:nth-child(2) {
        display: none;
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

<div class="status-pengaduan-container">

    {{-- === JUDUL - POSISI KIRI === --}}
    <div class="header-left">
        <h2 class="header-title">Status Pengaduan Online Warga Desa</h2>
        <p class="header-subtitle">Masukkan email Anda untuk melihat status pengaduan yang telah dikirim.</p>
    </div>

    {{-- === CARD FORM PENCARIAN === --}}
    <div class="card">
        <div class="card-body form-container">
            <form action="{{ route('pengaduan.userStatus') }}" method="GET" id="searchForm">
                {{-- Desktop Layout --}}
                <div class="form-row-desktop d-md-flex">
                    <div class="form-input-desktop">
                        <input type="email" name="email" class="form-control form-control-lg"
                            placeholder="Masukkan email Anda..." value="{{ request('email') }}" required>
                    </div>
                    <div class="form-button-desktop">
                        <button class="btn btn-success" type="submit" id="btnCari">
                            <span id="textCari"><i class="fas fa-search"></i> Cek Status</span>
                            <span id="loadingCari"><i class="fas fa-spinner fa-spin"></i> Memproses...</span>
                        </button>
                    </div>
                </div>
                
                {{-- Mobile Layout --}}
                <div class="form-row-mobile d-md-none">
                    <input type="email" name="email" class="form-control form-control-lg"
                        placeholder="Masukkan email Anda..." value="{{ request('email') }}" required>
                    <button class="btn btn-success" type="submit" id="btnCariMobile">
                        <span id="textCariMobile"><i class="fas fa-search"></i> Cek Status</span>
                        <span id="loadingCariMobile"><i class="fas fa-spinner fa-spin"></i> Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- === CARD TABEL HASIL === --}}
    <div class="card">
        <div class="card-body form-container">
            <div class="table-responsive-container">
                <div class="table-wrapper">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Pelapor</th>
                                <th>Email</th>
                                <th>Judul Pengaduan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tanggal Pengaduan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse((request('email') ? $pengaduans : []) as $index => $data)
                                <tr>
                                    <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ Str::limit($data->judul, 60) }}</td>
                                    <td class="text-center">
                                        @if($data->status == 'baru')
                                            <span class="badge bg-primary">Baru</span>
                                        @elseif($data->status == 'diproses')
                                            <span class="badge bg-warning">Diproses</span>
                                        @elseif($data->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($data->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Diketahui</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        @if(request('email'))
                                            <i class="fas fa-search me-2"></i>
                                            Tidak ada pengaduan ditemukan untuk email ini.
                                        @else
                                            <i class="fas fa-info-circle me-2"></i>
                                            Silakan masukkan email Anda terlebih dahulu.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
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
        </div>
    </div>

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
        const emailInput = document.querySelector('input[name="email"]');
        if (!emailInput.value.trim()) {
            e.preventDefault();
            emailInput.focus();
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

// Auto focus pada input email jika ada error atau pertama kali load
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.querySelector('input[name="email"]');
    if (emailInput && !emailInput.value) {
        emailInput.focus();
    }
});
</script>
@endsection