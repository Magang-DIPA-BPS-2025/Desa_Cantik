@extends('layouts.app', ['title' => $title])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div></div>
                    <form method="GET" action="{{ route('surat.index') }}" class="form-inline">
                        <select name="status" class="form-control mr-2">
                            <option value="">Semua Status</option>
                            <option value="menunggu_verifikasi" {{ ($statusSelected ?? '') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="diproses" {{ ($statusSelected ?? '') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ ($statusSelected ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ ($statusSelected ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <button type="submit" class="btn btn-outline-primary">Filter</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Penduduk</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $i => $surat)
                                    <tr>
                                        <td>{{ $datas->firstItem() + $i }}</td>
                                        <td>{{ $surat->nomor_surat }}</td>
                                        <td>{{ $surat->penduduk->nama ?? '-' }}</td>
                                        <td>{{ $surat->jenisSurat->nama_surat ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->translatedFormat('d M Y') }}</td>
                                        <td>
                                            <span class="badge {{ $surat->status == 'selesai' ? 'badge-success' : ($surat->status == 'diproses' ? 'badge-warning' : ($surat->status == 'ditolak' ? 'badge-danger' : 'badge-secondary')) }}">
                                                {{ Str::title(str_replace('_',' ', $surat->status)) }}
                                            </span>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <a href="{{ route('surat.show', $surat->id) }}" class="btn btn-sm btn-info mr-2"><i class="fas fa-eye"></i></a>
                                            <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Hapus surat ini?')" class="mr-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
