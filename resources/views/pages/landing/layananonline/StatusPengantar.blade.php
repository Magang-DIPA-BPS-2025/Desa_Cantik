@extends('layouts.landing.app')

@section('content')
<div class="container mt-4">

    {{-- Judul --}}
     <h2 class="mb-3" style="text-align: left;">Status Surat Pengantar Online Warga Desa</h2>

    {{-- Form Search --}}
    <form action="{{ route('status') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{ $nik ?? '' }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Tabel Data Surat --}}
    <table class="table table-bordered table-striped">
        <thead style="background: linear-gradient(90deg, #3B82F6, #31C48D); color: white;">
            <tr>
                <th>No</th>
                <th>Jenis Surat</th>
                <th>Status</th>
                <th>Tanggal Diajukan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($datas ?? collect()), $datas as $index => $surat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $surat->jenisSurat->nama_surat ?? '-' }}</td>
                    <td>{{ $surat->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($surat->created_at)->translatedFormat('d M Y') }}</td>
                    <td>
                        @if($surat->status === 'Disetujui')
                            <a class="btn btn-sm btn-success" href="{{ route('user.surat.show', $surat->id) }}">Lihat Surat</a>
                        @else
                            <span class="text-muted">Sedang diproses oleh admin desa.</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
