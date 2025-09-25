@extends('layouts.app', ['title' => 'Pengaduan Desa'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">

        <style>
            /* Agar teks panjang tidak merusak tabel */
            table td, table th {
                white-space: normal !important;
                word-wrap: break-word;
                vertical-align: middle;
            }

            /* Batasi lebar kolom tertentu */
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

            /* Hover bisa tampilkan full text */
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
                <h1>Data Pengaduan Desa</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                {{-- Table Pengaduan --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-pengaduan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th class="alamat-col">Alamat</th>
                                                <th class="judul-col">Judul</th>
                                                <th class="deskripsi-col">Deskripsi</th>
                                                <th>Lampiran</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
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
                                                            <a href="{{ asset('storage/' . $pengaduan->file) }}" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('pengaduan.updateStatus', $pengaduan->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="form-control form-control-sm"
                                                                    onchange="this.form.submit()">
                                                                <option value="baru" {{ $pengaduan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                                                <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                                <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d-m-Y H:i') }}</td>
                                                    <td>
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
                                {{-- End Table --}}
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
                $('#table-pengaduan').DataTable({
                    paging: true,
                    searching: true,
                    scrollX: true,
                    autoWidth: false,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                });
            });
        </script>
    @endpush
@endsection
