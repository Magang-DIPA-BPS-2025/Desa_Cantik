@extends('layouts.app', ['title' => 'Data UMKM Desa'])

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<style>
    .modal-lg { max-width: 90%; }
    .file-viewer { width: 100%; height: 80vh; border: none; border-radius: 6px; }
    .badge-custom { font-size: 0.75rem; padding: 0.35em 0.65em; }
    .table-img { width: 50px; height: 50px; object-fit: cover; border-radius: 6px; }
    .action-buttons { white-space: nowrap; }
    .rating-stars { display: inline-flex; align-items: center; }
    .rating-value { font-weight: 600; margin-right: 4px; }
    
    @media (max-width: 768px) {
        .table-img { width: 40px; height: 40px; }
        .badge-custom { font-size: 0.7rem; }
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data UMKM Desa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row mb-4">
                {{-- 🔹 Statistik Ringkasan --}}
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary"><i class="fas fa-store"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Total UMKM</h4></div>
                            <div class="card-body">{{ $stats['total'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Ada Lokasi</h4></div>
                            <div class="card-body">{{ $stats['lokasi'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning"><i class="fas fa-star"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Rating Rata-rata</h4></div>
                            <div class="card-body">{{ $stats['rating'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info"><i class="fas fa-tags"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Kategori</h4></div>
                            <div class="card-body">{{ $stats['kategori'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card Tabel --}}
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4>Daftar UMKM Desa</h4>
                            <div class="card-header-action">
                                <a href="{{ route('belanja.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah UMKM
                                </a>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- Notifikasi sukses --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-umkm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>UMKM</th>
                                            <th>Kategori</th>
                                            <th>Pemilik</th>
                                            <th>Harga</th>
                                            <th>Rating</th>
                                            <th>Lokasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $index => $data)
                                            <tr>
                                                <td>{{ $datas->firstItem() + $index }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($data->foto)
                                                            <img src="{{ asset('storage/' . $data->foto) }}" 
                                                                 alt="{{ $data->judul }}" 
                                                                 class="table-img mr-3">
                                                        @else
                                                            <div class="table-img mr-3 bg-light d-flex align-items-center justify-content-center rounded">
                                                                <i class="fas fa-store text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <h6 class="mb-0 font-weight-bold">{{ $data->judul }}</h6>
                                                            @if($data->wa)
                                                                <small class="text-muted">
                                                                    <i class="fab fa-whatsapp mr-1"></i>{{ $data->wa }}
                                                                </small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($data->kategori)
                                                        <span class="badge badge-custom badge-success">
                                                            {{ $data->kategori }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-custom badge-secondary">-</span>
                                                    @endif
                                                </td>
                                                <td>{{ $data->pemilik ?? '-' }}</td>
                                                <td>
                                                    <span class="font-weight-bold text-success">
                                                        Rp {{ number_format($data->harga, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="rating-stars">
                                                        @php
                                                            $rating = $data->averageRating();
                                                            $ratingCount = $data->ratingCount();
                                                        @endphp
                                                        @if($rating > 0)
                                                            <span class="rating-value text-warning font-weight-bold">
                                                                {{ number_format($rating, 1) }}
                                                            </span>
                                                            <div class="d-flex align-items-center">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= floor($rating))
                                                                        <i class="fas fa-star text-warning" style="font-size: 12px;"></i>
                                                                    @elseif($i - 0.5 <= $rating)
                                                                        <i class="fas fa-star-half-alt text-warning" style="font-size: 12px;"></i>
                                                                    @else
                                                                        <i class="far fa-star text-warning" style="font-size: 12px;"></i>
                                                                    @endif
                                                                @endfor
                                                                <small class="text-muted ml-1">
                                                                    ({{ $ratingCount }})
                                                                </small>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">Belum ada rating</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($data->latitude && $data->longitude)
                                                        <span class="badge badge-custom badge-success">
                                                            <i class="fas fa-check-circle mr-1"></i>Ada
                                                        </span>
                                                    @else
                                                        <span class="badge badge-custom badge-warning">
                                                            <i class="fas fa-exclamation-circle mr-1"></i>Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="action-buttons">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('belanja.usershow', $data->id) }}" 
                                                           class="btn btn-info btn-sm"
                                                           target="_blank"
                                                           data-toggle="tooltip"
                                                           title="Lihat di Website">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('belanja.edit', $data->id) }}" 
                                                           class="btn btn-warning btn-sm"
                                                           data-toggle="tooltip"
                                                           title="Edit Data">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('belanja.destroy', $data->id) }}" 
                                                              method="POST" 
                                                              class="d-inline"
                                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus UMKM {{ $data->judul }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-danger btn-sm"
                                                                    data-toggle="tooltip"
                                                                    title="Hapus Data">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Paginasi --}}
                            <div class="mt-3 d-flex justify-content-end">
                                {{ $datas->links('pagination::bootstrap-4') }}
                            </div>

                        </div>
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
    $('#table-umkm').DataTable({
        paging: false, // karena kita pakai Laravel pagination
        searching: true,
        ordering: true,
        responsive: true,
        language: { 
            url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
            search: "Cari:",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 hingga 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)"
        }
    });

    // Disable tombol delete setelah klik
    $('form').on('submit', function() {
        $(this).find('button[type=submit]').attr('disabled', true);
    });

    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush