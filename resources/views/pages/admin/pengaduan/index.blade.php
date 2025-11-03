@extends('layouts.app', ['title' => 'Data Pengaduan'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        
        <style>
            table td, table th {
                white-space: normal !important;
                word-wrap: break-word;
                vertical-align: middle;
            }

            td.deskripsi-col, td.alamat-col {
                max-width: 200px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            td.judul-col {
                max-width: 150px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            td.deskripsi-col:hover,
            td.alamat-col:hover,
            td.judul-col:hover {
                white-space: normal;
                overflow: visible;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pengaduan</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
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
                                <button class="btn btn-success mb-4" onclick="downloadExcel()">
                                    <i class="fas fa-file-excel"></i> Download Excel
                                </button>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-pengaduan">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Judul</th>
                                                <th>Deskripsi</th>
                                                <th>Lampiran</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $index => $pengaduan)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $pengaduan->nama }}</td>
                                                    <td>{{ $pengaduan->email }}</td>
                                                    <td>{{ $pengaduan->telepon }}</td>
                                                    <td class="alamat-col" title="{{ $pengaduan->alamat }}">{{ $pengaduan->alamat }}</td>
                                                    <td class="judul-col" title="{{ $pengaduan->judul }}">{{ $pengaduan->judul }}</td>
                                                    <td class="deskripsi-col" title="{{ $pengaduan->deskripsi }}">{{ $pengaduan->deskripsi }}</td>
                                                    <td>
                                                        @if($pengaduan->file)
                                                            <a href="{{ asset('storage/' . $pengaduan->file) }}" target="_blank" class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                                <option value="baru" {{ $pengaduan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                                                <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                                <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d-m-Y H:i') }}</td>
                                                    <td class="d-flex">
                                                        <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST"
                                                            onsubmit="return confirm('Yakin ingin hapus pengaduan ini?')">
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
        
        <!-- Excel Export -->
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                // DataTable initialization
                var tablePengaduan = $('#table-pengaduan').DataTable({
                    paging: true,
                    searching: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                });
            });

            // Download Excel Function
            function downloadExcel(){ 
                const wb = XLSX.utils.table_to_book(document.getElementById("table-pengaduan")); 
                XLSX.writeFile(wb, "Data_Pengaduan_Desa.xlsx"); 
            }
        </script>
    @endpush
@endsection