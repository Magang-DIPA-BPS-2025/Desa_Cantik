@extends('layouts.app', ['title' => 'Kalender Desa'])

@section('content')
@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    #table-kegiatan tbody tr:hover { background-color: #f2f7fb; }

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

    .pagination { justify-content: flex-end !important; }

    /* === Control Bar === */
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

    /* === RESPONSIVE === */
    @media (max-width: 991.98px) {
        .control-bar { flex-direction: column; align-items: stretch; }
        .left-controls { order: 1; }
        .right-controls { order: 2; justify-content: flex-start; margin-top: 10px; }
        .search-container { width: 100%; max-width: 400px; }
    }
    @media (max-width: 767.98px) {
        .table-responsive { font-size: 14px; }
        .search-container { max-width: 100%; }
    }
    @media (max-width: 575.98px) {
        .action-buttons { flex-direction: column; gap: 3px; }
        .action-buttons .btn { width: 35px; height: 35px; font-size: 14px; }
        .table-responsive { font-size: 13px; }
    }

    /* Hilangkan search default DataTables */
    .dataTables_filter { display: none !important; }
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kalender Desa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Kalender Desa</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!-- Control Bar -->
                    <div class="control-bar">
                        <div class="left-controls">
                            <a href="{{ route('kalenderDesa.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Kegiatan
                            </a>

                            <button class="btn btn-success" id="export-excel-btn">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>

                            <div class="entries-control">
                                <label for="entries-select" class="mb-0">Tampilkan</label>
                                <select id="entries-select" class="form-control form-control-sm" style="width:auto;">
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
                                <input type="text" class="form-control" id="custom-search" placeholder="Cari kegiatan...">
                                <button class="clear-search" id="clear-search" type="button">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-kegiatan">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Dibuat Pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $index => $kegiatan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $kegiatan->created_at ? $kegiatan->created_at->translatedFormat('d F Y H:i') : '-' }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('kalender.edit', $kegiatan->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('kalender.destroy', $kegiatan->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin hapus kegiatan ini?')">
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
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    let table = $('#table-kegiatan').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel"></i> Export Excel',
            className: 'd-none',
            title: 'Data Kegiatan Desa',
            exportOptions: { columns: [0, 1, 2, 3] }
        }],
        language: { url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json' },
        pageLength: 10
    });

    // 🔍 Custom search
    $('#custom-search').on('keyup', function() {
        table.search(this.value).draw();
        $('#clear-search').toggle(this.value.length > 0);
    });

    $('#clear-search').on('click', function() {
        $('#custom-search').val('');
        table.search('').draw();
        $(this).hide();
    });

    // 🔢 Entries control
    $('#entries-select').on('change', function() {
        table.page.len($(this).val()).draw();
    });

    // 📤 Export Excel
    $('#export-excel-btn').on('click', function() {
        table.button('.buttons-excel').trigger();
    });
});
</script>
@endpush
@endsection
