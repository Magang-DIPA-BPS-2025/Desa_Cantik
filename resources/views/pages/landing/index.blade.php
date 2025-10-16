@extends('layouts.landing.app')
@section('content')

@push('styles')
<style>
/* ---------------- Body ---------------- */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9fafb;
    color: #333;
    margin: 0;
}

/* ---------------- Hero Section ---------------- */
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.5)),
    url('{{ asset("landing/images/slider-main/makassar.jpg") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    padding: 150px 20px;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(124, 181, 24, 0.2), rgba(76, 175, 80, 0.2));
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-section h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #e0f2f1;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease forwards;
}

.hero-section h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #ffffff;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease 0.5s forwards;
}

.hero-section h3 {
    display: inline-block;
    background: linear-gradient(45deg, #7CB518, #4CAF50);
    padding: 10px 22px;
    border-radius: 30px;
    font-size: 18px;
    color: #fff;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease 1s forwards;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Animasi untuk teks muncul satu per satu */
.typing-text {
    overflow: hidden;
    white-space: nowrap;
    margin: 0 auto;
    animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
}

@keyframes typing {
    from { width: 0 }
    to { width: 100% }
}

@keyframes blink-caret {
    from, to { border-color: transparent }
    50% { border-color: #7CB518 }
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Efek partikel di background */
.particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.particle {
    position: absolute;
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: float 15s infinite linear;
}

@keyframes float {
    0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(-100px) rotate(360deg);
        opacity: 0;
    }
}

/* ---------------- Search Section ---------------- */
.search-section {
    background: linear-gradient(135deg, #C0D09D, #2E7D32);
    padding: 40px 20px;
    margin: 40px auto;
    border-radius: 20px;
    max-width: 1200px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.search-container {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.search-title {
    color: white;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: 600;
}

.search-box {
    display: flex;
    gap: 10px;
    max-width: 600px;
    margin: 0 auto;
}

.search-input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    border-radius: 50px;
    font-size: 16px;
    outline: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.search-btn {
    background: #1B5E20;
    color: white;
    border: none;
    padding: 15px 25px;
    border-radius: 50px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.search-btn:hover {
    background: #0D3D1A;
    transform: translateY(-2px);
}

/* ---------------- Pengumuman Slider dengan Foto ---------------- */
.pengumuman-section {
    padding: 80px 20px;
    background: #fff;
}

.pengumuman-container {
    max-width: 1200px;
    margin: 0 auto;
}

.pengumuman-slider {
    position: relative;
    background: #f8f9fa;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.pengumuman-slide {
    display: none;
    animation: fadeIn 0.5s ease;
}

.pengumuman-slide.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.pengumuman-item {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border-left: 5px solid #4CAF50;
    overflow: hidden;
}

.pengumuman-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
}

.pengumuman-content {
    padding: 25px;
}

.pengumuman-title {
    color: #2E7D32;
    font-size: 20px;
    margin-bottom: 10px;
    font-weight: 600;
}

.pengumuman-date {
    color: #666;
    font-size: 14px;
    margin-bottom: 15px;
    display: block;
}

.pengumuman-text {
    color: #555;
    line-height: 1.6;
    margin-bottom: 0;
}

/* ---------------- Navigasi Slider dengan Panah ---------------- */
.pengumuman-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    margin-top: 20px;
}

.pengumuman-arrow {
    background: #4CAF50;
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.pengumuman-arrow:hover {
    background: #388e3c;
    transform: scale(1.1);
}

.pengumuman-dots {
    display: flex;
    gap: 10px;
}

.pengumuman-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #ddd;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pengumuman-dot.active {
    background: #4CAF50;
    transform: scale(1.2);
}

/* ---------------- Jadwal Sholat Section ---------------- */
.jadwal-sholat-section {
    padding: 80px 20px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.jadwal-sholat-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: start;
}

.jadwal-sholat-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.jadwal-sholat-header {
    text-align: center;
    margin-bottom: 30px;
}

.jadwal-sholat-header h3 {
    color: #2E7D32;
    font-size: 24px;
    margin-bottom: 10px;
}

.jadwal-date {
    color: #666;
    font-size: 16px;
    font-weight: 500;
}

.jadwal-location {
    color: #888;
    font-size: 14px;
    margin-top: 5px;
}

.jadwal-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.jadwal-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.jadwal-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.jadwal-item.active {
    background: linear-gradient(135deg, #4CAF50, #2E7D32);
    color: white;
}

.jadwal-name {
    font-weight: 600;
    font-size: 16px;
}

.jadwal-time {
    font-weight: 700;
    font-size: 18px;
}

.jadwal-next {
    background: linear-gradient(135deg, #4CAF50, #2E7D32);
    color: white;
    text-align: center;
    padding: 25px;
    border-radius: 15px;
    margin-top: 20px;
}

.next-prayer {
    font-size: 18px;
    margin-bottom: 10px;
}

.next-time {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
}

.countdown {
    font-size: 14px;
    color: #e0f2f1;
}

/* ---------------- Statistik Slider ---------------- */
.statistik {
    background: linear-gradient(135deg, #C0D09D, #A5C37A);
    padding: 70px 20px;
    text-align: center;
    border-radius: 40px;
    margin: 60px auto;
    width: 95%;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    position: relative;
}

.statistik h2 { 
    margin-bottom: 40px; 
    font-size: 28px; 
    font-weight: 700; 
    color: #1b5e20; 
}

#slider {
    display: flex;
    gap: 20px;
    scroll-behavior: smooth;
    overflow-x: auto;
    padding-bottom: 10px;
}

#slider::-webkit-scrollbar { 
    display: none; 
}

#slider > .item { 
    flex: 0 0 calc(25% - 15px); 
    box-sizing: border-box; 
}

.statistik .item {
    flex: 0 0 auto;
    width: 100%;
    padding: 20px;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    transition: transform .25s ease, box-shadow .25s ease;
    text-align: center;
}

.statistik .item:hover { 
    transform: translateY(-6px); 
    box-shadow: 0 12px 26px rgba(0,0,0,0.12); 
}

.statistik img { 
    width: 64px; 
    margin-bottom: 12px; 
}

.statistik .angka { 
    font-size: 26px; 
    font-weight: 800; 
    color: #2e7d32; 
    margin: 6px 0; 
}

.statistik .label { 
    font-size: 14px; 
    color: #555; 
}

/* Tombol Navigasi Carousel */
.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.8);
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    cursor: pointer;
    font-size: 22px;
    color: #1b5e20;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    transition: all 0.3s;
    z-index: 10;
}

.slider-btn:hover { 
    background: #1b5e20; 
    color: #fff; 
}

.slider-btn.left { 
    left: -20px; 
}

.slider-btn.right { 
    right: -20px; 
}

/* ---------------- Profil Desa ---------------- */
.profil { 
    padding: 70px 20px; 
    display: flex; 
    flex-wrap: wrap; 
    align-items: center; 
    gap: 40px; 
    max-width: 1100px; 
    margin: auto; 
}

.profil-text { 
    flex: 1; 
}

.profil-text h2 { 
    font-size: 32px; 
    margin-bottom: 20px; 
    color: #2e7d32; 
}

.profil-text p { 
    line-height: 1.8; 
}

.profil-img { 
    flex: 1; 
    text-align: center; 
}

.profil-img img { 
    width: 100%; 
    max-width: 450px; 
    border-radius: 20px; 
    cursor: pointer; 
}

/* ---------------- Chart ---------------- */
.chart-section { 
    padding: 60px 20px; 
    background: #fff; 
    text-align: center; 
}

.chart-section h2 { 
    margin-bottom: 30px; 
    color: #2e7d32; 
}

.chart-wrapper { 
    max-width: 450px; 
    margin: auto; 
}

/* ---------------- APB Desa ---------------- */
.apb-desa { 
    padding: 80px 20px; 
    background: #fff; 
}

.apb-container { 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    gap: 40px; 
    flex-wrap: wrap; 
    max-width: 1200px; 
    margin: auto; 
}

.apbdesa-img img { 
    max-width: 400px; 
    cursor: pointer; 
}

.apb-info { 
    flex: 1; 
    min-width: 300px; 
}

.apb-info h2 { 
    color: #2e7d32; 
    font-size: 32px; 
    font-weight: 700; 
    margin-bottom: 15px; 
}

.apb-info p { 
    font-size: 16px; 
    margin-bottom: 25px; 
}

.apb-card { 
    background: #f9f9f9; 
    border-radius: 12px; 
    padding: 18px 25px; 
    margin-bottom: 15px; 
    box-shadow: 0 4px 12px rgba(0,0,0,0.08); 
}

.apb-card span { 
    font-size: 14px; 
    color: #fff; 
}

.apb-card h3 { 
    font-size: 22px; 
    font-weight: 700; 
    margin-top: 8px; 
    color: #fff; 
}

.apb-card.pendapatan { 
    background: linear-gradient(135deg, #4CAF50, #81C784); 
    color: white; 
}

.apb-card.belanja { 
    background: linear-gradient(135deg, #E53935, #EF5350); 
    color: white; 
}

.apb-btn { 
    display:inline-block; 
    text-decoration:none; 
    background:#4CAF50; 
    color:#fff; 
    padding:12px 22px; 
    border-radius:8px; 
    font-weight:600; 
    transition: 0.3s; 
}

.apb-btn:hover { 
    background:#388e3c; 
}

/* ---------------- Section Title ---------------- */
.section-title { 
    text-align:center; 
    color:#2e7d32; 
    margin-bottom:40px; 
    font-size:32px; 
    font-weight:700; 
}

/* ---------------- CONTAINER GRID UNIFORM ---------------- */
.uniform-grid-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

.uniform-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    width: 100%;
}

/* ---------------- CARD UNIFORM ---------------- */
.uniform-card { 
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
}

.uniform-card:hover { 
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

.uniform-card-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
}

.uniform-card-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.uniform-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin: 0 0 10px 0;
    line-height: 1.4;
}

.uniform-card-date {
    font-size: 0.85rem;
    color: #666;
    margin-bottom: 15px;
}

.uniform-card-text {
    font-size: 0.9rem;
    color: #555;
    line-height: 1.5;
    margin-bottom: 15px;
    flex-grow: 1;
}

.uniform-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
    height: 100%;
    width: 100%;
}

/* ---------------- Section Styles ---------------- */
.berita-section {
    background: #f9fafb;
    padding: 80px 0;
}

.agenda-section {
    background: #f9fafb;
    padding: 80px 0;
}

.umkm-section {
    background: #f9fafb;
    padding: 80px 0;
}

.galeri-section {
    background: #f9fafb;
    padding: 80px 0;
}

/* ---------------- Tombol Lihat Semua ---------------- */
.btn-view-all-container { 
    text-align: center; 
    margin-top: 50px;
}

.btn-view-all { 
    background: #4CAF50;
    color: #fff;
    padding: 14px 32px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-view-all:hover { 
    background: #388e3c;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

/* ---------------- Overlay untuk Galeri ---------------- */
.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: opacity 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.uniform-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    font-size: 2rem;
    color: white;
    margin-bottom: 10px;
}

.gallery-overlay small {
    color: white;
    font-weight: 600;
    text-transform: uppercase;
}

/* ---------------- Modal Galeri Custom ---------------- */
.galeri-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    overflow: auto;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.galeri-modal-content {
    position: relative;
    margin: 5% auto;
    width: 90%;
    max-width: 800px;
    animation: zoomIn 0.3s ease;
}

@keyframes zoomIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.galeri-modal-image {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
}

/* Tombol Close Modal */
.galeri-close {
    position: absolute;
    top: -40px;
    right: -40px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    background: rgba(0, 0, 0, 0.5);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: 2px solid #fff;
}

.galeri-close:hover {
    background: #ff4444;
    transform: rotate(90deg);
}

/* ---------------- UMKM Button ---------------- */
.umkm-btn {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: auto;
}

.umkm-btn:hover {
    background: #388e3c;
}

/* ---------------- Responsive Design ---------------- */
@media (max-width: 1024px) { 
    .uniform-grid { 
        grid-template-columns: repeat(2, 1fr); 
    }
    
    #slider > .item { 
        flex: 0 0 33.33%; 
        max-width: 33.33%; 
    } 
}

@media (max-width: 768px) { 
    .uniform-grid { 
        grid-template-columns: 1fr; 
        gap: 20px;
    }
    
    #slider > .item { 
        flex: 0 0 50%; 
        max-width: 50%; 
    }
    
    .slider-btn.left { 
        left: 0; 
    }
    
    .slider-btn.right { 
        right: 0; 
    }
    
    .jadwal-sholat-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .search-box {
        flex-direction: column;
    }
    
    .search-input, .search-btn {
        width: 100%;
    }
    
    .pengumuman-image {
        height: 200px;
    }
    
    .pengumuman-nav {
        gap: 15px;
    }
    
    .pengumuman-arrow {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
    
    .hero-section {
        padding: 100px 20px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }
    
    .hero-section h1 {
        font-size: 36px;
    }
    
    .hero-section h2 {
        font-size: 20px;
    }
    
    .hero-section h3 {
        font-size: 16px;
    }
    
    .galeri-modal-content {
        width: 95%;
        margin: 10% auto;
    }
    
    .galeri-close {
        top: -30px;
        right: -10px;
        width: 40px;
        height: 40px;
        font-size: 30px;
    }
}

@media (max-width: 480px) { 
    #slider > .item { 
        flex: 0 0 100%; 
        max-width: 100%; 
    } 
}
</style>
@endpush

{{-- ---------------- Hero Section ---------------- --}}
<div class="hero-section">
    <div class="particles" id="particles"></div>
    <div class="hero-content">
        <h2 class="typing-text">Selamat Datang di Website Resmi</h2>
        <h1>Desa Cantik Desa Manggalung</h1>
        <h3>Badan Pusat Statistik Sulsel</h3>
    </div>
</div>

{{-- ---------------- Search Section ---------------- --}}
<div class="search-section">
    <div class="search-container">
        <h2 class="search-title">Cari Informasi Desa</h2>
        <div class="search-box">
            <input type="text" class="search-input" placeholder="Ketik kata kunci pencarian...">
            <button class="search-btn">
                <i class="fa fa-search"></i> Cari
            </button>
        </div>
    </div>
</div>

{{-- ---------------- Statistik Section ---------------- --}}
<div class="statistik">
    <h2>Statistik Penduduk Kelurahan Maccini Sombala Tahun 2025</h2>
    <button class="slider-btn left" id="slideLeft"><i class="fa fa-chevron-left"></i></button>
    <button class="slider-btn right" id="slideRight"><i class="fa fa-chevron-right"></i></button>
    <div class="slider-wrapper overflow-hidden">
        <div id="slider">
            {{-- Statistik Items --}}
            <div class="item"><img src="{{ asset('landing/images/icon-image/dusun.png') }}" alt="Dusun"><p class="angka">7</p><p class="label">Dusun</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/rt.png') }}" alt="RT"><p class="angka">23</p><p class="label">RT</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/rw.png') }}" alt="RW"><p class="angka">12</p><p class="label">RW</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/kepalaKeluarga.png') }}" alt="Kepala Keluarga"><p class="angka">2.463</p><p class="label">Kepala Keluarga</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/male.png') }}" alt="Laki-laki"><p class="angka">4.952</p><p class="label">Laki-laki</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/women.png') }}" alt="Perempuan"><p class="angka">4.716</p><p class="label">Perempuan</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/disabi.png') }}" alt="Disabilitas"><p class="angka">4</p><p class="label">Disabilitas</p></div>
            <div class="item"><img src="{{ asset('landing/images/icon-image/family.png') }}" alt="Jumlah Penduduk"><p class="angka">9.668</p><p class="label">Jumlah Penduduk</p></div>
        </div>
    </div>
</div>

{{-- ---------------- Pengumuman Section ---------------- --}}
<div class="pengumuman-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Pengumuman Desa</h2>
        <div class="pengumuman-slider">
            {{-- Slide 1 --}}
            <div class="pengumuman-slide active">
                <div class="pengumuman-item">
                    <img src="{{ asset('landing/images/slider-main/pengumuman1.jpg') }}" alt="Pengumuman 1" class="pengumuman-image">
                    <div class="pengumuman-content">
                        <h3 class="pengumuman-title">Pendaftaran Bantuan Sosial Tahap II</h3>
                        <span class="pengumuman-date"><i class="fa fa-calendar"></i> 15 Maret 2024</span>
                        <p class="pengumuman-text">Pendaftaran bantuan sosial tahap II akan dibuka mulai tanggal 20-25 Maret 2024. Syarat dan ketentuan dapat dilihat di kantor kelurahan.</p>
                    </div>
                </div>
            </div>
            
            {{-- Slide 2 --}}
            <div class="pengumuman-slide">
                <div class="pengumuman-item">
                    <img src="{{ asset('landing/images/slider-main/pengumuman2.jpg') }}" alt="Pengumuman 2" class="pengumuman-image">
                    <div class="pengumuman-content">
                        <h3 class="pengumuman-title">Jadwal Pemadaman Listrik Bergilir</h3>
                        <span class="pengumuman-date"><i class="fa fa-calendar"></i> 12 Maret 2024</span>
                        <p class="pengumuman-text">Akan dilakukan pemadaman listrik bergilir pada tanggal 18 Maret 2024 pukul 09.00-15.00 WITA untuk perawatan jaringan.</p>
                    </div>
                </div>
            </div>
            
            {{-- Slide 3 --}}
            <div class="pengumuman-slide">
                <div class="pengumuman-item">
                    <img src="{{ asset('landing/images/slider-main/pengumuman3.jpg') }}" alt="Pengumuman 3" class="pengumuman-image">
                    <div class="pengumuman-content">
                        <h3 class="pengumuman-title">Kegiatan Kerja Bakti Bersama</h3>
                        <span class="pengumuman-date"><i class="fa fa-calendar"></i> 10 Maret 2024</span>
                        <p class="pengumuman-text">Akan diadakan kerja bakti membersihkan lingkungan desa pada hari Minggu, 24 Maret 2024. Partisipasi warga sangat diharapkan.</p>
                    </div>
                </div>
            </div>

            {{-- Navigasi dengan Panah dan Dots --}}
            <div class="pengumuman-nav">
                <button class="pengumuman-arrow prev-arrow">
                    <i class="fa fa-chevron-left"></i>
                </button>
                
                <div class="pengumuman-dots">
                    <span class="pengumuman-dot active" data-slide="0"></span>
                    <span class="pengumuman-dot" data-slide="1"></span>
                    <span class="pengumuman-dot" data-slide="2"></span>
                </div>
                
                <button class="pengumuman-arrow next-arrow">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ---------------- Jadwal Sholat Section ---------------- --}}
