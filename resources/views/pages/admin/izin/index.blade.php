@extends('layouts.app', ['title' => 'Data Surat Izin Kegiatan'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <style>
        .badge-nomor {
            font-size: 11px;
            background-color: #e3f2fd;
            color: #1976d2;
            border: 1px solid #bbdefb;
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Surat Izin Kegiatan</h1>
            </div>

            <div class="section-body">
                <div class="card shadow-sm">
                    <div class="card-body">

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

                        <div class="table-responsive">
                            <table class="table table-striped" id="table-izin">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Acara</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Tempat</th>
                                        <th>No HP</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($izins as $izin)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($izin->nomor_surat)
                                                    <span class="badge badge-nomor">{{ $izin->nomor_surat }}</span>
                                                @else
                                                    <span class="text-muted" style="font-size: 11px;">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $izin->nik }}</td>
                                            <td>{{ $izin->nama }}</td>
                                            <td>{{ $izin->jenis_acara }}</td>
                                            <td>{{ \Carbon\Carbon::parse($izin->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ $izin->tempat }}</td>
                                            <td>
                                                @if($izin->no_hp)
                                                    @php
                                                        $nohp = preg_replace('/[^0-9]/', '', $izin->no_hp);
                                                        if (substr($nohp, 0, 1) === '0') {
                                                            $nohp = '62' . substr($nohp, 1);
                                                        }
                                                        elseif (substr($nohp, 0, 3) === '+62') {
                                                            $nohp = substr($nohp, 1);
                                                        }
                                                    @endphp
                                                    <a href="https://api.whatsapp.com/send?phone={{ $nohp }}&text={{ urlencode('Halo ' . $izin->nama . ', mengenai pengajuan Surat Izin Kegiatan sudah jadi. Silakan cek status pengantar di website desa.') }}"
                                                        target="_blank" class="btn btn-outline-success btn-sm py-0 px-2"
                                                        title="Hubungi via WhatsApp">
                                                        <i class="fab fa-whatsapp mr-1"></i> Chat
                                                    </a>
                                                    <small class="text-muted d-block">{{ $izin->no_hp }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($izin->status_verifikasi === 'Terverifikasi')
                                                    <span class="badge badge-success">Terverifikasi</span>
                                                @else
                                                    <span class="badge badge-warning">Belum Diverifikasi</span>
                                                @endif
                                            </td>
                                            <td>{{ $izin->created_at ? $izin->created_at->format('d-m-Y') : '-' }}</td>
                                            <td class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('izin.edit', $izin->id) }}" class="btn btn-warning btn-sm mr-2"
                                                    title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('izin.destroy', $izin->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mr-2" title="Hapus Data">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                                @if($izin->status_verifikasi === 'Belum Diverifikasi')
                                                    <a href="{{ route('izin.verifikasi', $izin->id) }}"
                                                        class="btn btn-success btn-sm mr-2"
                                                        onclick="return confirm('Verifikasi data surat izin ini?')"
                                                        title="Verifikasi Surat">
                                                        <i class="fas fa-check"></i> Verifikasi
                                                    </a>
                                                @endif

                                                @if($izin->status_verifikasi === 'Terverifikasi')
                                                    <a href="{{ route('izin.cetak', $izin->id) }}" target="_blank"
                                                        class="btn btn-info btn-sm" title="Cetak PDF">
                                                        <i class="fas fa-file-pdf"></i> PDF
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center text-muted">
                                                <i>Tidak ada data surat izin</i>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $izins->links() }}
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
    <script>
        $(document).ready(function () {
            $('#table-izin').DataTable({
                paging: true,
                searching: true,
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                }
            });
        });
    </script>
@endpush