@extends('layouts.app', ['title' => 'Kalender Desa'])

@section('content')
@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    #table-kalender tbody tr:hover { background-color: #f2f7fb; }

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
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kalender Desa</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <a href="{{ route('kalenderDesa.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i> Tambah Kegiatan
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-kalender">
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
                                @foreach ($kalenders as $index => $kalender)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kalender->nama_kegiatan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($kalender->tanggal_kegiatan)->format('d M Y') }}</td>
                                        <td>{{ $kalender->created_at ? $kalender->created_at->format('d M Y') : '-' }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('kalender.edit', $kalender->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('kalender.destroy', $kalender->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus kegiatan ini?')">
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
<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- Buttons Export -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    $('#table-kalender').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json'
        },
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        dom:
            '<"d-flex justify-content-between align-items-center mb-2"Bf>' + 
            'rt<"d-flex justify-content-between mt-3"ip>',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                className: 'btn btn-success btn-sm'
            }
        ]
    });
});
</script>
@endpush
@endsection