<div class="jadwal-sholat-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Jadwal Sholat</h2>
        <div class="jadwal-sholat-container">
            <div class="jadwal-sholat-card">
                <div class="jadwal-sholat-header">
                    <h3>Jadwal Sholat Hari Ini</h3>
                    <div class="jadwal-date" id="current-date">Senin, 18 Maret 2024</div>
                    <div class="jadwal-location">Lokasi: Kelurahan Maccini Sombala, Makassar</div>
                </div>
                <div class="jadwal-list" id="prayer-times">
                    <!-- Jadwal sholat akan diisi oleh JavaScript -->
                </div>
            </div>
            <div class="jadwal-sholat-card">
                <div class="jadwal-next">
                    <div class="next-prayer">Sholat Berikutnya</div>
                    <div class="next-time" id="next-prayer-time">--:--</div>
                    <div class="next-prayer" id="next-prayer-name">-</div>
                    <div class="countdown" id="countdown">--:--:--</div>
                </div>
                <div style="margin-top: 30px;">
                    <h4 style="color: #2E7D32; margin-bottom: 15px;">Informasi</h4>
                    <p style="color: #666; line-height: 1.6; font-size: 14px;">
                        Jadwal sholat ini dihitung berdasarkan koordinat lokasi Kelurahan Maccini Sombala. 
                        Waktu dapat berbeda ±2 menit tergantung kondisi cuaca dan observasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ---------------- Profil Desa Section ---------------- --}}
