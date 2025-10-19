@extends('layouts.app', ['title' => 'Data Buku Tamu '])

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
    @media (max-width: 768px) {
        .badge-custom { font-size: 0.7rem; }
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Buku Tamu Desa </h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4>Daftar Buku Tamu</h4>
                            <div class="card-header-action">
                            </div>
                        </div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-striped" id="table-bukutamu">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Asal Instansi</th>
                                            <th>Nomor HP</th>
                                            <th>Keperluan</th>
                                            <th>Tanggal (WITA)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bukutamus as $tamu)
                                            <tr>
                                                <td>{{ $tamu->id }}</td>
                                                <td>{{ $tamu->nama }}</td>
                                                <td>{{ $tamu->asal }}</td>
                                                <td>{{ $tamu->nomor_hp ?? '-' }}</td>
                                                <td>{{ $tamu->keperluan }}</td>
                                                <td>{{ $tamu->created_at->timezone('Asia/Makassar')->format('Y-m-d H:i:s') }}</td>
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
                                                <td colspan="7" class="text-center text-muted">
                                                    Belum ada data buku tamu.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3 d-flex justify-content-end">
                                {{ $bukutamus->links('pagination::bootstrap-4') }}
                            </div>

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
<script>
$(document).ready(function () {
    $('#table-bukutamu').DataTable({
        paging: false,
        searching: true,
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

    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush