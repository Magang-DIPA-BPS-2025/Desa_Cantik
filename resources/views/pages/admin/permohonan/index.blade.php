@extends('layouts.app', ['title' => 'Permohonan Informasi'])

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    table th, table td {
        vertical-align: middle !important;
        text-align: center;
    }

    .status-select {
        min-width: 130px;
        border-radius: 6px;
    }

    .btn-sm i {
        margin-right: 4px;
    }

    .table thead th {
        background-color: #1abc9c;
        color: white;
    }

    .alert-success {
        border-radius: 8px;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 6px;
        padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        padding: 4px;
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>📄 Daftar Permohonan Informasi</h1>
        </div>

        <div class="section-body">
            <div class="card shadow">
                <div class="card-body">
                    {{-- Notifikasi sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Tabel daftar permohonan --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="table-permohonan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Telepon</th>
                                    <th>Instansi</th>
                                    <th>Email</th>
                                    <th>Isi Permohonan</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permohonans as $key => $permohonan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $permohonan->nama }}</td>
                                    <td>{{ $permohonan->nomor_telepon }}</td>
                                    <td>{{ $permohonan->asal_instansi ?? '-' }}</td>
                                    <td>{{ $permohonan->alamat_email }}</td>
                                    <td class="text-left">{{ Str::limit($permohonan->permohonan, 80) }}</td>
                                    <td>
                                        @if ($permohonan->file_path)
                                            <a href="{{ asset('storage/' . $permohonan->file_path) }}" 
                                               target="_blank" 
                                               class="btn btn-outline-primary btn-sm">
                                               <i class="fas fa-file-alt"></i> Lihat
                                            </a>
                                        @else
                                            <span class="badge badge-light text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('permohonan.updateStatus', $permohonan->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" 
                                                    class="form-control form-control-sm status-select"
                                                    onchange="this.form.submit()">
                                                <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('permohonan.edit', $permohonan->id) }}" 
                                               class="btn btn-warning btn-sm mr-1">
                                               <i class="fas fa-edit"></i>Edit
                                            </a>
                                            <form action="{{ route('permohonan.destroy', $permohonan->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Belum ada data permohonan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination (jika pakai paginate di controller) --}}
                    <div class="mt-3">
                        {{ $permohonans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#table-permohonan').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Tidak ada data ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari total _MAX_ data)"
            },
            "pageLength": 10
        });
    });
</script>
@endpush
