@extends('layouts.app', ['title' => 'Pengaduan Desa'])

@section('content')
@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<style>
    table td, table th {
        white-space: normal !important;
        word-wrap: break-word;
        vertical-align: middle;
    }

    .dataTables_length,
    .dataTables_filter {
        margin-bottom: 15px;
    }

    td.deskripsi-col, td.alamat-col {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    td.judul-col {
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Hover tampilkan full */
    td.deskripsi-col:hover,
    td.alamat-col:hover,
    td.judul-col:hover {
        white-space: normal;
        overflow: visible;
    }

    /* Tabel responsif */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .pagination {
        justify-content: flex-end !important;
    }
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Pengaduan Desa</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered display nowrap" id="table-pengaduan" style="width: 100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th class="alamat-col">Alamat</th>
                                    <th class="judul-col">Judul</th>
                                    <th class="deskripsi-col">Deskripsi</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $index => $pengaduan)
                                    <tr>
                                        <td>{{ $datas->firstItem() + $index }}</td>
                                        <td>{{ $pengaduan->nama }}</td>
                                        <td>{{ $pengaduan->email }}</td>
                                        <td>{{ $pengaduan->telepon }}</td>
                                        <td class="alamat-col" title="{{ $pengaduan->alamat }}">{{ $pengaduan->alamat }}</td>
                                        <td class="judul-col" title="{{ $pengaduan->judul }}">{{ $pengaduan->judul }}</td>
                                        <td class="deskripsi-col" title="{{ $pengaduan->deskripsi }}">{{ $pengaduan->deskripsi }}</td>
                                        <td>
                                            @if($pengaduan->file)
                                                <a href="{{ asset('storage/' . $pengaduan->file) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="baru" {{ $pengaduan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                    <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin hapus pengaduan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $datas->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    $('#table-pengaduan').DataTable({
        paging: false,       // tetap pakai pagination laravel
        searching: true,
        ordering: true,
        scrollX: true,
        info: false,
        autoWidth: false,
        lengthMenu: [10, 25, 50, 100],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            lengthMenu: "Tampilkan _MENU_ entri"
        },
        columnDefs: [
            { orderable: false, targets: -1 },
            { orderable: false, targets: -3 }
        ],
        dom:
            '<"row mb-3"' +
                '<"col-md-6 d-flex align-items-center"l>' +
                '<"col-md-6 d-flex justify-content-end"f>' +
            '>' +
            'rt'
    });
});
</script>
@endpush
@endsection
