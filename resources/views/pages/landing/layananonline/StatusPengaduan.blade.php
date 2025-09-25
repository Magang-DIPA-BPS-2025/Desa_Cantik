@extends('layouts.landing.app')

@section('content')
<div class="container mt-4">

    {{-- Judul --}}
    <h2 class="mb-3" style="text-align: left;">Status Pengaduan Online Warga Desa</h2>

    {{-- Form Search --}}
    <form action="{{ route('dataPenduduk.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="Cari NIK / Nama..."
                   value="{{ request('keyword') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Tabel Data Surat --}}
    <table class="table table-bordered table-striped">
        <thead style="background: linear-gradient(90deg, #3B82F6, #31C48D); color: white;">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Waktu Masuk Surat</th>
                <th>Status</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($dataPenduduk) && $dataPenduduk->count() > 0)
                @foreach($dataPenduduk as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->waktu_masuk }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <button class="btn btn-sm btn-info">Detail</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">Belum ada data.</td>
                </tr>
            @endif
        </tbody>
    </table>

</div>
@endsection
