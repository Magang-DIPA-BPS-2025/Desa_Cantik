@extends('layouts.app', ['title' => 'Data Agenda Desa'])

@section('content')
@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    .foto-agenda {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
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
        margin: 2px;
    }
    .action-buttons .btn-warning { background-color: #FFA500; border: none; }
    .action-buttons .btn-danger { background-color: #FF4D4F; border: none; }
    .action-buttons .btn:hover { transform: scale(1.1); }

    /* Hapus search bawaan DataTables */
    .dataTables_filter { display: none !important; }

    /* Control Bar */
    .control-bar {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .left-controls { display: flex; flex-direction: column; gap: 10px; }
    .right-controls { display: flex; align-items: center; }
    .search-container { position: relative; width: 300px; }
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

                    <!-- Tabel Agenda -->
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
                                @foreach ($datas as $i => $agenda)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($agenda->foto)
                                                <img src="{{ asset('storage/' . $agenda->foto) }}" class="foto-agenda" alt="Foto Agenda">
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
                                            <form action="{{ route('AgendaDesa.destroy', $agenda->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin hapus agenda ini?')">
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
    let table = $('#table-agenda').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel"></i> Export Excel',
            className: 'd-none',
            title: 'Data Agenda Desa',
            exportOptions: { 
                columns: [0,2,3,4,5],
                format: {
                    body: function (data, row, column, node) {
                        return $(data).text() || data;
                    }
                }
            }
        }],
        language: { url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json' },
        pageLength: 10,
        columnDefs: [
            { targets: 0, orderable: false, searchable: false },
            { targets: 1, orderable: false, searchable: false },
            { targets: 6, orderable: false, searchable: false }
        ]
    });

    // Search custom
    $('#custom-search').on('keyup', function() {
        table.search(this.value).draw();
        $('#clear-search').toggle(this.value.length > 0);
    });
    $('#clear-search').on('click', function() {
        $('#custom-search').val('');
        table.search('').draw();
        $(this).hide();
    });

    // Export Excel
    $('#export-excel-btn').on('click', function() {
        table.button('.buttons-excel').trigger();
    });
});
</script>
@endpush
@endsection
