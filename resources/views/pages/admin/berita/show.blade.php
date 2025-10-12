@extends('layouts.app', ['title' => 'Detail Berita Desa'])

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Berita Desa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}">Berita Desa</a></div>
                <div class="breadcrumb-item">Detail Berita</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Berita</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label><strong>Judul Berita:</strong></label>
                                        <p class="form-control-plaintext">{{ $berita->judul }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Kategori:</strong></label>
                                        <p class="form-control-plaintext">
                                            {{ $berita->kategori ? $berita->kategori->nama : 'Tidak ada kategori' }}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Tanggal Event:</strong></label>
                                        <p class="form-control-plaintext">
                                            {{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d F Y') : 'Tidak ada tanggal event' }}
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Deskripsi Singkat:</strong></label>
                                        <div class="form-control-plaintext" style="white-space: pre-wrap;">{{ $berita->deskripsi_singkat }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Dilihat:</strong></label>
                                        <p class="form-control-plaintext">{{ $berita->dilihat ?? 0 }} kali</p>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Dibuat:</strong></label>
                                        <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y H:i') }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Diperbarui:</strong></label>
                                        <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($berita->updated_at)->translatedFormat('d F Y H:i') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong>Foto Berita:</strong></label>
                                        @if($berita->foto)
                                            <div class="text-center">
                                                <img src="{{ asset('storage/'.$berita->foto) }}" alt="{{ $berita->judul }}"
                                                     class="img-fluid rounded" style="max-width: 100%; max-height: 300px; object-fit: cover;">
                                            </div>
                                        @else
                                            <p class="text-muted">Tidak ada foto</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection






