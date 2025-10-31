@extends('layouts.app', ['title' => 'Pengaduan Desa'])

@section('content')
@push('styles')
<!-- DataTables + Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<style>
    #table-pengaduan tbody tr:hover { background-color: #f2f7fb; }

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
    .action-buttons .btn-danger { background-color: #FF4D4F; border: none; }
    .action-buttons .btn:hover { transform: scale(1.1); }

    /* Kolom ellipsis & expand on hover */
    td.deskripsi-col, td.alamat-col, td.judul-col {
        max-width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    td.deskripsi-col:hover,
    td.alamat-col:hover,
    td.judul-col:hover {
        white-space: normal;
        overflow: visible;
    }

    .pagination { justify-content: flex-end !important; }
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
                        <table class="table table-striped table-hover" id="table-pengaduan">
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
                                        <td class="action-buttons">
                                            <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini?')">
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

<!-- Buttons Export -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    $('#table-pengaduan').DataTable({
        paging: false, // tetap pakai pagination Laravel
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        scrollX: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json'
        },
        columnDefs: [
            { orderable: false, targets: -1 },
            { orderable: false, targets: -3 }
        ],
        dom:
            '<"d-flex justify-content-between align-items-center mb-2"l f>' +
            'rt'
    });
});
</script>
@endpush
@endsection
