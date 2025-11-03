@extends('layouts.app', ['title' => 'Data Surat Keterangan Kematian'])

@push('styles')
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

        .table-top-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        /* Styling untuk tombol download Excel */
        .btn-download-excel { 
            background: #16a34a; 
            color: #fff; 
            border: none; 
            border-radius: 8px; 
            padding: 8px 14px; 
            display: flex; 
            align-items: center; 
            gap: 6px; 
            font-size: 14px; 
            font-weight: 500; 
            cursor: pointer; 
            transition: .3s; 
            font-family: 'Poppins', sans-serif; 
            text-decoration: none;
        }

        .btn-download-excel:hover { 
            background: #15803d; 
            color: #fff;
            text-decoration: none;
        }

        .dataTables-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .dataTables-length {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .dataTables-filter {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .dataTables-length label,
        .dataTables-filter label {
            margin-bottom: 0;
            font-weight: 500;
            white-space: nowrap;
        }

        .dataTables-length select {
            width: auto;
            display: inline-block;
            min-width: 70px;
        }

        .dataTables-filter input {
            width: auto;
            display: inline-block;
            min-width: 150px;
        }

        /* Styling untuk pagination */
        .pagination-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-info {
            font-size: 14px;
            color: #6c757d;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: flex-end;
        }

        /* Responsive untuk DataTables - TAMPILAN HP */
        @media (max-width: 576px) {
            .dataTables-controls {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }
            
            .dataTables-length,
            .dataTables-filter {
                justify-content: space-between;
                width: 100%;
                background: #f8f9fa;
                padding: 10px;
                border-radius: 8px;
                border: 1px solid #e9ecef;
            }
            
            .dataTables-length {
                order: 1;
            }
            
            .dataTables-filter {
                order: 2;
            }
            
            .table-top-controls {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }
            
            .btn-download-excel {
                width: 100%;
                justify-content: center;
            }
            
            .dataTables-length select {
                flex: 1;
                max-width: 80px;
            }
            
            .dataTables-filter input {
                flex: 1;
                min-width: 120px;
            }
            
            /* Pagination di HP */
            .pagination-container {
                flex-direction: column;
                text-align: center;
            }
            
            .pagination-wrapper {
                justify-content: center;
                width: 100%;
            }
            
            .pagination-info {
                text-align: center;
                width: 100%;
            }
        }

        /* Desktop */
        @media (min-width: 577px) {
            .dataTables-controls {
                flex-direction: row;
                justify-content: space-between;
            }
            
            .dataTables-length {
                order: 1;
            }
            
            .dataTables-filter {
                order: 2;
            }
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table-custom th {
            background: #f8f9fa;
            padding: 12px;
            text-align: center;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        
        .table-custom td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* PERBAIKAN: Styling untuk tombol aksi - SEJAJAR HORIZONTAL */
        .aksi-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            flex-wrap: nowrap;
        }

        .btn-aksi {
            padding: 0.35rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 4px;
            min-width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-aksi i {
            margin: 0;
        }

        /* Pastikan form dalam aksi tidak mempengaruhi layout */
        .aksi-container form {
            margin: 0;
            display: inline;
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Surat Keterangan Kematian</h1>
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

                        {{-- Tombol Download Excel --}}
                        <div class="table-top-controls mb-3">
                            <button class="btn-download-excel" onclick="downloadExcel()">
                                <i class="fas fa-file-excel"></i> Download Excel
                            </button>
                        </div>

                        
                        <form method="GET" action="{{ route('kematian.index') }}" id="filter-form">
                            <div class="dataTables-controls">
                                <div class="dataTables-length">
                                    <label for="per_page">Show</label>
                                    <select name="per_page" id="per_page" class="form-control form-control-sm" onchange="document.getElementById('filter-form').submit()">
                                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                    <span>entries</span>
                                </div>
                                <div class="dataTables-filter">
                                    <label for="search">Search:</label>
                                    <input type="search" name="search" id="search" class="form-control form-control-sm" placeholder="Cari..." value="{{ request('search') }}" onkeypress="if(event.keyCode == 13) { document.getElementById('filter-form').submit() }">
                                    @if(request('search'))
                                        <a href="{{ route('kematian.index') }}" class="btn btn-sm btn-outline-secondary ml-2">Reset</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                       
                        <div class="table-responsive">
                            <table class="table table-striped table-custom">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Kematian</th>
                                        <th>Kontak</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kematians as $kematian)
                                        <tr>
                                            <td>{{ ($kematians->currentPage() - 1) * $kematians->perPage() + $loop->iteration }}</td>
                                            <td>
                                                @if($kematian->nomor_surat)
                                                    <span class="badge badge-nomor">{{ $kematian->nomor_surat }}</span>
                                                @else
                                                    <span class="text-muted" style="font-size: 11px;">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $kematian->nik }}</td>
                                            <td>{{ $kematian->nama }}</td>
                                            <td>{{ $kematian->alamat }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kematian->tanggal_kematian)->format('d-m-Y') }}</td>
                                            <td>
                                                @if($kematian->no_hp)
                                                    @php
                                                        $nohp = preg_replace('/[^0-9]/', '', $kematian->no_hp);
                                                        if (substr($nohp, 0, 1) === '0') {
                                                            $nohp = '62' . substr($nohp, 1);
                                                        } elseif (substr($nohp, 0, 3) === '+62') {
                                                            $nohp = substr($nohp, 1);
                                                        }
                                                    @endphp
                                                    <a href="https://api.whatsapp.com/send?phone={{ $nohp }}&text={{ urlencode('Halo ' . $kematian->nama . ', mengenai pengajuan Surat Keterangan Kematian sudah jadi. Silakan cek status pengantar di website desa.') }}"
                                                        target="_blank" class="btn btn-outline-success btn-sm py-0 px-2"
                                                        title="Hubungi via WhatsApp">
                                                        <i class="fab fa-whatsapp mr-1"></i> Chat
                                                    </a>
                                                    <small class="text-muted d-block">{{ $kematian->no_hp }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $kematian->email ?? '-' }}</td>
                                            <td>
                                                @if($kematian->status_verifikasi === 'Terverifikasi')
                                                    <span class="badge badge-success">Terverifikasi</span>
                                                @else
                                                    <span class="badge badge-warning">Belum Diverifikasi</span>
                                                @endif
                                            </td>
                                            <td>{{ $kematian->created_at ? $kematian->created_at->format('d-m-Y') : '-' }}</td>
                                            <td>
                                                {{-- PERBAIKAN: Container untuk tombol aksi SEJAJAR --}}
                                                <div class="aksi-container">
                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('kematian.edit', $kematian->id) }}" class="btn btn-warning btn-aksi"
                                                        title="Edit Data">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    {{-- Tombol Hapus --}}
                                                    <form action="{{ route('kematian.destroy', $kematian->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-aksi" title="Hapus Data">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    
                                                    {{-- Tombol Verifikasi atau Cetak --}}
                                                    @if($kematian->status_verifikasi === 'Belum Diverifikasi')
                                                        <a href="{{ route('kematian.verifikasi', $kematian->id) }}"
                                                            class="btn btn-success btn-aksi"
                                                            onclick="return confirm('Verifikasi data surat kematian ini?')"
                                                            title="Verifikasi Surat">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('kematian.cetak', $kematian->id) }}" target="_blank"
                                                            class="btn btn-info btn-aksi" title="Cetak Surat">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center text-muted">
                                                <i>Tidak ada data surat kematian</i>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                      
                        @if($kematians->hasPages())
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Menampilkan {{ ($kematians->currentPage() - 1) * $kematians->perPage() + 1 }} 
                                sampai {{ min($kematians->currentPage() * $kematians->perPage(), $kematians->total()) }} 
                                dari {{ $kematians->total() }} entri
                            </div>
                            <div class="pagination-wrapper">
                                {{ $kematians->links() }}
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
    {{-- Library untuk export Excel --}}
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <script>
        // Download Excel Function
        function downloadExcel(){ 
            const wb = XLSX.utils.table_to_book(document.querySelector(".table-custom")); 
            XLSX.writeFile(wb, "Data_Surat_Kematian_Desa_Manggalung.xlsx"); 
        }
    </script>
@endpush