<div class="profil">
    <div class="profil-text">
        <h2>Tentang Kelurahan</h2>
        <p>Kelurahan Maccini Sombala merupakan salah satu kelurahan di Kota Makassar yang memiliki potensi besar dalam pembangunan masyarakat. Dengan jumlah penduduk lebih dari <b>9.600 jiwa</b>, wilayah ini terus berkembang dengan berbagai program sosial, pendidikan, serta peningkatan infrastruktur.</p>
    </div>
    <div class="profil-img">
        <img src="{{ asset('landing/images/slider-main/makassar.jpg') }}" alt="Kelurahan" onclick="openModal('{{ asset('landing/images/slider-main/kelurahan.jpg') }}')">
    </div>
</div>

{{-- ---------------- Chart Section ---------------- --}}
<div class="chart-section">
    <h2>Visualisasi Statistik Penduduk</h2>
    <div class="chart-wrapper">
        <canvas id="chartPenduduk"></canvas>
    </div>
</div>

{{-- ---------------- APB Desa Section ---------------- --}}
<div class="apb-desa">
    <div class="apb-container">
        <div class="apbdesa-img">
            <img src="{{ asset('landing/images/slider-main/apbd.png') }}" alt="APBD Desa" onclick="openModal('{{ asset('landing/images/slider-main/apbd.png') }}')">
        </div>
        <div class="apb-info">
            <h2>APB DESA 2024</h2>
            <p>Akses cepat dan transparan terhadap APB Desa serta proyek pembangunan</p>
            <div class="apb-card pendapatan"><span>Pendapatan Desa</span><h3>Rp4.802.205.800,00</h3></div>
            <div class="apb-card belanja"><span>Belanja Desa</span><h3>Rp4.888.222.678,00</h3></div>
            <a href="{{ url('/apbd') }}" class="apb-btn"><i class="fa fa-file-alt"></i> LIHAT DATA LEBIH LENGKAP</a>
        </div>
    </div>
