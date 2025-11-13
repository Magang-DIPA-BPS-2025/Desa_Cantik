@extends('layouts.app', ['title' => 'Data Akun'])

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Data Akun</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- ALERT --}}
                        @if (session('message'))
                            @if (session('message') == 'store')
                                <div class="alert alert-success">Akun berhasil ditambahkan</div>
                            @elseif(session('message') == 'update')
                                <div class="alert alert-warning">Akun berhasil diperbarui</div>
                            @else
                                <div class="alert alert-danger">{{ session('message') }}</div>
                            @endif
                        @endif

                        {{-- Form Tambah Akun --}}
                        <form action="{{ route('akun.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input name="name" type="text" class="form-control" placeholder="Nama Akun" required>
                                </div>
                                <div class="col-md-4">
                                    <input name="username" type="text" class="form-control" placeholder="Username Login" required>
                                </div>
                                <div class="col-md-4">
                                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                                </div>
                                <input type="hidden" name="role" value="admin">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-plus"></i> Tambah Akun</button>
                        </form>

                        {{-- Table Akun --}}
                        <div class="table-responsive pt-4">
                            <table class="table table-striped" id="table-temp">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $i => $data)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>
                                            <a href="{{ route('akun.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('akun.destroy', $data->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus akun ini?')">
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
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#table-temp').DataTable();
});
</script>
@endpush
@endsection
