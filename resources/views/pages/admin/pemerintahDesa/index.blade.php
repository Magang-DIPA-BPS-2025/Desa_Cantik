@extends('layouts.app', ['title' => 'Pemerintah Desa'])

@section('content')
    @push('styles')
        <!-- DataTables + Buttons -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

        <style>
            #table-pemerintah-desa tbody tr:hover { background-color: #f2f7fb; }

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

            /* Pagination di kanan bawah */
            .pagination { justify-content: flex-end !important; }

            /* Control bar */
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

            /* Search box */
            .search-container {
                position: relative;
                width: 300px;
            }
            .search-container .form-control { padding-right: 40px; }
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
            .clear-search:hover { color: #333; }

            /* Foto */
            .img-thumbnail {
                border-radius: 8px;
                object-fit: cover;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pemerintah Desa</h1>
            </div>

            <div class="section-body">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <!-- Control Bar -->
                        <div class="control-bar">
                            <div class="left-controls">
                                <a href="{{ route('pemerintah-desa.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data Pemerintah Desa
                                </a>

                                <button class="btn btn-success" id="export-excel-btn">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>

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

                            <div class="right-controls">
                                <div class="search-container">
                                    <input type="text" class="form-control" id="custom-search" placeholder="Cari data...">
                                    <button class="clear-search" id="clear-search" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-pemerintah-desa">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Tupoksi</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $index => $desa)
                                        <tr>
                                            <td>{{ $datas->firstItem() + $index }}</td>
                                            <td>{{ $desa->nama }}</td>
                                            <td>{{ $desa->jabatan }}</td>
                                            <td>{{ Str::limit($desa->tupoksi, 50) }}</td>
                                            <td>
                                                @if($desa->foto)
                                                    <img src="{{ asset('storage/' . $desa->foto) }}"
                                                         alt="{{ $desa->nama }}"
                                                         width="60" height="60"
                                                         class="img-thumbnail">
                                                @else
                                                    <span class="text-muted">Belum ada foto</span>
                                                @endif
                                            </td>
                                            <td class="action-buttons">
                                                <a href="{{ route('pemerintah-desa.edit', $desa->id) }}"
                                                   class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pemerintah-desa.destroy', $desa->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin hapus data ini?')">
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
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const toggle = document.querySelector('.nav-link.toggle-sidebar');

    // 🔒 Kunci sidebar di desktop (tidak bisa buka/tutup)
    function handleSidebarMode() {
        if (window.innerWidth > 991) {
            // Pastikan sidebar selalu terbuka
            body.classList.add('sidebar-mini');
            // Nonaktifkan tombol toggle
            if (toggle) toggle.style.pointerEvents = 'none';
        } else {
            // Aktifkan toggle lagi di HP
            if (toggle) toggle.style.pointerEvents = 'auto';
        }
    }

    handleSidebarMode();
    window.addEventListener('resize', handleSidebarMode);

    // 📱 Tutup sidebar otomatis ketika klik di luar area di HP
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

