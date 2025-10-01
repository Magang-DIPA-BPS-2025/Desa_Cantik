@extends('layouts.app', ['title' => 'Data Penduduk'])

@section('content')
    @push('styles')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Penduduk</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('dataPenduduk.create') }}" class="btn btn-primary my-4">
                                    <i class="fas fa-plus"></i> Tambah Data Penduduk
                                </a>

                

                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-penduduk">
                                        <thead>
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
                                                <th>Action</th>
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
                                                    <td class="d-flex">
                                                        <a href="{{ route('dataPenduduk.edit', $penduduk->nik) }}"
                                                           class="btn btn-warning btn-sm mr-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('dataPenduduk.destroy', $penduduk->nik) }}"
                                                              method="POST"
                                                              onsubmit="return confirm('Yakin ingin hapus data ini?')">
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <!-- jQuery -->
        <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
        <!-- DataTables JS -->
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/dataTables.select.min.js') }}"></script>

        <script>
            $(document).ready(function () {
                var table = $('#table-penduduk').DataTable({
                    paging: true,
                    searching: true,    
                    ordering: true,
                    responsive: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/Indonesian.json'
                    }
                });

                $('#nikSearch').on('keyup', function () {
                    table.column(1).search(this.value).draw();
                });
            });
        </script>
    @endpush
@endsection
