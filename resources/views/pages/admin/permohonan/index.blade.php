@extends('layouts.app', ['title' => 'Permohonan Informasi'])

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    table th, table td {
        vertical-align: middle !important;
        text-align: center;
    }

    .status-select {
        min-width: 130px;
        border-radius: 6px;
    }

    .btn-sm i {
        margin-right: 4px;
    }

    .table thead th {
        background-color: #1abc9c;
        color: white;
    }

    /* Styling untuk tombol download Excel */
    .btn-download-excel { 
        background: #16a34a; 
        color: #fff; 
        border: none; 
        border-radius: 8px; 
        padding: 8px 14px; 
        display: flex; 
        align-items: center; 
        gap: 6px; 
        font-size: 14px; 
        font-weight: 500; 
        cursor: pointer; 
        transition: .3s; 
        font-family: 'Poppins', sans-serif; 
        text-decoration: none;
        margin-bottom: 15px;
    }

    .btn-download-excel:hover { 
        background: #15803d; 
        color: #fff;
        text-decoration: none;
    }

    /* Styling untuk DataTables controls */
    .dataTables-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .dataTables-length {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .dataTables-filter {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .dataTables-length label,
    .dataTables-filter label {
        margin-bottom: 0;
        font-weight: 500;
        white-space: nowrap;
    }

    .dataTables-length select {
        width: auto;
        display: inline-block;
        min-width: 70px;
    }

    .dataTables-filter input {
        width: auto;
        display: inline-block;
        min-width: 150px;
    }

    /* Styling untuk pagination */
    .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pagination-info {
        font-size: 14px;
        color: #6c757d;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: flex-end;
    }

    /* Responsive untuk DataTables - TAMPILAN HP */
    @media (max-width: 576px) {
        .dataTables-controls {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .dataTables-length,
        .dataTables-filter {
            justify-content: space-between;
            width: 100%;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        
        .dataTables-length {
            order: 1;
        }
        
        .dataTables-filter {
            order: 2;
        }
        
        .btn-download-excel {
            width: 100%;
            justify-content: center;
        }
        
        .dataTables-length select {
            flex: 1;
            max-width: 80px;
        }
        
        .dataTables-filter input {
            flex: 1;
            min-width: 120px;
        }
        
        /* Pagination di HP */
        .pagination-container {
            flex-direction: column;
            text-align: center;
        }
        
        .pagination-wrapper {
            justify-content: center;
            width: 100%;
        }
        
        .pagination-info {
            text-align: center;
            width: 100%;
        }
    }

    /* Desktop */
    @media (min-width: 577px) {
        .dataTables-controls {
            flex-direction: row;
            justify-content: space-between;
        }
        
        .dataTables-length {
            order: 1;
        }
        
        .dataTables-filter {
            order: 2;
        }
    }

    /* Styling untuk kolom dengan text overflow */
    td.permohonan-col {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Hover tampilkan full */
    td.permohonan-col:hover {
        white-space: normal;
        overflow: visible;
        position: relative;
        z-index: 1;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>📄 Daftar Permohonan Informasi</h1>
        </div>

        <div class="section-body">
            <div class="card shadow">
                <div class="card-body">

                    {{-- Notifikasi sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Tombol Download Excel --}}
                    <button class="btn-download-excel" onclick="downloadExcel()">
                        <i class="fas fa-file-excel"></i> Download Excel
                    </button>

                    {{-- Controls (Entri dan Pencarian) --}}
                    <form method="GET" action="{{ route('permohonan.index') }}" id="filter-form">
                        <div class="dataTables-controls">
                            <div class="dataTables-length">
                                <label for="per_page">Show</label>
                                <select name="per_page" id="per_page" class="form-control form-control-sm" onchange="document.getElementById('filter-form').submit()">
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <span>entries</span>
                            </div>
                            <div class="dataTables-filter">
                                <label for="search">Search:</label>
                                <input type="search" name="search" id="search" class="form-control form-control-sm" placeholder="Cari..." value="{{ request('search') }}" onkeypress="if(event.keyCode == 13) { document.getElementById('filter-form').submit() }">
                                @if(request('search'))
                                    <a href="{{ route('permohonan.index') }}" class="btn btn-sm btn-outline-secondary ml-2">Reset</a>
                                @endif
                            </div>
                        </div>
                    </form>

                    {{-- Tabel --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table-permohonan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Telepon</th>
                                    <th>Instansi</th>
                                    <th>Email</th>
                                    <th class="permohonan-col">Isi Permohonan</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permohonans as $key => $permohonan)
                                <tr>
                                    <td>{{ $permohonans->firstItem() + $key }}</td>
                                    <td>{{ $permohonan->nama }}</td>
                                    <td>{{ $permohonan->nomor_telepon }}</td>
                                    <td>{{ $permohonan->asal_instansi ?? '-' }}</td>
                                    <td>{{ $permohonan->alamat_email }}</td>
                                    <td class="text-left permohonan-col" title="{{ $permohonan->permohonan }}">{{ Str::limit($permohonan->permohonan, 80) }}</td>
                                    <td>
                                        @if ($permohonan->file_path)
                                            <a href="{{ asset('storage/' . $permohonan->file_path) }}" 
                                               target="_blank" 
                                               class="btn btn-outline-primary btn-sm">
                                               <i class="fas fa-file-alt"></i> Lihat
                                            </a>
                                        @else
                                            <span class="badge badge-light text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('permohonan.updateStatus', $permohonan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" 
                                                    class="form-control form-control-sm status-select"
                                                    onchange="this.form.submit()">
                                                <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('permohonan.edit', $permohonan->id) }}" 
                                               class="btn btn-warning btn-sm mr-1">
                                               <i class="fas fa-edit"></i>Edit
                                            </a>
                                            <form action="{{ route('permohonan.destroy', $permohonan->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Belum ada data permohonan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination dengan Info --}}
                    @if($permohonans->hasPages())
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Menampilkan {{ ($permohonans->currentPage() - 1) * $permohonans->perPage() + 1 }} 
                            sampai {{ min($permohonans->currentPage() * $permohonans->perPage(), $permohonans->total()) }} 
                            dari {{ $permohonans->total() }} entri
                        </div>
                        <div class="pagination-wrapper">
                            {{ $permohonans->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Excel Export -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
// Download Excel Function
function downloadExcel(){ 
    const wb = XLSX.utils.table_to_book(document.getElementById("table-permohonan")); 
    XLSX.writeFile(wb, "Data_Permohonan_Informasi_Desa_Manggalung.xlsx"); 
}

// Fungsi pencarian manual jQuery - TETAP BERFUNGSI
$(document).ready(function() {
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table-permohonan tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>
@endpush