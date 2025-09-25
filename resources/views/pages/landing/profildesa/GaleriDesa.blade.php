@extends('layouts.landing.app')

@section('content')
<div class="container py-5" style="background-color: #fff; min-height: 100vh;">
    {{-- Judul --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold position-relative d-inline-block">
            GALERI DESA
            <span class="d-block mx-auto mt-2" style="width: 60px; height: 3px; background: #4CAF50; border-radius: 5px;"></span>
        </h2>
        <p class="text-muted">Kumpulan dokumentasi kegiatan & keindahan desa</p>
    </div>

    {{-- Grid Galeri --}}
    <div class="row g-4">
        @forelse ($galeris as $galeri)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 gallery-card">
                    <a href="{{ asset('storage/' . $galeri->gambar) }}" data-bs-toggle="modal" data-bs-target="#modalGaleri{{ $galeri->id }}">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                             class="card-img-top img-fluid w-100"
                             style="object-fit: cover; aspect-ratio: 1/1;"
                             alt="Foto Galeri">
                    </a>
                </div>
            </div>

            {{-- Modal (Lightbox) --}}
            <div class="modal fade" id="modalGaleri{{ $galeri->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-transparent border-0">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}" class="img-fluid rounded shadow-lg" alt="Foto Galeri">
                    </div>
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
    <div class="d-flex justify-content-center mt-5">
        {{ $galeris->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- CSS tambahan --}}
<style>
    .gallery-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .gallery-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection
