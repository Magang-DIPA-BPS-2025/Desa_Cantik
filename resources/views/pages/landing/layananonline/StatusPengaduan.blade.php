@extends('layouts.landing.app')

@section('content')
<div class="container mt-4">

    {{-- Judul --}}
    <h2 class="mb-3" style="text-align: left;">Status Pengaduan Online Warga Desa</h2>

    {{-- Form Search --}}
    <form action="{{ route('pengaduan.userStatus') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="Cari berdasarkan email..."
                   value="{{ request('email') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Tabel --}}
    <table class="table table-bordered table-striped">
        <thead style="background: linear-gradient(90deg, #3B82F6, #31C48D); color: white;">
            <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Email</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Waktu Pengaduan</th>
            </tr>
        </thead>
        <tbody>
            @forelse((request('email') ? $pengaduans : []) as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->judul }}</td>
                    <td>
                        @if($data->status == 'baru')
                            <span class="badge bg-primary">Baru</span>
                        @elseif($data->status == 'diproses')
                            <span class="badge bg-warning">Diproses</span>
                        @elseif($data->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($data->status == 'ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                    <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        @if(request('email'))
                            Tidak ada pengaduan ditemukan.
                        @else
                            Silahkan masukkan email Anda terlebih dahulu.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
