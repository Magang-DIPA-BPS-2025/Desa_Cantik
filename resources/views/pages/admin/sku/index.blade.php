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

    .badge-nomor {
        font-size: 11px;
        background-color: #e3f2fd;
        color: #1976d2;
        border: 1px solid #bbdefb;
    }

    /* Tata letak bagian atas tabel */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_length {
        float: left;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
    }

    .table-top-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }

    #table-sku tbody tr:hover {
        background-color: #f7faff;
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

                    {{-- Tombol atas tabel --}}
                    <div class="table-top-controls">
                        <div class="left-controls">
                            <button class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>
                        </div>
                    </div>

                    {{-- Tabel SKU --}}
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-sku">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Surat</th>
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
                                    <td>
                                        @if($sku->nomor_surat)
                                            <span class="badge badge-nomor">{{ $sku->nomor_surat }}</span>
                                        @else
                                            <span class="text-muted" style="font-size: 11px;">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $sku->nik }}</td>
                                    <td>{{ $sku->nama }}</td>
                                    <td>{{ $sku->alamat }}</td>
                                    <td>{{ $sku->nama_usaha }}</td>
                                    <td>{{ $sku->alamat_usaha }}</td>
                                    <td>
                                        @if($sku->no_hp)
                                            @php
                                                $nohp = preg_replace('/[^0-9]/', '', $sku->no_hp);
                                                if (substr($nohp, 0, 1) === '0') {
                                                    $nohp = '62' . substr($nohp, 1);
                                                } elseif (substr($nohp, 0, 3) === '+62') {
                                                    $nohp = substr($nohp, 1);
                                                }
                                            @endphp
                                            <a href="https://api.whatsapp.com/send?phone={{ $nohp }}&text={{ urlencode('Halo ' . $sku->nama . ', mengenai pengajuan Surat Keterangan Usaha Anda sudah jadi. Silakan cek status pengantar di website desa.') }}"
                                               target="_blank" class="btn btn-outline-success btn-sm py-0 px-2" title="Hubungi via WhatsApp">
                                                <i class="fab fa-whatsapp mr-1"></i> Chat
                                            </a>
                                            <small class="text-muted d-block">{{ $sku->no_hp }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
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
                                        <a href="{{ route('sku.edit', $sku->id) }}" class="btn btn-warning btn-sm mr-2" title="Edit Data termasuk Nomor Surat">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('sku.destroy', $sku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mr-2" title="Hapus Data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @if($sku->status_verifikasi === 'Belum Diverifikasi')
                                            <a href="{{ route('sku.verifikasi', $sku->id) }}" class="btn btn-success btn-sm mr-2" onclick="return confirm('Verifikasi data SKU ini?')" title="Verifikasi Surat">
                                                <i class="fas fa-check"></i> Verifikasi
                                            </a>
                                        @endif
                                        @if($sku->status_verifikasi === 'Terverifikasi')
                                            <a href="{{ route('sku.cetak', $sku->id) }}" target="_blank" class="btn btn-info btn-sm" title="Cetak Surat">
                                                <i class="fas fa-print"></i> Cetak
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted">
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
    var table = $('#table-sku').DataTable({
        paging: true,
        searching: true,
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
        },
        dom: '<"top d-flex justify-content-between align-items-center"lf>rt<"bottom d-flex justify-content-between align-items-center"ip>',
        columnDefs: [
            {
                targets: [1],
                orderable: true,
                searchable: true
            }
        ]
    });
});
</script>
@endpush
