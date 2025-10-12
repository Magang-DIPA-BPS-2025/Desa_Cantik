@extends('layouts.landing.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                @if($belanja->foto)
                <img src="{{ asset('storage/' . $belanja->foto) }}"
                     class="card-img-top"
                     alt="{{ $belanja->judul }}"
                     style="height:300px; object-fit:cover;">
                @endif
                <div class="card-body">
                    <h3 class="fw-bold text-success">{{ $belanja->judul }}</h3>
                    <p>Harga: Rp {{ number_format($belanja->harga,0,',','.') }}</p>
                    <p>Rating: {{ $belanja->rating }} ⭐</p>
                    <p class="mb-3">{{ $belanja->deskripsi }}</p>
                    @if($belanja->wa)
                        <a href="{{ $belanja->link_wa }}" target="_blank" class="btn btn-success">
                            Hubungi via WhatsApp
                        </a>
                    @endif
                    <a href="{{ route('belanja') }}" class="btn btn-secondary ms-2">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