</div>

{{-- ---------------- Berita Section ---------------- --}}
<div class="berita-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Berita Terbaru</h2>
        <div class="uniform-grid">
            @foreach($beritas->take(6) as $berita)
            <a href="{{ route('berita.show', $berita->id) }}" class="uniform-card-link">
                <div class="uniform-card">
                    <img src="{{ $berita->foto ? asset('storage/'.$berita->foto) : asset('img/example-image.jpg') }}" 
                         alt="{{ $berita->judul }}" 
                         class="uniform-card-img">
                    <div class="uniform-card-content">
                        <h4 class="uniform-card-title">{{ Str::limit($berita->judul,50) }}</h4>
                        <small class="uniform-card-date">
                            {{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d M Y') : $berita->created_at->translatedFormat('d M Y') }}
                        </small>
                        <p class="uniform-card-text">{{ Str::limit(strip_tags($berita->isi), 80) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('berita') }}" class="btn-view-all">Lihat Semua Berita</a>
        </div>
    </div>
</div>

{{-- ---------------- Agenda Section ---------------- --}}
<div class="agenda-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Agenda Desa Terbaru</h2>
        <div class="uniform-grid">
            @foreach($latest_agendas->take(6) as $agenda)
            <a href="{{ route('agenda.show', $agenda->id) }}" class="uniform-card-link">
                <div class="uniform-card">
                    <img src="{{ $agenda->foto ? asset('storage/'.$agenda->foto) : asset('img/example-image.jpg') }}" 
                         alt="{{ $agenda->nama_kegiatan }}" 
                         class="uniform-card-img">
                    <div class="uniform-card-content">
                        <h4 class="uniform-card-title">{{ Str::limit($agenda->nama_kegiatan,50) }}</h4>
                        <small class="uniform-card-date">
                            {{ $agenda->waktu_pelaksanaan ? \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->translatedFormat('d M Y') : '' }} 
                            @if($agenda->kategori) | {{ $agenda->kategori }} @endif
                        </small>
                        <p class="uniform-card-text">{{ Str::limit(strip_tags($agenda->deskripsi), 80) }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('agenda') }}" class="btn-view-all">Lihat Semua Agenda</a>
        </div>
    </div>
</div>

{{-- ---------------- UMKM Section ---------------- --}}
<div class="umkm-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">UMKM Desa</h2>
        <div class="uniform-grid">
            @foreach($belanjas->take(6) as $umkm)
            <a href="{{ route('belanja.usershow', $umkm->id) }}" class="uniform-card-link">
                <div class="uniform-card">
                    @if($umkm->foto)
                    <img src="{{ asset('storage/' . $umkm->foto) }}"
                         alt="{{ $umkm->judul }}"
                         class="uniform-card-img">
                    @else
                    <img src="{{ asset('img/default-product.png') }}"
                         alt="Default"
                         class="uniform-card-img">
                    @endif
                    <div class="uniform-card-content">
                        <h4 class="uniform-card-title">{{ $umkm->judul }}</h4>
                        <p class="uniform-card-text">Harga: Rp {{ number_format($umkm->harga,0,',','.') }}</p>
                        <p class="uniform-card-text">Rating: {{ $umkm->rating }} ⭐</p>
                        <button class="umkm-btn">Lihat Detail</button>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('belanja') }}" class="btn-view-all">Lihat Semua UMKM</a>
        </div>
    </div>
