@extends('layouts.landing.app')

@section('content')
<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600&display=swap');

/* Font Variables */
:root {
    --font-heading: 'Poppins', sans-serif;
    --font-body: 'Open Sans', sans-serif;
    --color-success: #2E7D32;
}

/* Apply Fonts */
.modern-title {
    font-family: var(--font-heading) !important;
    font-weight: 700 !important;
    letter-spacing: -0.02em !important;
}

.modern-text {
    font-family: var(--font-body) !important;
    font-weight: 400 !important;
    line-height: 1.6 !important;
}

.modern-btn {
    font-family: var(--font-body) !important;
    font-weight: 500 !important;
}

.modern-input {
    font-family: var(--font-body) !important;
}

.modern-table {
    font-family: var(--font-body) !important;
}

/* Custom Styling */
.page-header {
    text-align: left !important;
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--color-success);
    margin-bottom: 0.5rem;
}

.page-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    margin-bottom: 0;
}

.card {
    border-radius: 12px;
    overflow: hidden;
}

.form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 0.75rem 1rem;
    font-size: 1rem;
}

.form-control:focus {
    border-color: var(--color-success);
    box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
}

.btn-success {
    background-color: var(--color-success);
    border-color: var(--color-success);
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

.btn-success:hover {
    background-color: #1B5E20;
    border-color: #1B5E20;
}

.table th {
    font-family: var(--font-heading);
    font-weight: 600;
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

.badge {
    font-family: var(--font-body);
    font-weight: 500;
    font-size: 0.8rem;
    padding: 0.5em 0.75em;
    border-radius: 6px;
}

.badge.bg-warning {
    color: #212529 !important;
}

.badge.bg-success,
.badge.bg-danger,
.badge.bg-secondary {
    color: #fff !important;
}

.btn-outline-primary {
    font-family: var(--font-body);
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
}
</style>

<div class="container mt-5 mb-5">

    {{-- HEADER --}}
    <div class="page-header">
        <h2 class="page-title modern-title">Status Permohonan Informasi Publik</h2>
        <p class="page-subtitle modern-text">Masukkan email Anda untuk melihat status permohonan informasi publik yang telah diajukan</p>
    </div>

    {{-- CARD FORM PENCARIAN --}}
    <div class="card shadow-lg border-0 mx-auto mb-4" style="max-width: 1200px;">
        <div class="card-body p-4">
            <form id="statusForm" action="{{ route('permohonan.userStatus') }}" method="GET">
                <div class="row g-3 align-items-center">
                    <div class="col-md-9 col-sm-12">
                        <input type="email" name="email" class="form-control form-control-lg modern-input"
                               placeholder="Masukkan email Anda untuk melihat status permohonan..."
                               value="{{ request('email') }}" required>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <button class="btn btn-success btn-lg w-100 modern-btn" type="submit" id="cekStatusBtn">
                            <span id="cekStatusText"><i class="fas fa-search"></i> Cek Status</span>
                            <span id="cekStatusLoading" class="d-none">
                                <i class="fas fa-spinner fa-spin"></i> Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- CARD TABEL DATA --}}
    <div class="card shadow-lg border-0 mx-auto" style="max-width: 1200px;">
        <div class="card-body p-4">
            <div class="table-responsive modern-table">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-success text-center">
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
                                <td class="text-center modern-text">{{ $index + 1 }}</td>
                                <td class="modern-text">{{ $data->nama }}</td>
                                <td class="modern-text">{{ $data->alamat_email }}</td>
                                <td class="modern-text">{{ Str::limit($data->permohonan, 60) }}</td>
                                <td class="text-center">
                                    @if($data->status == 'diproses')
                                        <span class="badge bg-warning text-white modern-text">Diproses</span>
                                    @elseif($data->status == 'selesai')
                                        <span class="badge bg-success text-white modern-text">Selesai</span>
                                    @elseif($data->status == 'ditolak')
                                        <span class="badge bg-danger text-white modern-text">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary text-white modern-text">Belum Ditetapkan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($data->file_path)
                                        <a href="{{ asset('storage/' . $data->file_path) }}"
                                           class="btn btn-outline-primary btn-sm modern-text" target="_blank">
                                           <i class="fas fa-download"></i> Download
                                        </a>
                                    @else
                                        <span class="text-muted modern-text">Tidak ada file</span>
                                    @endif
                                </td>
                                <td class="text-center modern-text">
                                    {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted modern-text">
                                    @if(request('email'))
                                        Tidak ada permohonan ditemukan untuk email ini.
                                    @else
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

</div>

{{-- Script Loading Tombol --}}
<script>
document.getElementById('statusForm').addEventListener('submit', function() {
    document.getElementById('cekStatusBtn').disabled = true;
    document.getElementById('cekStatusText').classList.add('d-none');
    document.getElementById('cekStatusLoading').classList.remove('d-none');
});
</script>
@endsection