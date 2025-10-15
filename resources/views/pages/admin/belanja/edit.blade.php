@extends('layouts.app', ['title' => 'Edit UMKM: ' . $belanja->judul])

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #ffb703, #fb8500);
        color: white;
        padding: 1.5rem;
        border-bottom: none;
    }

    .card-header h4 {
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        background: #fff;
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .required::after {
        content: " *";
        color: #dc3545;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40,167,69,0.25);
    }

    .preview-container {
        text-align: center;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px dashed #ced4da;
    }

    .file-preview {
        max-width: 160px;
        max-height: 160px;
        border-radius: 10px;
        border: 3px solid #28a745;
        object-fit: cover;
    }

    .current-photo-label {
        color: #28a745;
        font-weight: 600;
        margin-top: 0.5rem;
        font-size: 0.9rem;
    }

    #map {
        min-height: 280px;
        border-radius: 10px;
        border: 2px solid #e9ecef;
    }

    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.25rem;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        #map {
            min-height: 220px;
        }
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-store mr-2 text-warning"></i> Edit UMKM: {{ $belanja->judul }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('belanja.index') }}">Data UMKM</a></div>
                <div class="breadcrumb-item active">Edit UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card fade-in">
                <div class="card-header">
                    <h4><i class="fas fa-edit mr-2"></i> Form Edit UMKM</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('belanja.update', $belanja->id) }}" method="POST" enctype="multipart/form-data" id="umkmForm">
                        @csrf
                        @method('PUT')

<div class="row">
    <!-- Kolom Kiri -->
    <div class="col-md-6">
        <div class="form-group mb-4">
            <label for="judul" class="form-label required">Nama UMKM</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                   id="judul" name="judul" value="{{ old('judul', $belanja->judul) }}" required>
            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group mb-4">
            <label for="kategori" class="form-label required">Kategori</label>
            <select class="form-select @error('kategori') is-invalid @enderror"
                    id="kategori" name="kategori" required>
                <option value="">Pilih Kategori</option>
                @foreach (['Makanan & Minuman', 'Kerajinan Tangan', 'Pertanian', 'Peternakan', 'Jasa', 'Retail', 'Fashion', 'Kesehatan', 'Lainnya'] as $kategori)
                    <option value="{{ $kategori }}" {{ old('kategori', $belanja->kategori) == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                @endforeach
            </select>
            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group mb-4">
            <label for="pemilik" class="form-label required">Nama Pemilik</label>
            <input type="text" class="form-control @error('pemilik') is-invalid @enderror"
                   id="pemilik" name="pemilik" value="{{ old('pemilik', $belanja->pemilik) }}" required>
            @error('pemilik') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group mb-4">
            <label for="wa" class="form-label required">Nomor WhatsApp</label>
            <div class="input-group">
                <span class="input-group-text">+62</span>
                <input type="text" class="form-control @error('wa') is-invalid @enderror"
                       id="wa" name="wa" value="{{ old('wa', $belanja->wa) }}" required>
            </div>
            @error('wa') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted">Contoh: 81234567890</small>
        </div>

        <!-- Harga dan Rating sekarang pindah ke bawah WhatsApp -->
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="harga" class="form-label required">Harga Produk</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                               id="harga" name="harga" value="{{ old('harga', $belanja->harga) }}" min="0" required>
                    </div>
                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-group">
    <label>Rating (otomatis dari user)</label>
    <input type="text"
           class="form-control"
           value="{{ number_format($belanja->averageRating(), 1) }} dari {{ $belanja->ratingCount() }} ulasan"
           readonly
           style="background-color:#f9f9f9; cursor:not-allowed;">
            </div>
        </div>
    </div>

    <!-- Kolom Kanan tetap sama -->
    <div class="col-md-6">
        <div class="form-group mb-4">
            <label for="foto" class="form-label">Foto UMKM</label>
            @if($belanja->foto)
                <div class="preview-container">
                    <img src="{{ asset('storage/' . $belanja->foto) }}" class="file-preview" alt="{{ $belanja->judul }}">
                    <div class="current-photo-label"><i class="fas fa-check-circle mr-1"></i> Foto saat ini</div>
                </div>
            @endif
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="jam_buka" class="form-label">Jam Buka</label>
                    <input type="time" class="form-control" id="jam_buka" name="jam_buka"
                           value="{{ old('jam_buka', substr($belanja->jam_buka ?? '', 0, 5)) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label for="jam_tutup" class="form-label">Jam Tutup</label>
                    <input type="time" class="form-control" id="jam_tutup" name="jam_tutup"
                           value="{{ old('jam_tutup', substr($belanja->jam_tutup ?? '', 0, 5)) }}">
                </div>
            </div>
        </div>
    </div>
</div>


                        <hr class="my-4">

                        <div class="form-group mb-4">
                            <label class="form-label required">Pilih Lokasi di Peta</label>
                            <div id="map"></div>
                            <small class="text-muted">Klik pada peta untuk memperbarui lokasi UMKM.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="latitude" class="form-label required">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                       value="{{ old('latitude', $belanja->latitude) }}" readonly required>
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label required">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                       value="{{ old('longitude', $belanja->longitude) }}" readonly required>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label for="deskripsi" class="form-label required">Deskripsi UMKM</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $belanja->deskripsi) }}</textarea>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-2"></i> Simpan Perubahan</button>
                            <a href="{{ route('belanja.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const existingLat = {{ $belanja->latitude ?? -5.147665 }};
const existingLng = {{ $belanja->longitude ?? 119.432732 }};
const map = L.map('map').setView([existingLat, existingLng], 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
let marker = L.marker([existingLat, existingLng]).addTo(map);

map.on('click', function(e) {
    const { lat, lng } = e.latlng;
    document.getElementById('latitude').value = lat.toFixed(8);
    document.getElementById('longitude').value = lng.toFixed(8);
    if (marker) map.removeLayer(marker);
    marker = L.marker([lat, lng]).addTo(map);
});

function previewImage(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        let container = input.previousElementSibling;
        if (!container.classList.contains('preview-container')) return;
        container.querySelector('img').src = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>
@endpush
