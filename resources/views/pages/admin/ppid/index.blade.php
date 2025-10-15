@extends('layouts.app', ['title' => 'Data PPID Desa'])

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
    /* Tambahan agar modal lebih responsif */
    .modal-lg {
        max-width: 90%;
    }
    .file-viewer {
        width: 100%;
        height: 80vh;
        border: none;
        border-radius: 6px;
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data PPID Desa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            {{-- Tombol Tambah --}}
                            <a href="{{ route('ppid.create') }}" class="btn btn-primary my-4">
                                <i class="fas fa-plus"></i> Tambah PPID
                            </a>

                            {{-- Notifikasi sukses --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-ppid">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ppids as $index => $ppid)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $ppid->judul }}</td>
                                                <td>{{ Str::limit($ppid->deskripsi, 80) }}</td>
                                                <td>{{ $ppid->tanggal ? \Carbon\Carbon::parse($ppid->tanggal)->format('d-m-Y') : '-' }}</td>
                                                <td>
                                                    @if ($ppid->file)
                                                        <button type="button"
                                                            class="btn btn-info btn-sm btn-view-file"
                                                            data-file="{{ asset('storage/' . $ppid->file) }}">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </button>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('ppid.edit', $ppid->id) }}" class="btn btn-warning btn-sm mr-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('ppid.destroy', $ppid->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
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

{{-- Modal Preview File --}}
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="fileModalLabel">Preview File</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <iframe id="fileViewer" class="file-viewer"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTable
        $('#table-ppid').DataTable({
            paging: true,
            searching: true,
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            },
        });

        // Event klik tombol "Lihat"
        $('.btn-view-file').on('click', function() {
            const fileUrl = $(this).data('file');
            const fileViewer = $('#fileViewer');

            // Deteksi jenis file dan tampilkan di iframe
            const fileExtension = fileUrl.split('.').pop().toLowerCase();
            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                fileViewer.attr('src', fileUrl);
            } else if (fileExtension === 'pdf') {
                fileViewer.attr('src', fileUrl + '#toolbar=0');
            } else {
                fileViewer.attr('src', 'https://docs.google.com/gview?embedded=true&url=' + encodeURIComponent(fileUrl));
            }

            // Tampilkan modal
            $('#fileModal').modal('show');
        });

        // Bersihkan iframe saat modal ditutup
        $('#fileModal').on('hidden.bs.modal', function () {
            $('#fileViewer').attr('src', '');
        });
    });
</script>
@endpush
@endsection
