@extends('layouts.app', ['title' => $title])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="section-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>Jenis Surat</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $i => $s)
                                <tr>
                                    <td>{{ $datas->firstItem() + $i }}</td>
                                    <td>{{ $s->nik }}</td>
                                    <td>{{ $s->jenis_surat }}</td>
                                    <td>{{ $s->status }}</td>
                                    <td>{{ \Carbon\Carbon::parse($s->tanggal_dibuat)->translatedFormat('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.surat_pengantar.show', $s->id) }}" class="btn btn-sm btn-info">Lihat</a>
                                        <form action="{{ route('admin.surat_pengantar.destroy', $s->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">Tidak ada data</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">{{ $datas->links() }}</div>
            </div>
        </div>
    </section>
</div>
@endsection



