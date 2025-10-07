@extends('layouts.app', ['title' => 'Berita Desa'])

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Berita Desa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('berita.create') }}" class="btn btn-primary my-4">
                                <i class="fas fa-plus"></i> Tambah Berita
                            </a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-berita">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi Singkat</th>
                                            <th>Foto</th>
                                            <th>Dilihat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $berita)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $berita->judul }}</td>
                                                <td>{{ $berita->kategori->nama ?? '-' }}</td>
                                                <td>
                                                    {{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d F Y') : '-' }}
                                                </td>
                                                <td>{{ Str::limit($berita->deskripsi_singkat, 50) }}</td>
                                                <td>
                                                    @if($berita->foto)
                                                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" width="80">
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $berita->dilihat }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning btn-sm mr-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                                          onsubmit="return confirm('Yakin ingin hapus berita ini?')">
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
            $('#table-berita').DataTable({
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
