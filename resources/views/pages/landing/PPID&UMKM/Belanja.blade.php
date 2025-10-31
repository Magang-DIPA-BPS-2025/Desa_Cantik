@extends('layouts.landing.app', ['title' => 'UMKM Desa'])

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600&display=swap');

/* Font Variables */
:root {
    --font-heading: 'Poppins', sans-serif;
    --font-body: 'Open Sans', sans-serif;
    --color-primary: #2E7D32;
    --color-primary-hover: #1B5E20;
}

/* Apply Fonts */
.umkm-heading {
    font-family: var(--font-heading) !important;
    font-weight: 700 !important;
    letter-spacing: -0.02em !important;
}

.umkm-text {
    font-family: var(--font-body) !important;
    font-weight: 400 !important;
    line-height: 1.6 !important;
}

.umkm-card-title {
    font-family: var(--font-heading) !important;
    font-weight: 600 !important;
}

/* ========== GLOBAL ========== */
.container-main { 
    max-width: 1400px; 
    margin: auto; 
    padding: 20px; 
}

/* Header Section - Sama seperti halaman jumlah penduduk */
.gallery-header {
    margin-bottom: 2rem;
    margin-top: -1rem;
}

.gallery-title {
    font-size: 2.8rem;
    font-weight: 600;
    color: #2E7D32;
    line-height: 1.1;
    margin-bottom: 0.5rem;
    font-family: 'Poppins', sans-serif;
}

.gallery-header p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 0;
    font-family: 'Open Sans', sans-serif;
}

.card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    transition: .25s;
    border: none;
    margin-bottom: 25px;
    background: #fff;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

.umkm-card {
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    height: 100%;
    border: 1px solid #e9ecef;
    background-color: #fff;
    transition: all 0.3s ease;
    cursor: pointer;
    border-radius: 14px;
    overflow: hidden;
}

.umkm-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

