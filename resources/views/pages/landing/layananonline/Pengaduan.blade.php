@extends('layouts.landing.app')

@section('content')
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
/* Terapkan font modern */
body, .pengaduan-container, .card, .form-control, .form-label, small, p {
    font-family: 'Open Sans', sans-serif;
}

h2, h5, .fw-bold, .step-title, .btn-submit {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

/* Container khusus halaman pengaduan */
.pengaduan-container {
    max-width: 1400px;
    margin: 30px auto;
    padding: 0 15px;
}

.card {
    background-color: #ffffff;
    border-radius: 15px;
    /* Shadow dikurangi */
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    padding: 30px;
    margin-bottom: 60px; /* Jarak card ke bawah dikurangi */
    transition: transform 0.3s, box-shadow 0.3s;
    border: none;
}

.card:hover {
    transform: translateY(-2px);
    /* Shadow hover juga dikurangi */
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

/* Header Section - Posisi kiri seperti halaman sejarah */
.gallery-header {
    margin-bottom: 2rem; /* Jarak judul ke steps dikurangi */
    margin-top: -1rem;
    text-align: left;
}

.gallery-title {
    font-size: 2.8rem;
    font-weight: 600;
    color: #2E7D32;
    line-height: 1.1;
    margin-bottom: 0.5rem;
}

.gallery-header p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 0;
    line-height: 1.6;
}

p {
    color: #555;
    line-height: 1.6;
}

/* Steps Container - Jarak ke form dikurangi */
.steps-container {
    margin: 2rem 0; /* Jarak steps dikurangi */
    padding: 1.5rem 0;
}

.steps-row {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-wrap: nowrap;
    gap: 30px; /* Jarak antar step diperbesar */
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding: 15px 0; /* Padding atas-bawah diperbesar */
}

.step-item {
    flex: 0 0 auto;
    text-align: center;
    min-width: 150px; /* Minimum width diperbesar */
}

.icon-step {
    width: 120px; /* Ukuran icon diperbesar */
    height: 120px; /* Ukuran icon diperbesar */
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    transition: transform 0.3s;
    background: #f8f9fa;
    border-radius: 20px; /* Border radius diperbesar */
    padding: 20px; /* Padding icon diperbesar */
    /* Shadow icon dikurangi */
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.icon-step img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 10px;
    object-fit: contain;
}

.icon-step:hover {
    transform: scale(1.05); /* Efek hover dikurangi */
}

.step-title {
    margin-top: 20px; /* Jarak title dari icon diperbesar */
    font-weight: 600;
    color: #2E7D32;
    font-size: 1rem; /* Font size title diperbesar */
    line-height: 1.3;
}

.btn-submit {
    border-radius: 10px;
    padding: 14px 0;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s;
    background: linear-gradient(135deg, #1B5E20, #388E3C);
    border: none;
    color: white;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #1B5E20, #388E3C);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
}

/* Form styling */
.form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 12px 15px;
    font-size: 14px;
    transition: all 0.3s;
    font-family: 'Open Sans', sans-serif;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* Section headers */
.section-header {
    color: #2E7D32;
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .step-item {
        min-width: 140px;
    }
    
    .icon-step {
        width: 110px;
        height: 110px;
        padding: 18px;
    }
}

@media (max-width: 992px) {
    .step-item {
        min-width: 130px;
    }
    
    .icon-step {
        width: 100px;
        height: 100px;
        padding: 16px;
    }
    
    .step-title {
        font-size: 0.95rem;
    }
}

@media (max-width: 768px) {
    .gallery-title {
        font-size: 2.2rem;
    }
    
    .gallery-header p {
        font-size: 1rem;
    }
    
    .steps-container {
        margin: 1.5rem 0; /* Jarak steps di mobile dikurangi */
        padding: 1rem 0;
    }
    
    .steps-row {
        gap: 25px; /* Jarak antar step di mobile */
        padding: 10px 0;
    }
    
    .step-item {
        min-width: 120px;
    }
    
    .icon-step {
        width: 90px;
        height: 90px;
        padding: 15px;
    }
    
    .step-title {
        font-size: 0.85rem;
        margin-top: 15px;
    }
    
    .card {
        padding: 20px;
        margin-bottom: 30px; /* Jarak card di mobile dikurangi */
    }
    
    .btn-submit {
        padding: 12px 0;
        font-size: 15px;
    }
}

@media (max-width: 576px) {
    .gallery-title {
        font-size: 1.8rem;
    }
    
    .gallery-header {
        margin-bottom: 1.5rem; /* Jarak judul di mobile dikurangi */
    }
    
    .gallery-header p {
        font-size: 0.9rem;
    }
    
    .pengaduan-container {
        padding: 0 10px;
    }
    
    .steps-row {
        gap: 20px;
        justify-content: space-between;
    }
    
    .step-item {
        min-width: 110px;
        flex: 1;
    }
    
    .icon-step {
        width: 80px;
        height: 80px;
        padding: 12px;
    }
    
    .step-title {
        font-size: 0.8rem;
        margin-top: 12px;
    }
    
    .section-header {
        font-size: 1.1rem;
    }
    
    .card {
        margin-bottom: 25px; /* Jarak card di mobile kecil dikurangi */
    }
}

@media (max-width: 480px) {
    .steps-row {
        gap: 15px;
    }
    
    .step-item {
        min-width: 100px;
    }
    
    .icon-step {
        width: 75px;
        height: 75px;
        padding: 10px;
    }
    
    .step-title {
        font-size: 0.75rem;
        margin-top: 10px;
    }
}

@media (max-width: 400px) {
    .steps-row {
        gap: 12px;
    }
    
    .step-item {
        min-width: 90px;
    }
    
    .icon-step {
        width: 70px;
        height: 70px;
        padding: 8px;
    }
    
    .step-title {
        font-size: 0.7rem;
    }
}

/* Custom file input */
.form-control[type="file"] {
    padding: 10px 15px;
}

/* Success message styling */
.alert-success {
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    font-family: 'Open Sans', sans-serif;
}

/* Hide scrollbar for steps row but keep functionality */
.steps-row::-webkit-scrollbar {
    display: none;
}

.steps-row {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Tambahan untuk memperbaiki layout secara keseluruhan */
.step-item {
    transition: all 0.3s ease;
}

.step-item:hover .icon-step {
    background: #e9f5e9;
}

/* Perbaikan spacing untuk form sections */
.col-md-6.mb-4 {
    margin-bottom: 2rem !important;
}

/* Perbaikan untuk tombol submit */
.text-center.mt-4 {
    margin-top: 2rem !important;
}
</style>

<div class="pengaduan-container mt-4">

    {{-- Header --}}
    <div class="text-start mb-4 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            PENGADUAN MASYARAKAT</h2>
        <p class="text-secondary fs-5 mb-0">
            Sistem terbuka untuk menyuarakan permasalahan dan memperbaiki pelayanan. Kami mendengar, bertindak, dan membangun solusi bersama untuk meningkatkan kualitas hidup
        </p>
    </div>

    {{-- Langkah-langkah --}}
    <div class="steps-container">
        <div class="steps-row">
            <div class="step-item">
                <div class="icon-step">
                    <img src="{{ asset('landing/images/footer/formulir.png') }}" alt="Isi Formulir">
                </div>
                <p class="step-title">Isi Formulir</p>
            </div>
            <div class="step-item">
                <div class="icon-step">
                    <img src="{{ asset('landing/images/footer/bukti.png') }}" alt="Unduh Bukti Laporan">
                </div>
                <p class="step-title">Unduh Bukti Laporan</p>
            </div>
            <div class="step-item">
                <div class="icon-step">
                    <img src="{{ asset('landing/images/footer/monitoring.png') }}" alt="Lakukan Monitoring">
                </div>
                <p class="step-title">Lakukan Monitoring</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="card">
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- A. Data Diri --}}
                <div class="col-md-6 mb-4">
                    <h5 class="section-header">A. DATA DIRI</h5>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Alamat Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" placeholder="62..." required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Lengkap" rows="3" required></textarea>
                    </div>
                    <small class="text-muted">Data diri pelapor dijamin kerahasiaannya oleh pemerintah desa</small>
                </div>

                {{-- B. Uraian Pengaduan --}}
                <div class="col-md-6 mb-4">
                    <h5 class="section-header">B. URAIAN PENGADUAN</h5>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Pengaduan</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan Judul Pengaduan" required>
                    </div>
                    <div class="mb-3">
                        <label for="uraian" class="form-label">Uraian Lengkap</label>
                        <textarea name="uraian" id="uraian" class="form-control" placeholder="Jelaskan secara detail pengaduan Anda..." rows="6" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran (Jika ada)</label>
                        <input type="file" name="lampiran" id="lampiran" class="form-control">
                        <small class="text-muted">Unggah dokumen pendukung (foto, PDF, dll.) - Maks. 5MB</small>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-submit w-100 py-3">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation enhancement
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    
    inputs.forEach(input => {
        input.addEventListener('invalid', function(e) {
            e.preventDefault();
            this.classList.add('is-invalid');
            
            // Custom validation message
            if (this.validity.valueMissing) {
                this.setCustomValidity('Field ini wajib diisi');
            } else if (this.validity.typeMismatch) {
                this.setCustomValidity('Format tidak valid');
            }
        });
        
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            this.setCustomValidity('');
        });
    });

    // File size validation
    const fileInput = document.getElementById('lampiran');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.size > 5 * 1024 * 1024) { // 5MB limit
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                this.value = '';
            }
        });
    }

    // Ensure steps row is properly centered on all devices
    const stepsRow = document.querySelector('.steps-row');
    if (stepsRow) {
        const updateStepsLayout = () => {
            const containerWidth = document.querySelector('.pengaduan-container').offsetWidth;
            const stepsWidth = stepsRow.scrollWidth;
            
            if (stepsWidth < containerWidth) {
                stepsRow.style.justifyContent = 'center';
            } else {
                stepsRow.style.justifyContent = 'flex-start';
            }
        };

        updateStepsLayout();
        window.addEventListener('resize', updateStepsLayout);
    }

    // Add smooth animation for steps
    const stepItems = document.querySelectorAll('.step-item');
    stepItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 200);
    });
});
</script>
@endsection