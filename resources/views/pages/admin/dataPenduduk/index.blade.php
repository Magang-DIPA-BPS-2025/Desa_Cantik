@extends('layouts.app', ['title' => 'Data Penduduk'])

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<style>
    #table-penduduk tbody tr:hover {
        background-color: #f2f7fb;
    }
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
    .table-responsive { overflow-x: auto; }
</style>
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Penduduk</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <!-- Tombol tambah -->
                            <a href="{{ route('dataPenduduk.create') }}" class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i> Tambah Data Penduduk
                            </a>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-penduduk">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>No KK</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Dusun</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Kel/Desa</th>
                                            <th>Kecamatan</th>
                                            <th>Agama</th>
                                            <th>Status Perkawinan</th>
                                            <th>Pekerjaan</th>
                                            <th>Kewarganegaraan</th>
                                            <th>Pendidikan</th>
                                            <th>Disabilitas</th>
                                            <th>Tahun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $penduduk)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $penduduk->nik }}</td>
                                                <td>{{ $penduduk->nokk }}</td>
                                                <td>{{ $penduduk->nama }}</td>
                                                <td>{{ $penduduk->jenis_kelamin }}</td>
                                                <td>{{ $penduduk->tempat_lahir }}</td>
                                                <td>{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') }}</td>
                                                <td>{{ $penduduk->alamat }}</td>
                                                <td>{{ $penduduk->dusun }}</td>
                                                <td>{{ $penduduk->rt }}</td>
                                                <td>{{ $penduduk->rw }}</td>
                                                <td>{{ $penduduk->keldesa }}</td>
                                                <td>{{ $penduduk->kecamatan }}</td>
                                                <td>{{ $penduduk->agama }}</td>
                                                <td>{{ $penduduk->status_perkawinan }}</td>
                                                <td>{{ $penduduk->pekerjaan }}</td>
                                                <td>{{ $penduduk->kewarganegaraan }}</td>
                                                <td>{{ $penduduk->pendidikan }}</td>
                                                <td>{{ $penduduk->disabilitas }}</td>
                                                <td>{{ $penduduk->tahun }}</td>
                                                <td class="action-buttons">
                                                    <a href="{{ route('dataPenduduk.edit', $penduduk->nik) }}" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('dataPenduduk.destroy', $penduduk->nik) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">
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
            </div>
        </div>
    </section>
</div>

@push('scripts')
<!-- JANGAN load jQuery lagi kalau sudah ada di layouts.app -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script>
$(function () {
    $('#table-penduduk').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/Indonesian.json'
        },
        columnDefs: [
            { orderable: false, targets: -1 }
        ],
        // tombol export di kiri, search di kanan
        dom: '<"row mb-2"<"col-md-6 text-left"B><"col-md-6 text-right"f>>rtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Cetak Excel',
                className: 'btn btn-success btn-sm'
            }
        ]
    });
});
</script>
@endpush
@endsection
