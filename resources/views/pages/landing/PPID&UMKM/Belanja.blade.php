@extends('layouts.landing.app', ['title' => 'UMKM Desa'])

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    /* ========== GLOBAL ========== */
    .container {
        max-width: 1200px;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    /* CARD BISA DIKLIK */
    .umkm-card {
        display: block;
        text-decoration: none;
        color: inherit;
        height: 100%;
        border: 1px solid #e9ecef;
        background-color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .umkm-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
    }

    .umkm-card:hover .card-title {
        color: #28a745;
    }

    .umkm-image {
        height: 200px;
        width: 100%;
        object-fit: cover;
        border-bottom: 1px solid #e9ecef;
    }

    .badge {
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 6px;
        padding: 0.35em 0.65em;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .badge-category {
        background: #28a745;
        color: #fff;
    }

    .badge-rating {
        background: #ffc107;
        color: #212529;
    }

    .badge-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: space-between;
        padding: 0.75rem;
        z-index: 2;
    }

    .card-body {
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
    }

    .card-title {
        font-weight: 700;
        color: #2d3748;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .card-text {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .price {
        font-weight: 700;
        color: #28a745;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .info-line {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }

    #umkmMap {
        border-radius: 0 0 12px 12px;
        height: 400px;
    }

    .custom-marker {
        background: #28a745;
        border: 3px solid #fff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .stats-container {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    @media (max-width: 768px) {
        .page-title { font-size: 2rem; }
        #umkmMap { height: 300px; }
    }

    @media (max-width: 576px) {
        .page-title { font-size: 1.75rem; }
        #umkmMap { height: 250px; }
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="page-header">
        <h1 class="page-title"><i class="fas fa-store me-3"></i>UMKM Desa</h1>
        <p class="page-subtitle">Temukan berbagai produk unggulan dan jasa dari UMKM desa kami</p>
    </div>

    {{-- MAP --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="card map-container">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Peta Lokasi UMKM Desa</h5>
                </div>
                <div class="card-body p-0">
                    <div id="umkmMap"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- UMKM LIST --}}
    <div class="row g-4">
        @forelse($belanjas as $umkm)
        <div class="col-12 col-sm-6 col-lg-4">
            {{-- CARD BISA DIKLIK --}}
            <a href="{{ route('belanja.usershow', $umkm->id) }}" class="umkm-card">
                <div class="position-relative">
                    <img src="{{ $umkm->foto ? asset('storage/' . $umkm->foto) : asset('img/default-product.png') }}"
                         alt="{{ $umkm->judul }}" class="umkm-image">

                    {{-- Kategori & Rating sejajar --}}
                    <div class="badge-wrapper">
                        <div>
                            @if($umkm->kategori)
                                <span class="badge badge-category">
                                    <i class="fas fa-tag me-1"></i>{{ $umkm->kategori }}
                                </span>
                            @endif
                        </div>
                        <div>
                            @php
                                $rating = $umkm->averageRating();
                            @endphp
                            @if($rating > 0)
                                <span class="badge badge-rating">
                                    <i class="fas fa-star me-1"></i>{{ number_format($rating, 1) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ $umkm->judul }}</h5>
                    @if($umkm->deskripsi)
                        <p class="card-text">{{ Str::limit(strip_tags($umkm->deskripsi), 120) }}</p>
                    @endif

                    <div class="info-line">
                        <i class="fas fa-user text-success"></i>
                        <small>{{ $umkm->pemilik }}</small>
                    </div>

                    @if($umkm->lokasi)
                    <div class="info-line">
                        <i class="fas fa-map-marker-alt text-success"></i>
                        <small>{{ $umkm->lokasi }}</small>
                    </div>
                    @endif

                    <div class="price">Rp {{ number_format($umkm->harga, 0, ',', '.') }}</div>
                </div>
            </a>

            {{-- Tombol WA tetap terpisah --}}
            @if($umkm->wa)
            <a href="https://wa.me/62{{ ltrim($umkm->wa, '0') }}?text=Halo%20{{ urlencode($umkm->pemilik) }},%20saya%20tertarik%20dengan%20{{ urlencode($umkm->judul) }}."
               target="_blank" class="btn btn-outline-success w-100 mt-2">
               <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
            </a>
            @endif
        </div>
        @empty
        <div class="col-12 text-center text-muted">
            <p>Belum ada UMKM terdaftar.</p>
        </div>
        @endforelse
    </div>

    @if($belanjas->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $belanjas->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const umkmData = [
@foreach($belanjas as $umkm)
@if($umkm->latitude && $umkm->longitude)
{
    id: {{ $umkm->id }},
    title: "{{ addslashes($umkm->judul) }}",
    kategori: "{{ addslashes($umkm->kategori) }}",
    pemilik: "{{ addslashes($umkm->pemilik) }}",
    wa: "{{ addslashes($umkm->wa) }}",
    harga: {{ $umkm->harga }},
    rating: {{ number_format($umkm->averageRating(), 1) }},
    lokasi: "{{ addslashes($umkm->lokasi) }}",
    image: "{{ $umkm->foto ? asset('storage/' . $umkm->foto) : asset('img/default-product.png') }}",
    url: "{{ route('belanja.usershow', $umkm->id) }}",
    lat: {{ $umkm->latitude }},
    lng: {{ $umkm->longitude }}
},
@endif
@endforeach
];

document.addEventListener('DOMContentLoaded', () => {
    const map = L.map('umkmMap').setView([-5.147665, 119.432732], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const umkmIcon = L.divIcon({
        className: 'custom-marker',
        html: '<i class="fas fa-store" style="color:white; font-size:14px;"></i>',
        iconSize: [40, 40],
        iconAnchor: [20, 20]
    });

    umkmData.forEach(u => {
        const popup = `
            <div style="min-width:280px;">
                <img src="${u.image}" style="width:100%;height:120px;object-fit:cover;border-radius:8px;margin-bottom:8px;">
                <h6 class="fw-bold text-success mb-1">${u.title}</h6>
                <small class="text-muted d-block mb-1"><i class="fas fa-user me-1"></i>${u.pemilik}</small>
                <small class="text-muted d-block mb-1"><i class="fas fa-tag me-1"></i>${u.kategori}</small>
                <small class="text-muted d-block mb-2"><i class="fas fa-dollar-sign me-1"></i>Rp ${u.harga.toLocaleString('id-ID')}</small>
                <a href="${u.url}" class="btn btn-success btn-sm w-100 mb-1"><i class="fas fa-eye me-1"></i>Lihat Detail</a>
                ${u.wa ? `<a href="https://wa.me/62${u.wa.replace(/[^0-9]/g, '')}" target="_blank" class="btn btn-outline-success btn-sm w-100"><i class="fab fa-whatsapp me-1"></i>Chat WhatsApp</a>` : ''}
            </div>`;
        L.marker([u.lat, u.lng], { icon: umkmIcon }).addTo(map).bindPopup(popup);
    });

    if (umkmData.length > 0) {
        const group = new L.featureGroup(umkmData.map(u => L.marker([u.lat, u.lng])));
        map.fitBounds(group.getBounds().pad(0.1));
    }
});
</script>
@endpush