</div>

{{-- ---------------- Galeri Section ---------------- --}}
<div class="galeri-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Galeri Desa</h2>
        <div class="uniform-grid">
            @foreach($galeris->take(6) as $galeri)
            <div class="uniform-card position-relative">
                <div class="gallery-item" onclick="openModal('{{ asset('storage/' . $galeri->gambar) }}')" style="cursor: pointer;">
                    <img src="{{ $galeri->gambar ? asset('storage/'.$galeri->gambar) : asset('img/default-image.png') }}" 
                         alt="Galeri Desa"
                         class="uniform-card-img">
                    <div class="gallery-overlay">
                        <i class="fa fa-search-plus"></i>
                        <small>Klik untuk memperbesar</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="btn-view-all-container">
            <a href="{{ route('galeri.user.index') }}" class="btn-view-all">Lihat Semua Galeri</a>
        </div>
    </div>
</div>

{{-- ---------------- Modal Popup Gambar ---------------- --}}
<div id="galeriModal" class="galeri-modal">
    <div class="galeri-modal-content">
        <span class="galeri-close" onclick="closeModal()">&times;</span>
        <img class="galeri-modal-image" id="modalImage">
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// ---------------- Chart Penduduk ----------------
const ctx = document.getElementById('chartPenduduk');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Kepala Keluarga','Laki-laki', 'Perempuan', 'Disabilitas','Jumlah Penduduk'],
        datasets: [{
            data: [2463,4952,4716,4,9668],
            backgroundColor: ['#22c55e', '#60a5fa', '#f97316', '#a78bfa', '#ef4444'],
            borderColor: '#ffffff',
            borderWidth: 2,
            hoverOffset: 8,
            borderRadius: 6
        }]
    },
    options: {
        plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } },
        cutout: '65%'
    }
});