.umkm-card:hover .card-title { color: var(--color-primary); }

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
    font-family: var(--font-body);
}
.badge-category { background: var(--color-primary); color: #fff; }
.badge-rating { background: #ffc107; color: #212529; }
.badge-wrapper { position: absolute; top: 0; left: 0; right: 0; display: flex; justify-content: space-between; padding: 0.75rem; z-index: 2; }

.card-body {
    padding: 1.25rem 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.card-title { 
    font-weight: 700; 
    color: #2d3748; 
    font-size: 1.1rem; 
    margin-bottom: 0.5rem;
    font-family: var(--font-heading);
}
.card-text { 
    color: #6c757d; 
    font-size: 0.9rem; 
    margin-bottom: 1rem;
    font-family: var(--font-body);
}
.price { 
    font-weight: 700; 
    color: var(--color-primary); 
    font-size: 1.1rem; 
    margin-bottom: 1rem;
    font-family: var(--font-body);
}

.info-line { 
    display: flex; 
    align-items: center; 
    gap: 6px; 
    color: #6c757d; 
    font-size: 0.9rem; 
    margin-bottom: 6px;
    font-family: var(--font-body);
}

.info-line i { color: var(--color-primary); }

#umkmMap { 
    border-radius: 0 0 12px 12px; 
    height: 400px; 
    width: 100%;
}

.custom-marker {
    background: var(--color-primary);
    border: 3px solid #fff;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

/* Map Header - Hijau dengan teks putih seperti semula */
.map-container .card-header {
    background: var(--color-primary);
    border-bottom: 1px solid var(--color-primary);
    padding: 1.25rem 1.5rem;
    border-radius: 12px 12px 0 0;
}

.map-container .card-header h5 {
    font-family: var(--font-heading);
    font-weight: 600;
    color: #ffffff;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.map-container .card-header h5 i {
    color: #ffffff;
    font-size: 1.1em;
}

/* Button Styling */
.btn-success {
    background-color: var(--color-primary);
    border-color: var(--color-primary);
    font-family: var(--font-body);
    font-weight: 500;
}

.btn-success:hover {
    background-color: var(--color-primary-hover);
    border-color: var(--color-primary-hover);
}

/* Pagination */
.pagination {
    font-family: var(--font-body);
}

.page-link {
    color: var(--color-primary);
}

.page-item.active .page-link {
    background-color: var(--color-primary);
    border-color: var(--color-primary);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gallery-title { 
        font-size: 2.2rem; 
    }
    
    .container-main {
        padding: 15px;
    }
    
    .card {
        padding: 0;
    }
    
    #umkmMap { height: 300px; } 
}

@media (max-width: 576px) {
    .gallery-title { 
        font-size: 1.8rem; 
    }
    
    .gallery-header p {
        font-size: 1rem;
    }
    
    .container-main {
        padding: 15px;
    }
    
    #umkmMap { height: 250px; } 
}
</style>
@endpush

@section('content')
<div class="container-main">
    <!-- Judul Halaman - Sama seperti halaman jumlah penduduk -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            UMKM DESA MANGGAlUNG
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Temukan berbagai produk unggulan dan jasa dari UMKM desa kami
        </p>
    </div>

    {{-- MAP - CARD DENGAN HEADER HIJAU SEPERTI SEMULA --}}
    <div class="card map-container">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 umkm-heading">
                <i class="fas fa-map-marked-alt"></i>
                Peta Lokasi UMKM Desa
            </h5>
        </div>
        <div class="card-body p-0">
            <div id="umkmMap"></div>
        </div>
    </div>

    {{-- UMKM LIST --}}
    <div class="row">
        @forelse($belanjas as $umkm)
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <a href="{{ route('belanja.usershow', $umkm->id) }}" class="umkm-card">
                <div class="position-relative">
                    <img src="{{ $umkm->foto ? asset('storage/' . $umkm->foto) : asset('img/default-product.png') }}"
                         alt="{{ $umkm->judul }}" class="umkm-image">
                    <div class="badge-wrapper">
                        <div>
                            @if($umkm->kategori)
                                <span class="badge badge-category umkm-text">
                                    <i class="fas fa-tag me-1"></i>{{ $umkm->kategori }}
                                </span>
                            @endif
                        </div>
                        <div>
                            @php $rating = $umkm->averageRating(); @endphp
                            @if($rating > 0)
                                <span class="badge badge-rating umkm-text">
                                    <i class="fas fa-star me-1"></i>{{ number_format($rating, 1) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title umkm-card-title">{{ $umkm->judul }}</h5>
                    @if($umkm->deskripsi)
                        <p class="card-text umkm-text">{{ Str::limit(strip_tags($umkm->deskripsi), 120) }}</p>
                    @endif

                    <div class="info-line umkm-text">
                        <i class="fas fa-user"></i>
                        <small>{{ $umkm->pemilik }}</small>
                    </div>

                    @if($umkm->lokasi)
                    <div class="info-line umkm-text">
                        <i class="fas fa-map-marker-alt"></i>
                        <small>{{ $umkm->lokasi }}</small>
                    </div>
                    @endif

                    <div class="price umkm-text">Rp {{ number_format($umkm->harga, 0, ',', '.') }}</div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center text-muted">
            <p class="umkm-text">Belum ada UMKM terdaftar.</p>
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
            <div style="min-width:280px; font-family: 'Open Sans', sans-serif; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 20px rgba(0,0,0,0.06);">
                <img src="${u.image}" style="width:100%;height:120px;object-fit:cover;margin-bottom:0;">
                <div style="padding: 1.25rem 1.5rem;">
                    <h6 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #2d3748; margin-bottom: 0.5rem; font-size: 1.1rem;">${u.title}</h6>
                    
                    <div style="display: flex; align-items: center; gap: 6px; color: #6c757d; font-size: 0.9rem; margin-bottom: 6px;">
                        <i class="fas fa-user" style="color: #2E7D32;"></i>
                        <small>${u.pemilik}</small>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 6px; color: #6c757d; font-size: 0.9rem; margin-bottom: 6px;">
                        <i class="fas fa-tag" style="color: #2E7D32;"></i>
                        <small>${u.kategori}</small>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 6px; color: #6c757d; font-size: 0.9rem; margin-bottom: 1rem;">
                        <i class="fas fa-dollar-sign" style="color: #2E7D32;"></i>
                        <small>Rp ${u.harga.toLocaleString('id-ID')}</small>
                    </div>
                    
                    <a href="${u.url}" style="display:block; text-align:center; background-color: #2E7D32; color: white; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; font-family: 'Open Sans', sans-serif; font-weight: 500; border: none; font-size: 0.9rem; line-height: 1.5; transition: all 0.3s ease;">
                        <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                </div>
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