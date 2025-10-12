@extends('layouts.landing.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold text-primary">📄 Daftar PPID Desa</h2>

    @if($ppids->count() > 0)
    <div class="table-responsive shadow rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary">
                <tr class="text-center">
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Judul</th>
                    <th>Deskripsi</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 15%;">File</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ppids as $index => $ppid)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="fw-semibold">{{ $ppid->judul }}</td>
                    <td>{{ Str::limit($ppid->deskripsi, 120) }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($ppid->tanggal)->translatedFormat('d M Y') }}</td>
                    <td class="text-center">
                        @if($ppid->file)
                            <a href="{{ asset('storage/' . $ppid->file) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                Lihat File
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info text-center mt-4">
        Belum ada data PPID yang ditambahkan.
    </div>
    @endif
</div>
@endsection
