@extends('layouts.app', ['title' => 'Data UMKM Desa'])

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data UMKM Desa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('belanja.create') }}" class="btn btn-primary my-4">
                                <i class="fas fa-plus"></i> Tambah UMKM
                            </a>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-belanja">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Judul</th>
                                            <th>Harga</th>
                                            <th>Rating</th>
                                            <th>WhatsApp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $belanja)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if($belanja->foto)
                                                        <img src="{{ asset('storage/' . $belanja->foto) }}" alt="Foto Produk" width="80" class="rounded">
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $belanja->judul }}</td>
                                                <td>Rp{{ number_format($belanja->harga, 0, ',', '.') }}</td>
                                                <td>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $belanja->rating)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                </td>
                                                <td>
                                                    @if($belanja->wa)
                                                        <a href="https://wa.me/{{ $belanja->wa }}" target="_blank" class="btn btn-success btn-sm">
                                                            <i class="fab fa-whatsapp"></i> Chat
                                                        </a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('belanja.edit', $belanja->id) }}" class="btn btn-warning btn-sm mr-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('belanja.destroy', $belanja->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">
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

                            {{-- Pagination --}}
                            <div class="mt-3">
                                {{ $datas->links('pagination::bootstrap-4') }}
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
        $('#table-belanja').DataTable({
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
