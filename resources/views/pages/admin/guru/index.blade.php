@extends('layouts.app', ['title' => 'Data Guru RPPH'])

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Guru RPPH</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('guru.create') }}" class="btn btn-primary my-4">
                                <i class="fas fa-plus"></i> Tambah Data Guru RPPH
                            </a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-guru">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIP</th>
                                            <th>Gender</th>
                                            <th>Nomor KTP</th>
                                            <th>Agama</th>
                                            <th>No. HP</th>
                                            <th>Pas Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $guru)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $guru->nama_lengkap }}</td>
                                                <td>{{ $guru->nip }}</td>
                                                <td>{{ $guru->gender }}</td>
                                                <td>{{ $guru->no_ktp }}</td>
                                                <td>{{ $guru->agama }}</td>
                                                <td>{{ $guru->no_hp }}</td>
                                                <td>
                                                    <img class="img img-fluid" width="200"
                                                        src="{{ asset('upload/pas_foto/' . $guru->pas_foto) }}"
                                                        alt="Pas Foto Guru">
                                                    
                                                </td>
                                                <td>
                                                    @if (session('role') == 'admin' || session('role') == 'superadmin')
                                                        @if ($guru->is_verif != 'sudah')
                                                            <button class="btn btn-primary mb-2"
                                                                onclick="verifikasi({{ $guru->id }}, 'guru')">
                                                                Verifikasi
                                                            </button>
                                                        @endif
                                                    @endif
                                                    <a href="{{ route('guru.edit', $guru->id) }}"
                                                        class="btn btn-warning my-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="deleteData({{ $guru->id }}, 'guru')"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
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
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-guru').DataTable();
        });

        function deleteData(id, endpoint) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: `/${endpoint}/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert('Data berhasil dihapus.');
                        location.reload();
                    },
                    error: function (error) {
                        alert('Terjadi kesalahan saat menghapus data.');
                    }
                });
            }
        }

        function verifikasi(id, endpoint) {
            if (confirm('Apakah Anda yakin ingin memverifikasi data ini?')) {
                $.ajax({
                    url: `/${endpoint}/verifikasi/${id}`,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert('Data berhasil diverifikasi.');
                        location.reload();
                    },
                    error: function (error) {
                        alert('Terjadi kesalahan saat memverifikasi data.');
                    }
                });
            }
        }
    </script>
@endpush
@endsection