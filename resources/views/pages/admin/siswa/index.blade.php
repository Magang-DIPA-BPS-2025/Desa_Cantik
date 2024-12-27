@extends('layouts.app', ['title' => 'Data Siswa'])

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Siswa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('siswa.create') }}" class="btn btn-primary my-4">
                                <i class="fas fa-plus"></i> Tambah Data Siswa
                            </a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-siswa">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>
                                            <th>Kelas</th>
                                            <th>Wali Kelas</th>
                                            <th>Gender</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Wali</th>
                                            <th>No. Hp Wali</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $siswa)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $siswa->nama }}</td>
                                                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                                                <td>{{ $siswa->tgl_lahir }}</td>
                                                <td>{{ $siswa->alamat }}</td>
                                                <td>{{ $siswa->wali }}</td>
                                                <td>
                                                    <a href="{{ route('siswa.edit', $siswa->id) }}"
                                                        class="btn btn-warning my-2">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button onclick="deleteData({{ $siswa->id }}, 'siswa')"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Hapus
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
            $('#table-siswa').DataTable();
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
    </script>
@endpush
@endsection
