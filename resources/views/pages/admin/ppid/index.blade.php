@extends('layouts.app', ['title' => 'Data PPID Desa'])

@push('styles')
<style>
    /* Tambahan agar modal lebih responsif */
    .modal-lg {
        max-width: 90%;
    }
    .file-viewer {
        width: 100%;
        height: 80vh;
        border: none;
        border-radius: 6px;
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
    }

    .btn-download-excel:hover { 
        background: #15803d; 
        color: #fff;
        text-decoration: none;
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

    .right-controls {
        display: flex;
        align-items: center;
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

    /* Responsive */
    @media (max-width: 576px) {
        .control-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .left-controls {
            align-items: stretch;
        }
        
        .btn-download-excel {
            width: 100%;
            justify-content: center;
        }
        
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
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data PPID Desa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            {{-- Control Bar --}}
                            <div class="control-bar">
                                <div class="left-controls">
                                    <a href="{{ route('ppid.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Tambah PPID
                                    </a>

                                    {{-- Tombol Download Excel --}}
                                    <button class="btn-download-excel" onclick="downloadExcel()">
                                        <i class="fas fa-file-excel"></i> Download Excel
                                    </button>
                                </div>
                            </div>

                            {{-- Controls (Entri dan Pencarian) --}}
                            <form method="GET" action="{{ route('ppid.index') }}" id="filter-form">
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
                                        <input type="search" name="search" id="search" class="form-control form-control-sm" placeholder="Cari..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Cari</button>
                                        @if(request('search') || request('per_page'))
                                            <a href="{{ route('ppid.index') }}" class="btn btn-sm btn-outline-secondary ml-2">Reset</a>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            {{-- Notifikasi sukses --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($ppids as $index => $ppid)
                                            <tr>
                                                <td>{{ ($ppids->currentPage() - 1) * $ppids->perPage() + $loop->iteration }}</td>
                                                <td>{{ $ppid->judul }}</td>
                                                <td>{{ Str::limit($ppid->deskripsi, 80) }}</td>
                                                <td>{{ $ppid->tanggal ? \Carbon\Carbon::parse($ppid->tanggal)->format('d-m-Y') : '-' }}</td>
                                                <td>
                                                    @if ($ppid->file)
                                                        <button type="button"
                                                            class="btn btn-info btn-sm btn-view-file"
                                                            data-file="{{ asset('storage/' . $ppid->file) }}">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('ppid.edit', $ppid->id) }}" class="btn btn-warning btn-sm mr-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('ppid.destroy', $ppid->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">Belum ada data PPID.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if($ppids->hasPages())
                            <div class="pagination-container">
                                <div class="pagination-info">
                                    Menampilkan {{ ($ppids->currentPage() - 1) * $ppids->perPage() + 1 }} 
                                    sampai {{ min($ppids->currentPage() * $ppids->perPage(), $ppids->total()) }} 
                                    dari {{ $ppids->total() }} entri
                                </div>
                                <div class="pagination-wrapper">
                                    {{ $ppids->links() }}
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

{{-- Modal Preview File --}}
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="fileModalLabel">Preview File</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <iframe id="fileViewer" class="file-viewer"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Library untuk export Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
    // Download Excel Function
    function downloadExcel(){ 
        // Buat tabel sementara tanpa kolom aksi untuk Excel
        const originalTable = document.querySelector('table');
        const table = originalTable.cloneNode(true);
        
        // Hapus kolom aksi (kolom terakhir) dari Excel
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td, th');
            if (cells.length > 0) {
                // Hapus kolom terakhir (aksi)
                row.removeChild(cells[cells.length - 1]);
            }
        });

        // Hapus tombol "Lihat" dan ganti dengan teks
        const fileCells = table.querySelectorAll('td:nth-child(5)');
        fileCells.forEach(cell => {
            const button = cell.querySelector('button');
            if (button) {
                cell.innerHTML = '<span style="color: #666;">Ada File</span>';
            } else {
                cell.innerHTML = '<span style="color: #999;">Tidak Ada File</span>';
            }
        });

        const wb = XLSX.utils.table_to_book(table); 
        XLSX.writeFile(wb, "Data_PPID_Desa_Manggalung.xlsx"); 
    }

    $(document).ready(function () {
        // Event klik tombol "Lihat"
        $('.btn-view-file').on('click', function() {
            const fileUrl = $(this).data('file');
            const fileViewer = $('#fileViewer');

            // Deteksi jenis file dan tampilkan di iframe
            const fileExtension = fileUrl.split('.').pop().toLowerCase();
            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                fileViewer.attr('src', fileUrl);
            } else if (fileExtension === 'pdf') {
                fileViewer.attr('src', fileUrl + '#toolbar=0');
            } else {
                fileViewer.attr('src', 'https://docs.google.com/gview?embedded=true&url=' + encodeURIComponent(fileUrl));
            }

            // Tampilkan modal
            $('#fileModal').modal('show');
        });

        // Bersihkan iframe saat modal ditutup
        $('#fileModal').on('hidden.bs.modal', function () {
            $('#fileViewer').attr('src', '');
        });

        // Fungsi untuk handling form
        const filterForm = document.getElementById('filter-form');
        const perPageSelect = document.getElementById('per_page');
        const searchInput = document.getElementById('search');

        // Handle perubahan select box
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                filterForm.submit();
            });
        }

        // Handle pencarian dengan enter
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    filterForm.submit();
                }
            });
        }
    });
</script>
@endpush
@endsection