// ---------------- Slider Otomatis ----------------
const slider = document.getElementById('slider');
const leftBtn = document.getElementById('slideLeft');
const rightBtn = document.getElementById('slideRight');
const itemWidth = slider.children[0].offsetWidth + 20;
let autoSlideInterval;

leftBtn.addEventListener('click', ()=>{
    if(slider.scrollLeft<=0) slider.scrollTo({left:slider.scrollWidth, behavior:'smooth'});
    else slider.scrollBy({left:-itemWidth, behavior:'smooth'});
    resetAutoSlide();
});
rightBtn.addEventListener('click', ()=>{
    if(slider.scrollLeft + slider.clientWidth >= slider.scrollWidth-10) slider.scrollTo({left:0, behavior:'smooth'});
    else slider.scrollBy({left:itemWidth, behavior:'smooth'});
    resetAutoSlide();
});

function autoSlide(){
    autoSlideInterval = setInterval(()=>{
        if(slider.scrollLeft + slider.clientWidth >= slider.scrollWidth-10) slider.scrollTo({left:0, behavior:'smooth'});
        else slider.scrollBy({left:itemWidth, behavior:'smooth'});
    },3000);
}
function resetAutoSlide(){ clearInterval(autoSlideInterval); autoSlide(); }
autoSlide();
slider.addEventListener('mouseenter',()=>clearInterval(autoSlideInterval));
slider.addEventListener('mouseleave', autoSlide);

