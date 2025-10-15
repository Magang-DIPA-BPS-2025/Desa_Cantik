@extends('layouts.app', ['title' => 'Tambah UMKM Baru'])

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem;
    }
    
    .card-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .required::after {
        content: " *";
        color: #dc3545;
    }
    
    #map {
        min-height: 250px;
        border-radius: 8px;
        border: 2px solid #e9ecef;
        margin-bottom: 0.5rem;
    }
    
    .file-preview {
        max-width: 150px;
        max-height: 150px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px dashed #dee2e6;
        display: none;
    }
    
    .preview-container {
        text-align: center;
        margin-bottom: 1rem;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 0.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .card-header h4 {
            font-size: 1.1rem;
        }
        
        .btn-group-mobile {
            flex-direction: column;
        }
        
        .btn-group-mobile .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        #map {
            min-height: 200px;
        }
        
        .file-preview {
            max-width: 120px;
            max-height: 120px;
        }
        
        .form-control, .form-select {
            font-size: 0.9rem;
            padding: 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .card-body {
            padding: 0.75rem;
        }
        
        .card-header {
            padding: 0.75rem;
        }
        
        #map {
            min-height: 150px;
        }
        
        .file-preview {
            max-width: 100px;
            max-height: 100px;
        }
        
        .form-control, .form-select {
            font-size: 0.85rem;
            padding: 0.5rem;
        }
    }

    /* Pastikan semua elemen terlihat */
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-control, .form-select {
        display: block;
        width: 100%;
    }
    
    /* Hilangkan field rating dari create form */
    .rating-field {
        display: none !important;
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah UMKM Baru</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('belanja.index') }}">Data UMKM</a></div>
                <div class="breadcrumb-item active">Tambah UMKM</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-plus-circle mr-2"></i>Form Tambah UMKM Baru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('belanja.store') }}" method="POST" enctype="multipart/form-data" id="umkmForm">
                                @csrf
                                
                                <div class="row">
                                    <!-- Kolom Kiri - Informasi Dasar -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="judul" class="form-label required">Nama UMKM</label>
                                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                                   id="judul" name="judul" value="{{ old('judul') }}" 
                                                   placeholder="Masukkan nama UMKM" required>
                                            @error('judul')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="kategori" class="form-label required">Kategori</label>
                                            <select class="form-select @error('kategori') is-invalid @enderror" 
                                                    id="kategori" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <option value="Makanan & Minuman" {{ old('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                                <option value="Kerajinan Tangan" {{ old('kategori') == 'Kerajinan Tangan' ? 'selected' : '' }}>Kerajinan Tangan</option>
                                                <option value="Pertanian" {{ old('kategori') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                                <option value="Peternakan" {{ old('kategori') == 'Peternakan' ? 'selected' : '' }}>Peternakan</option>
                                                <option value="Jasa" {{ old('kategori') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                                <option value="Retail" {{ old('kategori') == 'Retail' ? 'selected' : '' }}>Retail</option>
                                                <option value="Fashion" {{ old('kategori') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                                <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                            @error('kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pemilik" class="form-label required">Nama Pemilik</label>
                                            <input type="text" class="form-control @error('pemilik') is-invalid @enderror" 
                                                   id="pemilik" name="pemilik" value="{{ old('pemilik') }}" 
                                                   placeholder="Masukkan nama pemilik" required>
                                            @error('pemilik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="wa" class="form-label required">Nomor WhatsApp</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">+62</span>
                                                </div>
                                                <input type="text" class="form-control @error('wa') is-invalid @enderror" 
                                                       id="wa" name="wa" value="{{ old('wa') }}" 
                                                       placeholder="81234567890" required>
                                            </div>
                                            @error('wa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Contoh: 81234567890</small>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan - Informasi Tambahan -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="harga" class="form-label required">Harga Produk</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                                               id="harga" name="harga" value="{{ old('harga') }}" 
                                                               placeholder="0" required min="0">
                                                    </div>
                                                    @error('harga')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- HAPUS FIELD RATING DARI CREATE FORM -->
                                        <!-- Rating akan otomatis 0 dan diisi oleh user nanti -->

                                        <div class="form-group">
                                            <label for="foto" class="form-label">Foto UMKM</label>
                                            <div class="preview-container">
                                                <img id="fotoPreview" class="file-preview" src="" alt="Preview Foto">
                                            </div>
                                            <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                                   id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
                                            @error('foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Format: JPG, PNG, GIF. Maksimal 2MB. Rekomendasi ukuran 800x600px
                                            </small>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jam_buka" class="form-label">Jam Buka</label>
                                                    <input type="time" class="form-control @error('jam_buka') is-invalid @enderror" 
                                                           id="jam_buka" name="jam_buka" value="{{ old('jam_buka') }}">
                                                    @error('jam_buka')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jam_tutup" class="form-label">Jam Tutup</label>
                                                    <input type="time" class="form-control @error('jam_tutup') is-invalid @enderror" 
                                                           id="jam_tutup" name="jam_tutup" value="{{ old('jam_tutup') }}">
                                                    @error('jam_tutup')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Lokasi -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lokasi" class="form-label required">Lokasi (Singkat)</label>
                                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                                   id="lokasi" name="lokasi" value="{{ old('lokasi') }}" 
                                                   placeholder="Contoh: Dusun Manggalung, RT 01" required>
                                            @error('lokasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alamat_lengkap" class="form-label required">Alamat Lengkap</label>
                                            <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                                                      id="alamat_lengkap" name="alamat_lengkap" rows="3" 
                                                      placeholder="Alamat lengkap termasuk nomor rumah, jalan, dll." required>{{ old('alamat_lengkap') }}</textarea>
                                            @error('alamat_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Peta dan Koordinat -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label required">Pilih Lokasi di Peta</label>
                                            <div id="map"></div>
                                            <small class="form-text text-muted">
                                                Klik pada peta untuk menentukan koordinat lokasi UMKM
                                            </small>
                                            @error('latitude')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                            @error('longitude')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitude" class="form-label required">Latitude</label>
                                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" 
                                                   id="latitude" name="latitude" value="{{ old('latitude') }}" required readonly>
                                            @error('latitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitude" class="form-label required">Longitude</label>
                                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" 
                                                   id="longitude" name="longitude" value="{{ old('longitude') }}" required readonly>
                                            @error('longitude')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi -->
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label required">Deskripsi UMKM</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" name="deskripsi" rows="5" 
                                              placeholder="Deskripsikan produk/jasa yang ditawarkan, keunggulan, dan informasi lainnya..." required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="form-group btn-group-mobile">
                                    <div class="d-flex gap-2 flex-column flex-md-row">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="fas fa-save mr-2"></i>Simpan UMKM
                                        </button>
                                        <a href="{{ route('belanja.index') }}" class="btn btn-secondary btn-lg">
                                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Data UMKM
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// Koordinat default (sesuaikan dengan lokasi desa Anda)
const defaultLat = -5.147665;
const defaultLng = 119.432732;

// Inisialisasi peta
const map = L.map('map').setView([defaultLat, defaultLng], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

let marker = null;

// Set default coordinates
document.getElementById('latitude').value = defaultLat;
document.getElementById('longitude').value = defaultLng;

// Tambahkan marker default
marker = L.marker([defaultLat, defaultLng]).addTo(map)
    .bindPopup('Lokasi UMKM Terpilih')
    .openPopup();

// Event klik pada peta
map.on('click', function(e) {
    const { lat, lng } = e.latlng;
    
    // Update input fields
    document.getElementById('latitude').value = lat.toFixed(8);
    document.getElementById('longitude').value = lng.toFixed(8);
    
    // Hapus marker lama jika ada
    if (marker) {
        map.removeLayer(marker);
    }
    
    // Tambahkan marker baru
    marker = L.marker([lat, lng]).addTo(map)
        .bindPopup('Lokasi UMKM Terpilih')
        .openPopup();
});

// Auto-center ke lokasi user (opsional)
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        const userLat = position.coords.latitude;
        const userLng = position.coords.longitude;
        
        // Jika belum ada input koordinat, gunakan lokasi user
        if (!document.getElementById('latitude').value || document.getElementById('latitude').value == defaultLat) {
            document.getElementById('latitude').value = userLat.toFixed(8);
            document.getElementById('longitude').value = userLng.toFixed(8);
            
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([userLat, userLng]).addTo(map)
                .bindPopup('Lokasi UMKM Terpilih')
                .openPopup();
        }
        
        // Center map ke lokasi user
        map.setView([userLat, userLng], 15);
    });
}

// Fungsi preview gambar
function previewImage(input) {
    const preview = document.getElementById('fotoPreview');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
}

// Format nomor WhatsApp
document.getElementById('wa').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Format harga
document.getElementById('harga').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Validasi form
document.getElementById('umkmForm').addEventListener('submit', function(e) {
    const requiredFields = this.querySelectorAll('[required]');
    let valid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            valid = false;
            field.classList.add('is-invalid');
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    if (!valid) {
        e.preventDefault();
        alert('Harap lengkapi semua field yang wajib diisi!');
    }
});
</script>
@endpush