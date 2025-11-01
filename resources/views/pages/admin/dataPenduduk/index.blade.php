@extends('layouts.app', ['title' => 'Data Penduduk'])

@section('content')
@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    #table-penduduk tbody tr:hover { background-color: #f2f7fb; }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
    }
    .action-buttons .btn {
        width: 40px;
        height: 40px;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 6px;
        color: white;
        transition: transform 0.2s;
    }
    .action-buttons .btn-warning { background-color: #FFA500; border: none; }
    .action-buttons .btn-danger { background-color: #FF4D4F; border: none; }
    .action-buttons .btn:hover { transform: scale(1.1); }

    /* Pagination Laravel di kanan bawah */
    .pagination {
        justify-content: flex-end !important;
    }

    /* Styling untuk control bar */
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
    .entries-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Styling untuk search box */
    .search-container {
        position: relative;
        width: 300px;
    }
    .search-container .form-control {
        padding-right: 40px;
    }
    .clear-search {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        display: none;
    }
    .clear-search:hover {
        color: #333;
    }

    /* ===== RESPONSIVE STYLES ===== */
    /* Tablet */
    @media (max-width: 991.98px) {
        .control-bar {
            flex-direction: column;
            align-items: stretch;
        }
        .left-controls {
            order: 1;
        }
        .right-controls {
            order: 2;
            justify-content: flex-start;
            margin-top: 10px;
        }
        .search-container {
            width: 100%;
            max-width: 400px;
        }
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .entries-control {
            flex-wrap: wrap;
        }
        .table-responsive {
            font-size: 14px;
        }
        .search-container {
            max-width: 100%;
        }
    }

    /* Small Mobile */
    @media (max-width: 575.98px) {
        .left-controls {
            gap: 8px;
        }
        .entries-control {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
        #entries-select {
            width: 100px !important;
        }
        .action-buttons {
            flex-direction: column;
            gap: 3px;
        }
        .action-buttons .btn {
            width: 35px;
            height: 35px;
            font-size: 14px;
        }
        .table-responsive {
            font-size: 13px;
        }
    }

    /* Extra Small Mobile */
    @media (max-width: 400px) {
        .search-container {
            width: 100%;
        }
        .btn {
            font-size: 14px;
            padding: 8px 12px;
        }
        .entries-control label,
        .entries-control span {
            font-size: 14px;
        }
    }
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Penduduk</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Control Bar: 3 Fitur Vertikal di Kiri, Pencarian di Kanan -->
                    <div class="control-bar">
                        <!-- Kiri: 3 Fitur Vertikal (Tambah Data, Export Excel, Entri) -->
                        <div class="left-controls">
                            <!-- Tambah Data -->
                            <a href="{{ route('dataPenduduk.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data Penduduk
                            </a>

                            <!-- Export Excel -->
                            <button class="btn btn-success" id="export-excel-btn">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>

                            <!-- Entri Data -->
                            <div class="entries-control">
                                <label for="entries-select" class="mb-0">Tampilkan</label>
                                <select id="entries-select" class="form-control form-control-sm" style="width: auto;">
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <span>entri</span>
                            </div>
                        </div>

                        <!-- Kanan: Pencarian sejajar dengan Entri Data -->
                        <div class="right-controls">
                            <div class="search-container">
                                <input type="text" class="form-control" id="custom-search"
                                       placeholder="Cari data...">
                                <button class="clear-search" id="clear-search" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-penduduk">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>No KK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Dusun</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Kel/Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Agama</th>
                                    <th>Status Perkawinan</th>
                                    <th>Pekerjaan</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Pendidikan</th>
                                    <th>Disabilitas</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $index => $penduduk)
                                    <tr>
                                        <td>{{ $datas->firstItem() + $index }}</td>
                                        <td>{{ $penduduk->nik }}</td>
                                        <td>{{ $penduduk->nokk }}</td>
                                        <td>{{ $penduduk->nama }}</td>
                                        <td>{{ $penduduk->jenis_kelamin }}</td>
                                        <td>{{ $penduduk->tempat_lahir }}</td>
                                        <td>{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
                                        <td>{{ $penduduk->alamat }}</td>
                                        <td>{{ $penduduk->dusun }}</td>
                                        <td>{{ $penduduk->rt }}</td>
                                        <td>{{ $penduduk->rw }}</td>
                                        <td>{{ $penduduk->keldesa }}</td>
                                        <td>{{ $penduduk->kecamatan }}</td>
                                        <td>{{ $penduduk->agama }}</td>
                                        <td>{{ $penduduk->status_perkawinan }}</td>
                                        <td>{{ $penduduk->pekerjaan }}</td>
                                        <td>{{ $penduduk->kewarganegaraan }}</td>
                                        <td>{{ $penduduk->pendidikan }}</td>
                                        <td>{{ $penduduk->disabilitas }}</td>
                                        <td>{{ $penduduk->tahun }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('dataPenduduk.edit', $penduduk->nik) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dataPenduduk.destroy', $penduduk->nik) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination dan Info --}}
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Menampilkan {{ $datas->firstItem() ?? 0 }} hingga {{ $datas->lastItem() ?? 0 }} dari {{ $datas->total() }} entri
                        </div>
                        <div>
                            {{ $datas->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<!-- Script Sidebar Responsif -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const toggle = document.querySelector('.nav-link.toggle-sidebar');

    // 🔒 Kunci toggle sidebar di desktop
    function handleSidebarMode() {
        if (window.innerWidth > 991) {
            // Sidebar selalu terbuka
            body.classList.add('sidebar-mini');
            // Nonaktifkan tombol toggle (tidak bisa diklik)
            if (toggle) toggle.style.pointerEvents = 'none';
        } else {
            // Aktifkan toggle di HP
            if (toggle) toggle.style.pointerEvents = 'auto';
        }
    }

    handleSidebarMode();
    window.addEventListener('resize', handleSidebarMode);

    // 📱 Tutup sidebar otomatis di HP ketika klik di luar
    document.addEventListener('click', function(e) {
        const sidebar = document.querySelector('.main-sidebar');
        if (!sidebar || !toggle) return;

        if (window.innerWidth <= 991) {
            if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                body.classList.remove('sidebar-show');
            }
        }
    });
});
</script>
@endpush

@endsection
