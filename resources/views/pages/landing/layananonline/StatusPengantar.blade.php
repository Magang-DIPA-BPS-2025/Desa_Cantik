@extends('layouts.landing.app')

@section('content')
<div class="container mt-5 mb-5">

    {{-- === JUDUL === --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold text-success mb-3">Status Surat Pengantar Online Warga Desa</h2>
        <p class="text-muted fs-5">Masukkan NIK Anda untuk melihat status pengajuan surat.</p>
    </div>

    {{-- === CARD FORM PENCARIAN === --}}
    <div class="card shadow-lg border-0 mx-auto mb-4" style="max-width: 1200px;">
        <div class="card-body p-4">
            <form action="{{ route('status') }}" method="GET" id="searchForm">
                <div class="row g-3 align-items-center">
                    <div class="col-md-9 col-sm-12">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-id-card text-muted"></i>
                            </span>
                            <input type="text" name="nik" class="form-control border-start-0"
                                placeholder="Masukkan 16 digit NIK Anda..." value="{{ request('nik') }}" 
                                pattern="[0-9]{16}" title="Masukkan 16 digit NIK" required>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <button class="btn btn-success btn-lg w-100 h-100" type="submit" id="btnCari">
                            <span id="textCari"><i class="fas fa-search me-2"></i> Cek Status</span>
                            <span id="loadingCari" class="d-none"><i class="fas fa-spinner fa-spin me-2"></i> Memproses...</span>
                        </button>
                    </div>
                </div>
                <small class="text-muted mt-3 d-block">
                    <i class="fas fa-info-circle me-1"></i> Masukkan Nomor Induk Kependudukan (NIK) 16 digit
                </small>
            </form>
        </div>
    </div>

    {{-- === CARD TABEL HASIL SURAT === --}}
    @if(request('nik'))
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 1200px;">
        <div class="card-header bg-success text-white py-3">
            <h5 class="card-title mb-0 d-flex align-items-center">
                <i class="fas fa-file-alt me-2 fs-4"></i>
                <span>Hasil Pencarian Surat untuk NIK: <strong>{{ request('nik') }}</strong></span>
            </h5>
        </div>
        <div class="card-body p-4">
            @if($datas && count($datas) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-success">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th class="text-center" style="width: 180px;">Jenis Surat</th>
                            <th class="text-center">Nama Pemohon</th>
                            <th class="text-center" style="width: 180px;">Status</th>
                            <th class="text-center" style="width: 150px;">Tanggal Pengajuan</th>
                            <th class="text-center" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $index => $surat)
                            <tr>
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    @if(isset($surat->nama_usaha))
                                        <span class="badge bg-info text-dark fs-6 px-3 py-2">
                                            <i class="fas fa-store me-1"></i>
                                            Surat Keterangan Usaha
                                        </span>
                                    @else
                                        <span class="badge bg-primary text-white fs-6 px-3 py-2">
                                            <i class="fas fa-file-contract me-1"></i>
                                            Surat Keterangan Tidak Mampu
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="mb-1">{{ $surat->nama ?? $surat->nama_pemohon ?? '-' }}</strong>
                                        @if(isset($surat->nama_usaha))
                                            <small class="text-muted">
                                                <i class="fas fa-store me-1"></i>Usaha: {{ $surat->nama_usaha }}
                                            </small>
                                        @endif
                                        @if(isset($surat->keperluan))
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>Keperluan: {{ $surat->keperluan }}
                                            </small>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($surat->status_verifikasi === 'Terverifikasi' || $surat->status === 'Disetujui')
                                        <span class="badge bg-success fs-6 px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i> Disetujui
                                        </span>
                                    @elseif($surat->status === 'Ditolak')
                                        <span class="badge bg-danger fs-6 px-3 py-2">
                                            <i class="fas fa-times-circle me-1"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                                            <i class="fas fa-clock me-1"></i> Menunggu Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium">{{ \Carbon\Carbon::parse($surat->created_at)->translatedFormat('d F Y') }}</span>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($surat->created_at)->format('H:i') }}
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if(($surat->status_verifikasi === 'Terverifikasi' || $surat->status === 'Disetujui'))
                                        @if(isset($surat->nama_usaha))
                                            {{-- SKU --}}
                                            <a class="btn btn-success btn-sm px-3" href="{{ route('sku.cetak', $surat->id) }}" target="_blank">
                                                <i class="fas fa-download me-1"></i> Unduh PDF
                                            </a>
                                        @else
                                            {{-- SKTM --}}
                                            <a class="btn btn-success btn-sm px-3" href="{{ route('sktm.cetak', $surat->id) }}" target="_blank">
                                                <i class="fas fa-download me-1"></i> Unduh PDF
                                            </a>
                                        @endif
                                    @elseif($surat->status === 'Ditolak')
                                        <button class="btn btn-outline-danger btn-sm px-3" disabled>
                                            <i class="fas fa-ban me-1"></i> Ditolak
                                        </button>
                                    @else
                                        <button class="btn btn-outline-warning btn-sm px-3" disabled>
                                            <i class="fas fa-clock me-1"></i> Diproses
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
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h5 class="text-muted mb-3">Tidak ada data surat ditemukan</h5>
                <p class="text-muted mb-4">Tidak ada pengajuan surat untuk NIK <strong>{{ request('nik') }}</strong></p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('status') }}" class="btn btn-success px-4 py-2">
                        <i class="fas fa-store me-1"></i> Ajukan SKU
                    </a>
                    <a href="{{ route('status') }}" class="btn btn-primary px-4 py-2">
                        <i class="fas fa-file-contract me-1"></i> Ajukan SKTM
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
    @else
    {{-- === INFO SEBELUM PENCARIAN === --}}
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 1200px;">
        <div class="card-body text-center py-5">
            <i class="fas fa-file-invoice fa-4x text-success mb-4"></i>
            <h4 class="text-success mb-3">Cek Status Pengajuan Surat Anda</h4>
            <p class="text-muted mb-4 fs-5">
                Masukkan NIK Anda di form pencarian di atas untuk melihat status pengajuan surat.<br>
                Anda dapat mengunduh surat yang sudah disetujui langsung dari halaman ini.
            </p>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row text-start">
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                <span class="badge bg-success me-3 p-2 fs-6"><i class="fas fa-check"></i></span>
                                <div>
                                    <strong class="d-block">Surat Disetujui</strong>
                                    <small class="text-muted">Dapat mengunduh file PDF</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                <span class="badge bg-warning me-3 p-2 fs-6"><i class="fas fa-clock"></i></span>
                                <div>
                                    <strong class="d-block">Menunggu Verifikasi</strong>
                                    <small class="text-muted">Sedang diproses oleh admin</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                <span class="badge bg-danger me-3 p-2 fs-6"><i class="fas fa-times"></i></span>
                                <div>
                                    <strong class="d-block">Surat Ditolak</strong>
                                    <small class="text-muted">Pengajuan tidak disetujui</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h5 class="mb-3">Jenis Surat yang Tersedia</h5>
                <div class="row justify-content-center">
                    <div class="col-md-5 mb-3">
                        <div class="card border-info h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-store fa-2x text-info mb-2"></i>
                                <h6 class="card-title">Surat Keterangan Usaha (SKU)</h6>
                                <p class="card-text small">Untuk keperluan administrasi usaha dan bisnis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div class="card border-primary h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-file-contract fa-2x text-primary mb-2"></i>
                                <h6 class="card-title">Surat Keterangan Tidak Mampu (SKTM)</h6>
                                <p class="card-text small">Untuk keperluan bantuan sosial dan pendidikan</p>
                            </div>
                        </div>
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
    if (searchForm) {
        searchForm.addEventListener('submit', function() {
            const btnCari = document.getElementById('btnCari');
            const textCari = document.getElementById('textCari');
            const loadingCari = document.getElementById('loadingCari');
            
            if (btnCari && textCari && loadingCari) {
                btnCari.disabled = true;
                textCari.classList.add('d-none');
                loadingCari.classList.remove('d-none');
            }
        });
    }

    // Auto remove loading state jika halaman direfresh
    const btnCari = document.getElementById('btnCari');
    if (btnCari) {
        btnCari.disabled = false;
        document.getElementById('textCari')?.classList.remove('d-none');
        document.getElementById('loadingCari')?.classList.add('d-none');
    }
});
</script>

<style>
.card {
    border-radius: 15px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    padding: 1rem 0.75rem;
}

.table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
}

.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
    border-radius: 8px;
}

.form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

.input-group-text {
    border-radius: 10px 0 0 10px !important;
    background-color: #f8f9fa;
}

.btn {
    border-radius: 10px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.btn-success {
    background: linear-gradient(135deg, #198754, #157347);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #157347, #13653f);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0b5ed7, #0a58ca);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.table-hover tbody tr:hover {
    background-color: rgba(25, 135, 84, 0.05);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .card-body {
        padding: 1.5rem !important;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.4em 0.6em;
    }
}
</style>
@endsection