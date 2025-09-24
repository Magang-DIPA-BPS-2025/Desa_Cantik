@extends('layouts.app', ['title' => 'Galeri'])

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Galeri</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Galeri</div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between mb-4">
                <h2 class="section-title">Daftar Foto Galeri</h2>
                <a href="{{ route('galeri.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Foto
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                @foreach($galeris as $galeri)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card h-100">
                            @if($galeri->gambar)
                                <img src="{{ asset('storage/' . $galeri->gambar) }}" class="card-img-top" alt="{{ $galeri->judul }}" style="height:200px; object-fit:cover;">
                            @else
                                <img src="https://via.placeholder.com/200x150.png?text=No+Image" class="card-img-top" alt="No Image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $galeri->judul }}</h5>
                                <p class="card-text">{{ $galeri->deskripsi }}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                {{ $galeris->links() }}
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')

@endpush
