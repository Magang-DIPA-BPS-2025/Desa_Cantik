@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - UMKM</title>

<div class="container py-5">

    <!-- Judul halaman -->
    <h3 class="text-start fw-bold mb-5 text-dark">UMKM Desa</h3>

    <!-- Card UMKM 3x3 dengan jarak antar card -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($belanjas as $umkm)
        <div class="col">
            <div class="card shadow-sm h-100 border-0 card-hover">
                @if($umkm->foto)
                <img src="{{ asset('storage/' . $umkm->foto) }}"
                     alt="{{ $umkm->judul }}"
                     class="card-img-top"
                     style="height:220px; object-fit:cover; transition: transform 0.3s;">
                @else
                <img src="{{ asset('img/default-product.png') }}"
                     alt="Default"
                     class="card-img-top"
                     style="height:220px; object-fit:cover; transition: transform 0.3s;">
                @endif
                <div class="card-body text-center">
                    <h5 class="fw-bold text-success">{{ $umkm->judul }}</h5>
                    <p class="mb-1">Harga: Rp {{ number_format($umkm->harga,0,',','.') }}</p>
                    <p class="mb-2">Rating: {{ $umkm->rating }} ⭐</p>
                    <a href="{{ route('belanja.usershow', $umkm->id) }}" class="btn btn-success btn-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $belanjas->links() }}
    </div>

</div>

<style>
/* Hover effect pada card */
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    transition: all 0.3s ease-in-out;
}

/* Tambahkan jarak lebih besar pada row */
.row.g-4 > .col {
    margin-bottom: 1.5rem;
}
</style>

@endsection
