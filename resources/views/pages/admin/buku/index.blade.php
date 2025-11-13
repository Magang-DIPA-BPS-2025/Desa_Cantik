@extends('layouts.app', ['title' => 'Data Buku Tamu'])

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
    .table-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 6px;
    }
    .badge-custom {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
    .action-buttons {
        white-space: nowrap;
    }
    .action-buttons .btn {
        margin-right: 6px;
    }
    .action-buttons .btn:last-child {
        margin-right: 0;
    }

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
    
    .ttd-badge {
        font-size: 0.7rem;
        padding: 0.2em 0.4em;
    }

    td.keperluan-col {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    td.keperluan-col:hover {
        white-space: normal;
        overflow: visible;
        position: relative;
        z-index: 1;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

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
        
        .badge-custom { 
            font-size: 0.7rem; 
        }
        
        .action-buttons .btn {
            margin-right: 3px;
            padding: 0.25rem 0.4rem;
        }

        .ttd-preview {
            width: 50px;
            height: 25px;
        }
    }

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
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Buku Tamu Desa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
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
                            <form method="GET" action="{{ route('admin.buku.index') }}" id="filter-form">
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
                                            <a href="{{ route('admin.buku.index') }}" class="btn btn-sm btn-outline-secondary ml-2">Reset</a>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped" id="table-bukutamu">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Asal Instansi</th>
                                            <th>Jabatan</th>
                                            <th class="keperluan-col">Keperluan</th>
                                            <th>Tanggal (WITA)</th>
                                            <th>Tanda Tangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bukutamus as $index => $tamu)
                                            <tr>
                                                <td>{{ ($bukutamus->currentPage() - 1) * $bukutamus->perPage() + $index + 1 }}</td>
                                                <td>{{ $tamu->nama }}</td>
                                                <td>{{ $tamu->asal }}</td>
                                                <td>{{ $tamu->jabatan ?? '-' }}</td>
                                                <td class="keperluan-col" title="{{ $tamu->keperluan }}">{{ $tamu->keperluan }}</td>
                                                <td>
                                                    @if($tamu->waktu_kunjungan)
                                                        {{ \Carbon\Carbon::parse($tamu->waktu_kunjungan)->timezone('Asia/Makassar')->format('d/m/Y H:i') }}
                                                    @else
                                                        {{ $tamu->created_at->timezone('Asia/Makassar')->format('d/m/Y H:i') }}
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    @if($tamu->tanda_tangan)
                                                        <div class="ttd-preview" onclick="showTTD('{{ $tamu->tanda_tangan }}', '{{ $tamu->nama }}')">
                                                            <img src="{{ $tamu->tanda_tangan }}" alt="TTD {{ $tamu->nama }}">
                                                        </div>
                                                        <small class="badge badge-success ttd-badge">TTD</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="action-buttons">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.buku.edit', $tamu->id) }}" 
                                                           class="btn btn-warning btn-sm"
                                                           data-toggle="tooltip"
                                                           title="Edit Data">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.buku.destroy', $tamu->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-danger btn-sm"
                                                                    data-toggle="tooltip"
                                                                    title="Hapus Data"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">
                                                    Belum ada data buku tamu.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination dengan Info --}}
                            @if($bukutamus->hasPages())
                            <div class="pagination-container">
                                <div class="pagination-info">
                                    Menampilkan {{ ($bukutamus->currentPage() - 1) * $bukutamus->perPage() + 1 }} 
                                    sampai {{ min($bukutamus->currentPage() * $bukutamus->perPage(), $bukutamus->total()) }} 
                                    dari {{ $bukutamus->total() }} entri
                                </div>
                                <div class="pagination-wrapper">
                                    {{ $bukutamus->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal untuk menampilkan TTD -->
<div class="modal fade" id="ttdModal" tabindex="-1" role="dialog" aria-labelledby="ttdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ttdModalLabel">Tanda Tangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="ttdModalImage" src="" alt="Tanda Tangan" style="max-width: 100%; border: 1px solid #e2e8f0; border-radius: 4px;">
                <p id="ttdModalName" class="mt-3 mb-0 font-weight-bold text-dark"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<!-- Excel Export -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
$(document).ready(function () {
    // DataTables initialization
    $('#table-bukutamu').DataTable({
        paging: false,
        searching: false,
        ordering: true,
        responsive: true,
        info: false,
        language: { 
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            search: "Cari:",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 hingga 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)"
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
});

// Fungsi untuk menampilkan TTD di modal
function showTTD(ttdData, nama) {
    document.getElementById('ttdModalImage').src = ttdData;
    document.getElementById('ttdModalName').textContent = 'Tanda Tangan: ' + nama;
    $('#ttdModal').modal('show');
}

// Download Excel Function
function downloadExcel(){ 
    const wb = XLSX.utils.book_new();
    const excelData = [
        ["DATA BUKU TAMU DESA MANGGAUNG - ADMIN"],
        ["Tanggal Ekspor: " + new Date().toLocaleDateString('id-ID', { timeZone: 'Asia/Makassar' })],
        ["Waktu Ekspor: " + new Date().toLocaleTimeString('id-ID', { timeZone: 'Asia/Makassar' }) + " WITA"],
        [""],
        ["No", "Nama", "Asal Instansi", "Jabatan", "Keperluan", "Tanggal Kunjungan", "Tanda Tangan"]
    ];

    @foreach($bukutamus as $index => $tamu)
    excelData.push([
        {{ $index + 1 }},
        "{{ $tamu->nama }}",
        "{{ $tamu->asal }}",
        "{{ $tamu->jabatan ?? '-' }}",
        "{{ $tamu->keperluan }}",
        "{{ $tamu->waktu_kunjungan ? \Carbon\Carbon::parse($tamu->waktu_kunjungan)->format('d/m/Y H:i') . ' WITA' : $tamu->created_at->timezone('Asia/Makassar')->format('d/m/Y H:i') . ' WITA' }}",
        "{{ $tamu->tanda_tangan ? 'Ya' : 'Tidak' }}"
    ]);
    @endforeach

    const ws = XLSX.utils.aoa_to_sheet(excelData);
    ws['!cols'] = [
        {wch: 6}, 
        {wch: 25}, 
        {wch: 25}, 
        {wch: 20}, 
        {wch: 20}, 
        {wch: 50}, 
        {wch: 20}, 
        {wch: 12}
    ];
    XLSX.utils.book_append_sheet(wb, ws, "Buku Tamu");
    XLSX.writeFile(wb, `Data_Buku_Tamu_Admin_${new Date().toISOString().split('T')[0]}.xlsx`);
}
</script>
@endpush