// ---------------- Modal Galeri Functions ----------------
function openModal(imageSrc) {
    const modal = document.getElementById('galeriModal');
    const modalImage = document.getElementById('modalImage');
    
    modal.style.display = 'block';
    modalImage.src = imageSrc;
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('galeriModal');
    modal.style.display = 'none';
    
    // Restore body scroll
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the image
window.addEventListener('click', function(event) {
    const modal = document.getElementById('galeriModal');
    if (event.target === modal) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

// ---------------- Efek Partikel di Hero Section ----------------
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    const particleCount = 20;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        // Random size and position
        const size = Math.random() * 10 + 5;
        const left = Math.random() * 100;
        const animationDuration = Math.random() * 20 + 10;
        const animationDelay = Math.random() * 5;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${left}%`;
        particle.style.animationDuration = `${animationDuration}s`;
        particle.style.animationDelay = `${animationDelay}s`;
        
        particlesContainer.appendChild(particle);
    }
}

// ---------------- Pengumuman Slider Functionality dengan Panah ----------------
let currentSlide = 0;
const slides = document.querySelectorAll('.pengumuman-slide');
const dots = document.querySelectorAll('.pengumuman-dot');
const prevArrow = document.querySelector('.prev-arrow');
const nextArrow = document.querySelector('.next-arrow');
let autoSlideIntervalPengumuman;

function showSlide(n) {
    // Hide all slides
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    // Show current slide
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
    dots[currentSlide].classList.add('active');
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function prevSlide() {
    showSlide(currentSlide - 1);
}

// Auto slide every 5 seconds
function startAutoSlide() {
    autoSlideIntervalPengumuman = setInterval(() => {
        nextSlide();
    }, 5000);
}

// Stop auto slide when user interacts
function stopAutoSlide() {
    clearInterval(autoSlideIntervalPengumuman);
}

// Event listeners for arrows
if (prevArrow) {
    prevArrow.addEventListener('click', () => {
        prevSlide();
        stopAutoSlide();
        startAutoSlide();
    });
}

if (nextArrow) {
    nextArrow.addEventListener('click', () => {
        nextSlide();
        stopAutoSlide();
        startAutoSlide();
    });
}

// Dot click event
dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        showSlide(index);
        stopAutoSlide();
        startAutoSlide();
    });
});

// Start auto slide on page load
startAutoSlide();

// ---------------- Jadwal Sholat Functionality ----------------
async function updatePrayerTimes() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);

    // Ganti dengan koordinat lokasi kamu (Makassar)
    const latitude = -5.1477;
    const longitude = 119.4327;
    const method = 2; // Muslim World League

    const apiUrl = `https://api.aladhan.com/v1/timings/${Math.floor(now.getTime() / 1000)}?latitude=${latitude}&longitude=${longitude}&method=${method}&timezonestring=Asia/Makassar`;

    try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        const timings = data.data.timings;

        const prayerOrder = ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
        const prayerNames = ['Subuh', 'Syuruq', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

        const prayerTimes = prayerOrder.map((key, i) => {
            const time = timings[key]; // format "04:45"
            const [hours, minutes] = time.split(':').map(Number);
            const totalMinutes = hours * 60 + minutes;

            const nowMinutes = now.getHours() * 60 + now.getMinutes();
            const passed = nowMinutes >= totalMinutes;

            return {
                name: prayerNames[i],
                time,
                passed
            };
        });

        displayPrayerTimes(prayerTimes);
    } catch (error) {
        console.error('Gagal mengambil jadwal sholat:', error);
    }
}

function displayPrayerTimes(prayerTimes) {
    const container = document.getElementById('prayer-times');
    container.innerHTML = ''; // Clear existing list

    prayerTimes.forEach(prayer => {
        const li = document.createElement('li');
        li.textContent = `${prayer.name}: ${prayer.time}`;
        if (prayer.passed) li.style.color = 'gray';
        container.appendChild(li);
    });
}

// Jalankan saat halaman dimuat
updatePrayerTimes();

// ---------------- Search Functionality ----------------
document.querySelector('.search-btn').addEventListener('click', function() {
    const searchTerm = document.querySelector('.search-input').value;
    if (searchTerm.trim()) {
        alert(`Mencari: ${searchTerm}`);
        // Here you can implement actual search functionality
        // window.location.href = `/search?q=${encodeURIComponent(searchTerm)}`;
    }
});

document.querySelector('.search-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.querySelector('.search-btn').click();
    }
});

// Initialize everything when page loads
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
    updatePrayerTimes();
    setInterval(updatePrayerTimes, 1000); // Update every second
});
</script>
@endpush
@endsection