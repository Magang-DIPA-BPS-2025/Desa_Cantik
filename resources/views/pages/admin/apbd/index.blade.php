@extends('layouts.app', ['title' => 'Data APBD Desa'])

@section('content')
@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
    }
    .action-buttons .btn {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        border-radius: 6px;
    }

    /* Control bar layout */
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

    /* Responsive */
    @media (max-width: 991.98px) {
        .control-bar {
            flex-direction: column;
            align-items: stretch;
        }
        .search-container {
            width: 100%;
        }
    }
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data APBD Desa</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Control Bar -->
                    <div class="control-bar">
                        <div class="left-controls">
                            <a href="{{ route('apbd.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data APBD
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

                        <div class="search-container">
                            <input type="text" class="form-control" id="custom-search" placeholder="Cari data...">
                            <button class="clear-search" id="clear-search" type="button">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-apbd">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Total Pendapatan</th>
                                    <th>Total Belanja</th>
                                    <th>Surplus/Defisit</th>
                                    <th>PAD (%)</th>
                                    <th>Transfer (%)</th>
                                    <th>Lainnya (%)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($apbds as $index => $apbd)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $apbd->tahun }}</td>
                                        <td class="text-end">{{ number_format($apbd->total_pendapatan, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($apbd->total_belanja, 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            <span class="badge {{ $apbd->surplus_defisit >= 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ number_format($apbd->surplus_defisit, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $apbd->pendapatan_pad_persen }}%</td>
                                        <td class="text-center">{{ $apbd->pendapatan_transfer_persen }}%</td>
                                        <td class="text-center">{{ $apbd->pendapatan_lain_persen }}%</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('apbd.edit', $apbd->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('apbd.destroy', $apbd->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">Belum ada data APBD.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
