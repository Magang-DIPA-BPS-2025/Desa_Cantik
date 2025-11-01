@extends('layouts.app', ['title' => 'Agenda Desa'])

@section('content')
@push('styles')
    <!-- DataTables + Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

    <style>
        #table-agenda tbody tr:hover { background-color: #f2f7fb; }

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
        }
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

        .foto-agenda {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
    </style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Agenda Desa</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Control Bar -->
                    <div class="control-bar">
                        <div class="left-controls">
                            <a href="{{ route('AgendaDesa.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Agenda
                            </a>

                            <button class="btn btn-success" id="export-excel-btn">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>

                            <div class="entries-control">
                                <label for="entries-select" class="mb-0">Tampilkan</label>
                                <select id="entries-select" class="form-control form-control-sm" style="width: auto;">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span>entri</span>
                            </div>
                        </div>

                        <div class="right-controls">
                            <div class="search-container">
                                <input type="text" class="form-control" id="custom-search" placeholder="Cari agenda...">
                                <button class="clear-search" id="clear-search" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-agenda">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Waktu Pelaksanaan</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $index => $agenda)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($agenda->foto)
                                                <img src="{{ asset('storage/' . $agenda->foto) }}" class="foto-agenda" alt="Foto">
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td>{{ $agenda->nama_kegiatan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->format('d-m-Y H:i') }}</td>
                                        <td>{{ $agenda->deskripsi }}</td>
                                        <td>{{ $agenda->kategori }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('AgendaDesa.edit', $agenda->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('AgendaDesa.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus agenda ini?')">
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

                </div>
            </div>
        </div>
    </section>
</div>

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
@endsection
