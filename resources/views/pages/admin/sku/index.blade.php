@extends('layouts.app', ['title' => $title])

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
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
            <h1>Data Surat Keterangan Usaha (SKU)</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('sku.create') }}" class="btn btn-primary mb-4">
                        <i class="fas fa-plus"></i> Tambah SKU
                    </a>

                    {{-- Notifikasi --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- Tabel Data SKU --}}
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-sku">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Nama Usaha</th>
                                    <th>Alamat Usaha</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($skus as $sku)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sku->nik }}</td>
                                        <td>{{ $sku->nama }}</td>
                                        <td>{{ $sku->alamat }}</td>
                                        <td>{{ $sku->nama_usaha }}</td>
                                        <td>{{ $sku->alamat_usaha }}</td>
                                        <td>{{ $sku->no_hp ?? '-' }}</td>
                                        <td>{{ $sku->email ?? '-' }}</td>
                                        <td>
                                            @if($sku->status_verifikasi === 'Terverifikasi')
                                                <span class="badge badge-success">Terverifikasi</span>
                                            @else
                                                <span class="badge badge-warning">Belum Diverifikasi</span>
                                            @endif
                                        </td>
                                        <td>{{ $sku->created_at ? $sku->created_at->format('d-m-Y') : '-' }}</td>
                                        <td class="d-flex flex-wrap gap-2">

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('sku.edit', $sku->id) }}" class="btn btn-warning btn-sm mr-2">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('sku.destroy', $sku->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mr-2">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                            {{-- Tombol Verifikasi --}}
                                            @if($sku->status_verifikasi === 'Belum Diverifikasi')
                                                <a href="{{ route('sku.verifikasi', $sku->id) }}"
                                                   class="btn btn-success btn-sm mr-2"
                                                   onclick="return confirm('Verifikasi data SKU ini?')">
                                                   <i class="fas fa-check"></i> Verifikasi
                                                </a>
                                            @endif

                                            {{-- Tombol Cetak --}}
                                            @if($sku->status_verifikasi === 'Terverifikasi')
                                                <a href="{{ route('sku.cetak', $sku->id) }}" target="_blank"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-print"></i> Cetak Surat
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">
                                            <i>Tidak ada data SKU</i>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-3">
                        {{ $skus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#table-sku').DataTable({
            paging: true,
            searching: true,
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            },
        });
    });
</script>
@endpush
