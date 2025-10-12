@extends('layouts.app', ['title' => 'Agenda Desa'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">

        <style>
            /* Card styling */
            .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            }

            /* Tabel lebih rapi */
            #table-agenda thead {
                background-color: #f8f9fa;
            }

            #table-agenda thead th {
                font-weight: 600;
                text-transform: uppercase;
                font-size: 13px;
                color: #495057;
                border-bottom: 2px solid #dee2e6;
            }

            #table-agenda tbody tr:hover {
                background-color: #f2f7fb;
                transition: 0.2s;
            }

            /* Foto agenda konsisten */
            .foto-agenda {
                width: 70px;
                height: 70px;
                object-fit: cover;
                border-radius: 8px;
                border: 1px solid #ddd;
            }

            /* Tombol aksi */
            .action-buttons {
                display: flex;
                gap: 8px;
                justify-content: center;
            }

            .action-buttons .btn {
                width: 38px;
                height: 38px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                transition: all 0.2s;
            }

            .action-buttons .btn-warning {
                background-color: #ffc107;
                border: none;
                color: #fff;
            }

            .action-buttons .btn-danger {
                background-color: #e74c3c;
                border: none;
                color: #fff;
            }

            .action-buttons .btn:hover {
                transform: scale(1.1);
                opacity: 0.9;
            }
        </style>
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Agenda Desa</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('AgendaDesa.create') }}" class="btn btn-primary mb-3">
                                    <i class="fas fa-plus"></i> Tambah Agenda
                                </a>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-agenda">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Waktu Pelaksanaan</th>
                                                <th>Deskripsi</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $index => $agenda)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        @if ($agenda->foto)
                                                            <img src="{{ asset('storage/' . $agenda->foto) }}"
                                                                 alt="Foto Agenda"
                                                                 class="foto-agenda">
                                                        @else
                                                            <span class="text-muted">Tidak ada</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $agenda->nama_kegiatan }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->format('d-m-Y H:i') }}</td>
                                                    <td>{{ $agenda->deskripsi }}</td>
                                                    <td>{{ $agenda->kategori }}</td>
                                                    <td class="action-buttons">
                                                        <a href="{{ route('AgendaDesa.edit', $agenda->id) }}" class="btn btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('AgendaDesa.destroy', $agenda->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus agenda ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
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
                $('#table-agenda').DataTable({
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
