@extends('layouts.app', ['title' => 'Data APBD Desa'])

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data APBD Desa</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('apbd.create') }}" class="btn btn-primary my-4">
                                <i class="fas fa-plus"></i> Tambah Data APBD
                            </a>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-striped" id="table-apbd">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Total Pendapatan</th>
                                            <th>Total Belanja</th>
                                            <th>Surplus/Defisit</th>
                                            <th>PAD (%)</th>
                                            <th>Transfer (%)</th>
                                            <th>Lainnya (%)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($apbds as $index => $apbd)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $apbd->tahun }}</td>
                                                <td class="text-end">{{ number_format($apbd->total_pendapatan, 0, ',', '.') }}</td>
                                                <td class="text-end">{{ number_format($apbd->total_belanja, 0, ',', '.') }}</td>
                                                <td class="text-end">
                                                    <span class="badge {{ $apbd->surplus_defisit >= 0 ? 'bg-success' : 'bg-danger' }}">
                                                        {{ number_format($apbd->surplus_defisit, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">{{ $apbd->pendapatan_pad_persen }}%</td>
                                                <td class="text-center">{{ $apbd->pendapatan_transfer_persen }}%</td>
                                                <td class="text-center">{{ $apbd->pendapatan_lain_persen }}%</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('apbd.edit', $apbd->id) }}" class="btn btn-warning btn-sm mr-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('apbd.destroy', $apbd->id) }}" method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-4">
                                                    Belum ada data APBD.
                                                </td>
                                            </tr>
                                        @endforelse
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
            $('#table-apbd').DataTable({
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
