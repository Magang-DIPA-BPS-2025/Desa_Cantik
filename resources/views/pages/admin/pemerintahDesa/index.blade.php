@extends('layouts.app', ['title' => 'Pemerintah Desa'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pemerintah Desa</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('pemerintah-desa.create') }}" class="btn btn-primary my-4">
                                    <i class="fas fa-plus"></i> Tambah Data Pemerintah Desa
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-pemerintah-desa">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Tupoksi</th>
                                                <th>Foto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $index => $desa)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $desa->nama }}</td>
                                                    <td>{{ $desa->jabatan }}</td>
                                                    <td>{{ $desa->tupoksi }}</td>
                                                    <td>
                                                        @if($desa->foto)
                                                            <img src="{{ asset('storage/' . $desa->foto) }}"
                                                                 alt="{{ $desa->nama }}"
                                                                 width="60"
                                                                 class="img-thumbnail">
                                                        @else
                                                            <span class="text-muted">Belum ada foto</span>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('pemerintah-desa.edit', $desa->id) }}"
                                                           class="btn btn-warning btn-sm mr-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('pemerintah-desa.destroy', $desa->id) }}"
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
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#table-pemerintah-desa').DataTable({
                    paging: true,
                    searching: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                });
            });
        </script>
    @endpush
@endsection
