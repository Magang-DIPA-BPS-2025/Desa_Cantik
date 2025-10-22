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

        /* Tambahan untuk tampilan tombol yang lebih baik */
        .btn-group-aksi {
            display: flex;
            gap: 5px;
            flex-wrap: nowrap;
        }

        .btn-aksi {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 4px;
        }

        .table th {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .btn-group-aksi {
                flex-direction: column;
                gap: 2px;
            }

            .btn-aksi {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Surat Keterangan Tidak Mampu (SKTM)</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Data SKTM</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4>Daftar Surat Keterangan Tidak Mampu</h4>
                    </div>
                    <div class="card-body">

                        {{-- Notifikasi --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- Form Pencarian --}}
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <form action="{{ route('sktm.index') }}" method="GET" class="form-inline">
                                    <div class="input-group w-100">
                                        <input type="text" name="keyword" class="form-control"
                                            placeholder="Cari berdasarkan NIK, Nama, atau Alamat..."
                                            value="{{ request('keyword') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search mr-1"></i> Cari
                                            </button>
                                            @if(request('keyword'))
                                                <a href="{{ route('sktm.index') }}" class="btn btn-secondary">
                                                    <i class="fas fa-times mr-1"></i> Reset
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="btn-group">
                                    <span class="btn btn-light">
                                        Total Data: <strong>{{ $sktms->total() }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Tabel Data SKTM --}}
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-sktm">
                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor Surat</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Pekerjaan</th>
                                        <th>Agama</th>
                                        <th>Kontak</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th style="width: 150px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sktms as $sktm)
                                        <tr>
                                            <td>{{ $loop->iteration + ($sktms->currentPage() - 1) * $sktms->perPage() }}</td>
                                            <td>
                                                @if($sktm->nomor_surat)
                                                    <span class="badge badge-nomor">
                                                        <i class="fas fa-file-alt mr-1"></i>{{ $sktm->nomor_surat }}
                                                    </span>
                                                @else
                                                    <span class="text-muted" style="font-size: 11px;">
                                                        <i class="fas fa-minus mr-1"></i>Belum ada
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <code>{{ $sktm->nik }}</code>
                                            </td>
                                            <td>
                                                <strong>{{ $sktm->nama }}</strong>
                                            </td>
                                            <td>
                                                <small>{{ Str::limit($sktm->alamat, 30) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-light">{{ $sktm->pekerjaan }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $sktm->agama }}</span>
                                            </td>
                                            <td>
                                                @if($sktm->no_hp)
                                                    @php
                                                        // Ambil nomor HP dari database & bersihkan (hanya angka)
                                                        $nohp = preg_replace('/[^0-9]/', '', $sktm->no_hp);

                                                        // Jika nomor diawali 0, ubah ke format internasional
                                                        if (substr($nohp, 0, 1) === '0') {
                                                            $nohp = '62' . substr($nohp, 1);
                                                        }

                                                        // Jika diawali +62, hapus tanda +
                                                        elseif (substr($nohp, 0, 3) === '+62') {
                                                            $nohp = substr($nohp, 1);
                                                        }
                                                    @endphp

                                                    <div class="d-flex flex-column">
                                                        <a href="https://api.whatsapp.com/send?phone={{ $nohp }}&text={{ urlencode('Halo ' . $sktm->nama . ', mengenai pengajuan surat keterangan tidak mampu Anda sudah jadi. Silakan cek status pengantar di website desa.') }}"
                                                            target="_blank" class="btn btn-outline-success btn-sm mb-1"
                                                            title="Hubungi via WhatsApp">
                                                            <i class="fab fa-whatsapp mr-1"></i> Chat
                                                        </a>
                                                        <small class="text-muted">{{ $sktm->no_hp }}</small>
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($sktm->status_verifikasi == 'Terverifikasi')
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check-circle mr-1"></i>Terverifikasi
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning">
                                                        <i class="fas fa-clock mr-1"></i>Belum Diverifikasi
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="far fa-calendar mr-1"></i>
                                                    {{ $sktm->created_at ? $sktm->created_at->format('d/m/Y') : '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group-aksi justify-content-center">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('sktm.edit', $sktm->id) }}"
                                                        class="btn btn-warning btn-aksi" title="Edit Data"
                                                        data-toggle="tooltip">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    {{-- Tombol Verifikasi --}}
                                                    @if($sktm->status_verifikasi != 'Terverifikasi')
                                                        <a href="{{ route('sktm.verifikasi', $sktm->id) }}"
                                                            class="btn btn-success btn-aksi"
                                                            onclick="return confirm('Verifikasi data SKTM untuk {{ $sktm->nama }}?')"
                                                            title="Verifikasi Surat" data-toggle="tooltip">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                    @endif

                                                    {{-- Tombol Cetak --}}
                                                    @if($sktm->status_verifikasi == 'Terverifikasi')
                                                        <a href="{{ route('sktm.cetak', $sktm->id) }}" target="_blank"
                                                            class="btn btn-info btn-aksi" title="Cetak Surat" data-toggle="tooltip">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-aksi" disabled
                                                            title="Harus diverifikasi dulu" data-toggle="tooltip">
                                                            <i class="fas fa-print"></i>
                                                        </button>
                                                    @endif

                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('sktm.destroy', $sktm->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data {{ $sktm->nama }}?')"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-aksi" title="Hapus Data"
                                                            data-toggle="tooltip">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center py-4">
                                                <div class="empty-state" data-height="400">
                                                    <div class="empty-state-icon">
                                                        <i class="fas fa-search"></i>
                                                    </div>
                                                    <h2>Data Tidak Ditemukan</h2>
                                                    <p class="lead">
                                                        @if(request('keyword'))
                                                            Tidak ada data SKTM yang sesuai dengan pencarian
                                                            "{{ request('keyword') }}"
                                                        @else
                                                            Belum ada data Surat Keterangan Tidak Mampu
                                                        @endif
                                                    </p>
                                                    @if(request('keyword'))
                                                        <a href="{{ route('sktm.index') }}" class="btn btn-primary mt-4">
                                                            <i class="fas fa-undo mr-1"></i> Tampilkan Semua Data
                                                        </a>
                                                    @else
                                                        <a href="{{ route('sktm.create') }}" class="btn btn-primary mt-4">
                                                            <i class="fas fa-plus mr-1"></i> Tambah Data SKTM
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($sktms->hasPages())
                            <div class="card-footer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        Menampilkan <strong>{{ $sktms->firstItem() ?? 0 }}</strong>
                                        sampai <strong>{{ $sktms->lastItem() ?? 0 }}</strong>
                                        dari <strong>{{ $sktms->total() }}</strong> data
                                    </div>
                                    <div class="d-flex">
                                        {{ $sktms->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
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
            // Initialize DataTable
            $('#table-sktm').DataTable({
                paging: false, // Nonaktifkan paging DataTables karena sudah menggunakan Laravel pagination
                searching: false, // Nonaktifkan searching DataTables karena sudah menggunakan form pencarian
                ordering: true,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                },
                columnDefs: [
                    {
                        targets: [1], // Kolom Nomor Surat
                        orderable: true,
                    },
                    {
                        targets: [10], // Kolom Aksi
                        orderable: false,
                        searchable: false
                    }
                ],
                dom: '<"top"f>rt<"bottom"lip><"clear">'
            });

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Auto-hide alerts after 5 seconds
            setTimeout(function () {
                $('.alert').alert('close');
            }, 5000);

            // Confirm before verification
            $('.btn-verifikasi').on('click', function (e) {
                if (!confirm('Apakah Anda yakin ingin memverifikasi data ini?')) {
                    e.preventDefault();
                }
            });

            // Confirm before deletion
            $('.btn-hapus').on('click', function (e) {
                if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush