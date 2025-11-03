@extends('layouts.app', ['title' => 'Data UMKM Desa'])

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
    .modal-lg { max-width: 90%; }
    .file-viewer { width: 100%; height: 80vh; border: none; border-radius: 6px; }
    .badge-custom { font-size: 0.75rem; padding: 0.35em 0.65em; }
    .table-img { width: 50px; height: 50px; object-fit: cover; border-radius: 6px; }
    .action-buttons { white-space: nowrap; }
    .rating-stars { display: inline-flex; align-items: center; }
    .rating-value { font-weight: 600; margin-right: 4px; }
    
    /* Control Bar */
    .control-bar {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .left-controls {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    .entries-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .right-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .search-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* PERUBAHAN: Styling untuk dropdown export */
    .export-dropdown {
        position: relative;
        display: inline-block;
    }

    .btn-export {
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
    }

    .btn-export:hover { 
        background: #15803d; 
    }

    .export-dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 180px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1000;
        border-radius: 8px;
        overflow: hidden;
        margin-top: 5px;
    }

    .export-dropdown-content a {
        color: #333;
        padding: 12px 16px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.2s;
        border-bottom: 1px solid #f0f0f0;
    }

    .export-dropdown-content a:last-child {
        border-bottom: none;
    }

    .export-dropdown-content a:hover {
        background-color: #f8f9fa;
    }

    .export-dropdown-content a i {
        width: 16px;
        text-align: center;
    }

    .export-dropdown:hover .export-dropdown-content {
        display: block;
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

    /* Responsive */
    @media (max-width: 576px) {
        .control-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .left-controls,
        .right-controls {
            width: 100%;
        }
        
        .search-container {
            width: 100%;
            flex-direction: column;
            gap: 8px;
        }
        
        .btn-export {
            width: 100%;
            justify-content: center;
        }

        .export-dropdown-content {
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 200px;
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

    @media (max-width: 768px) {
        .table-img { width: 40px; height: 40px; }
        .badge-custom { font-size: 0.7rem; }
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data UMKM Desa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row mb-4">
                {{-- 🔹 Statistik Ringkasan --}}
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-store"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Total UMKM</h4></div>
                            <div class="card-body">{{ $stats['total'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Ada Lokasi</h4></div>
                            <div class="card-body">{{ $stats['lokasi'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-star"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Rating Rata-rata</h4></div>
                            <div class="card-body">{{ $stats['rating'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info"><i class="fas fa-tags"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Kategori</h4></div>
                            <div class="card-body">{{ $stats['kategori'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card Tabel --}}
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            {{-- Notifikasi sukses --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Control Bar -->
                            <div class="control-bar">
                                <div class="left-controls">
                                    <a href="{{ route('belanja.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah UMKM
                                    </a>

                                    <!-- PERUBAHAN: Dropdown Export -->
                                    <div class="export-dropdown">
                                        <button class="btn-export">
                                            <i class="fas fa-download"></i> Export Data
                                            <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 4px;"></i>
                                        </button>
                                        <div class="export-dropdown-content">
                                            <a href="#" onclick="downloadExcel()">
                                                <i class="fas fa-file-excel" style="color: #16a34a;"></i>
                                                Export Excel
                                            </a>
                                            <a href="#" onclick="downloadPDF()">
                                                <i class="fas fa-file-pdf" style="color: #dc2626;"></i>
                                                Export PDF
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Entri Data -->
                                    <form method="GET" action="{{ route('belanja.index') }}" id="filter-form">
                                        <div class="entries-control">
                                            <label for="per_page" class="mb-0">Tampilkan</label>
                                            <select name="per_page" id="per_page" class="form-control form-control-sm" style="width: auto;" onchange="document.getElementById('filter-form').submit()">
                                                <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                            <span>entri</span>
                                        </div>
                                        <!-- Simpan parameter search -->
                                        @if(request('search'))
                                            <input type="hidden" name="search" value="{{ request('search') }}">
                                        @endif
                                    </form>
                                </div>

                                <!-- PERUBAHAN: Pencarian dengan reset di samping -->
                                <form method="GET" action="{{ route('belanja.index') }}" id="search-form">
                                    <div class="right-controls">
                                        <div class="search-container">
                                            <input type="search" name="search" id="search" class="form-control" placeholder="Cari UMKM..." value="{{ request('search') }}" style="min-width: 250px;">
                                            @if(request('search') || request('per_page'))
                                                <a href="{{ route('belanja.index') }}" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-times"></i> Reset
                                                </a>
                                            @endif
                                        </div>
                                        <!-- Simpan parameter per_page -->
                                        @if(request('per_page'))
                                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                                        @endif
                                    </div>
                                </form>
                            </div>

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-umkm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>UMKM</th>
                                            <th>Kategori</th>
                                            <th>Pemilik</th>
                                            <th>Harga</th>
                                            <th>Rating</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr>
                                                <td>{{ ($datas->currentPage() - 1) * $datas->perPage() + $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($data->foto)
                                                            <img src="{{ asset('storage/' . $data->foto) }}" 
                                                                 alt="{{ $data->judul }}" 
                                                                 class="table-img mr-3">
                                                        @else
                                                            <div class="table-img mr-3 bg-light d-flex align-items-center justify-content-center rounded">
                                                                <i class="fas fa-store text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0 font-weight-bold">{{ $data->judul }}</h6>
                                                            @if($data->wa)
                                                                <small class="text-muted">
                                                                    <i class="fab fa-whatsapp mr-1"></i>{{ $data->wa }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($data->kategori)
                                                        <span class="badge badge-custom badge-success">
                                                            {{ $data->kategori }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-custom badge-secondary">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $data->pemilik ?? '-' }}</td>
                                                <td>
                                                    <span class="font-weight-bold text-success">
                                                        Rp {{ number_format($data->harga, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="rating-stars">
                                                        @php
                                                            $rating = $data->averageRating();
                                                            $ratingCount = $data->ratingCount();
                                                        @endphp
                                                        @if($rating > 0)
                                                            <span class="rating-value text-warning font-weight-bold">
                                                                {{ number_format($rating, 1) }}
                                                            </span>
                                                            <div class="d-flex align-items-center">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= floor($rating))
                                                                        <i class="fas fa-star text-warning" style="font-size: 12px;"></i>
                                                                    @elseif($i - 0.5 <= $rating)
                                                                        <i class="fas fa-star-half-alt text-warning" style="font-size: 12px;"></i>
                                                                    @else
                                                                        <i class="far fa-star text-warning" style="font-size: 12px;"></i>
                                                                    @endif
                                                                @endfor
                                                                <small class="text-muted ml-1">
                                                                    ({{ $ratingCount }})
                                                                </small>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">Belum ada rating</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($data->latitude && $data->longitude)
                                                        <span class="badge badge-custom badge-success">
                                                            <i class="fas fa-check-circle mr-1"></i>Ada
                                                        </span>
                                                    @else
                                                        <span class="badge badge-custom badge-warning">
                                                            <i class="fas fa-exclamation-circle mr-1"></i>Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="action-buttons">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('belanja.usershow', $data->id) }}" 
                                                           class="btn btn-info btn-sm"
                                                           target="_blank"
                                                           data-toggle="tooltip"
                                                           title="Lihat di Website">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('belanja.edit', $data->id) }}" 
                                                           class="btn btn-warning btn-sm"
                                                           data-toggle="tooltip"
                                                           title="Edit Data">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('belanja.destroy', $data->id) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus UMKM {{ $data->judul }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-danger btn-sm"
                                                                    data-toggle="tooltip"
                                                                    title="Hapus Data">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if($datas->hasPages())
                            <div class="pagination-container">
                                <div class="pagination-info">
                                    Menampilkan {{ ($datas->currentPage() - 1) * $datas->perPage() + 1 }} 
                                    sampai {{ min($datas->currentPage() * $datas->perPage(), $datas->total()) }} 
                                    dari {{ $datas->total() }} entri
                                </div>
                                <div class="pagination-wrapper">
                                    {{ $datas->links() }}
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
@endsection

@push('scripts')
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<!-- Library untuk export Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<!-- Library untuk export PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
$(document).ready(function () {
    $('#table-umkm').DataTable({
        paging: false, // karena kita pakai Laravel pagination
        searching: false, // karena kita pakai custom search
        ordering: true,
        responsive: true,
        language: { 
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            search: "Cari:",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 hingga 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)"
        }
    });

    // Disable tombol delete setelah klik
    $('form').on('submit', function() {
        $(this).find('button[type=submit]').attr('disabled', true);
    });

    $('[data-toggle="tooltip"]').tooltip();

    // Fungsi untuk handling form
    const filterForm = document.getElementById('filter-form');
    const searchForm = document.getElementById('search-form');
    const perPageSelect = document.getElementById('per_page');
    const searchInput = document.getElementById('search');

    // Handle perubahan select box
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            filterForm.submit();
        });
    }

    // Pencarian otomatis tanpa tombol "Cari"
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchForm.submit();
            }, 500); // Submit setelah 500ms tidak mengetik
        });
    }
});

// Download Excel Function
function downloadExcel(){ 
    const wb = XLSX.utils.table_to_book(document.querySelector("#table-umkm")); 
    XLSX.writeFile(wb, "Data_UMKM_Desa_Manggalung.xlsx"); 
}

// Download PDF Function
function downloadPDF() {
    // Tampilkan loading
    const exportButton = document.querySelector('.btn-export');
    const originalButtonText = exportButton.innerHTML;
    exportButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuat PDF...';
    exportButton.disabled = true;

    try {
        // Buat elemen sementara untuk export
        const element = document.createElement('div');
        element.style.padding = '20px';
        
        // Header PDF
        const header = `
            <div style="text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px;">
                <h2 style="margin: 0; color: #333;">Data UMKM Desa Manggalung</h2>
                <p style="margin: 5px 0 0 0; color: #666;">Tanggal: ${new Date().toLocaleDateString('id-ID')}</p>
            </div>
        `;
        
        // Clone tabel tanpa kolom aksi
        const originalTable = document.querySelector('#table-umkm');
        const table = originalTable.cloneNode(true);
        
        // Hapus kolom aksi
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td, th');
            if (cells.length > 0) {
                // Hapus kolom terakhir (aksi)
                row.removeChild(cells[cells.length - 1]);
            }
        });

        // Style untuk tabel PDF
        table.style.width = '100%';
        table.style.borderCollapse = 'collapse';
        table.style.fontSize = '10px';
        table.style.fontFamily = 'Arial, sans-serif';
        
        const thCells = table.querySelectorAll('th');
        thCells.forEach(th => {
            th.style.backgroundColor = '#4f46e5';
            th.style.color = 'white';
            th.style.border = '1px solid #3730a3';
            th.style.padding = '8px';
            th.style.textAlign = 'center';
            th.style.fontWeight = 'bold';
        });
        
        const tdCells = table.querySelectorAll('td');
        tdCells.forEach(td => {
            td.style.border = '1px solid #e5e7eb';
            td.style.padding = '6px';
            td.style.verticalAlign = 'middle';
        });

        // Gabungkan konten
        element.innerHTML = header;
        element.appendChild(table);

        // Konfigurasi PDF
        const options = {
            margin: [10, 10, 10, 10],
            filename: 'Data_UMKM_Desa_Manggalung.pdf',
            image: { type: 'jpeg', quality: 0.8 },
            html2canvas: { 
                scale: 2,
                useCORS: true,
                logging: false
            },
            jsPDF: { 
                unit: 'mm', 
                format: 'a4', 
                orientation: 'portrait' 
            }
        };

        // Generate PDF
        html2pdf().set(options).from(element).save();

    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
    } finally {
        // Kembalikan tombol ke keadaan semula
        const exportButton = document.querySelector('.btn-export');
        exportButton.innerHTML = '<i class="fas fa-download"></i> Export Data <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 4px;"></i>';
        exportButton.disabled = false;
    }
}
</script>
@endpush