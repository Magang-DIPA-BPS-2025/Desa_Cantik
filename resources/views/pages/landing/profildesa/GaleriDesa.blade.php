@extends('layouts.landing.app')

@section('content')
<div class="container-fluid py-4" style="background-color: #C0D09D; min-height: 100vh;">
    {{-- Judul --}}
    <div class="mb-4 text-start">
        <h3 class="fw-bold">GALERI DESA</h3>
        <p class="mb-0">Menampilkan Foto-Foto desa</p>
    </div>

    {{-- Grid Galeri 3x3 --}}
    <div class="row">
        @forelse ($galeris as $galeri)
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('storage/' . $galeri->gambar) }}"
                         class="card-img-top rounded img-fluid w-100 h-100"
                         style="object-fit: cover; aspect-ratio: 1/1;"
                         alt="Foto Galeri">
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada foto galeri yang diunggah.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
