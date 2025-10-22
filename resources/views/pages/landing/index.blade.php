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
    max-width: 100%;
    overflow-x: hidden;
}

/* ---------------- Hero Section ---------------- */
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.5)),
    url('{{ asset("landing/images/slider-main/makassar.jpg") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    padding: 120px 20px;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
    position: relative;
    overflow: hidden;
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
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
    max-width: 800px;
    width: 100%;
}

.hero-section h2 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #e0f2f1;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease forwards;
}

.hero-section h1 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #ffffff;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease 0.5s forwards;
    line-height: 1.2;
}

.hero-section h3 {
    display: inline-block;
    background: linear-gradient(45deg, #7CB518, #4CAF50);
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 16px;
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

/* ---------------- Search Results ---------------- */
.search-results {
    display: none;
    background: white;
    border-radius: 15px;
    padding: 30px;
    margin-top: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.search-results.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

.search-results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.search-results-title {
    color: #2E7D32;
    font-size: 24px;
    font-weight: 600;
    margin: 0;
}

.search-results-count {
    background: #4CAF50;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.search-results-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.search-result-item {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    border-left: 4px solid #4CAF50;
    transition: all 0.3s ease;
    cursor: pointer;
}

.search-result-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.search-result-title {
    color: #2E7D32;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
}

.search-result-category {
    display: inline-block;
    background: #4CAF50;
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 10px;
}

.search-result-text {
    color: #666;
    line-height: 1.5;
    margin-bottom: 0;
}

.search-result-highlight {
    background: #FFEB3B;
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: 600;
}

.no-results {
    text-align: center;
    padding: 40px;
    color: #666;
}

.no-results i {
    font-size: 48px;
    color: #ddd;
    margin-bottom: 15px;
}

.no-results h4 {
    color: #888;
    margin-bottom: 10px;
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

.jadwal-item.next-prayer {
    background: linear-gradient(135deg, #4CAF50, #2E7D32);
    color: white;
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
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
    min-width: 300px;
}

.profil-text h2 { 
    font-size: 32px; 
    margin-bottom: 20px; 
    color: #2e7d32; 
}

.profil-text p { 
    line-height: 1.8; 
    font-size: 16px;
}

.profil-img { 
    flex: 1; 
    text-align: center; 
    min-width: 300px;
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
    font-size: 32px;
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

.apbdesa-img { 
    flex: 1;
    min-width: 300px;
    text-align: center;
}

.apbdesa-img img { 
    max-width: 400px; 
    width: 100%;
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
    line-height: 1.6;
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
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%;
    border: 1px solid #e9ecef;
}

.uniform-card:hover { 
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.uniform-card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
    border-bottom: 1px solid #e9ecef;
}

.uniform-card-content {
    padding: 1.25rem 1.5rem;
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

/* ---------------- UMKM Card Styles ---------------- */
.umkm-card {
    height: 100%;
    border: 1px solid #e9ecef;
    background-color: #fff;
    transition: all 0.3s ease;
    position: relative;
    cursor: pointer;
}

.umkm-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #4CAF50;
}

.umkm-card:active {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Pastikan tombol tidak mewarisi cursor pointer dari parent */
.umkm-btn, .btn-outline-success {
    cursor: pointer !important;
}

/* Efek hover untuk bagian yang bisa diklik */
.umkm-card .uniform-card-content {
    position: relative;
}

/* Tambahan style untuk badge agar tidak mengganggu klik */
.badge-wrapper {
    pointer-events: none;
    z-index: 2;
}

/* Style untuk tombol agar terlihat lebih interaktif */
.umkm-btn, .btn-outline-success {
    position: relative;
    z-index: 3;
    transition: all 0.2s ease;
}

.umkm-btn:hover, .btn-outline-success:hover {
    transform: scale(1.05);
}

/* Overlay effect untuk seluruh card */
.umkm-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(76, 175, 80, 0);
    transition: background 0.3s ease;
    border-radius: 12px;
    pointer-events: none;
}

.umkm-card:hover::after {
    background: rgba(76, 175, 80, 0.05);
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

.info-line {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 6px;
}

.price {
    font-weight: 700;
    color: #28a745;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

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
    text-decoration: none;
    display: inline-block;
    text-align: center;
    width: 100%; /* Pastikan tombol mengambil lebar penuh */
}

.umkm-btn:hover {
    background: #388e3c;
    color: white;
    text-decoration: none;
}

/* ---------------- Tombol WhatsApp ---------------- */
.btn-outline-success {
    background: transparent;
    color: #28a745;
    border: 2px solid #28a745;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    width: 100%; /* Pastikan tombol mengambil lebar penuh */
}

.btn-outline-success:hover {
    background: #28a745;
    color: white;
    text-decoration: none;
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

/* ---------------- Responsive Design ---------------- */
@media (max-width: 1200px) {
    .uniform-grid-container {
        padding: 0 20px;
    }
    
    .jadwal-sholat-container {
        gap: 30px;
    }
}

@media (max-width: 1024px) { 
    .uniform-grid { 
        grid-template-columns: repeat(2, 1fr); 
        gap: 25px;
    }
    
    #slider > .item { 
        flex: 0 0 calc(33.33% - 15px); 
    } 
    
    .profil {
        flex-direction: column;
        text-align: center;
        gap: 30px;
    }
    
    .apb-container {
        flex-direction: column;
        text-align: center;
    }
    
    .apbdesa-img img {
        max-width: 100%;
    }

    /* Hero Section Responsive untuk Tablet */
    .hero-section {
        padding: 100px 20px;
        min-height: 350px;
    }
    
    .hero-section h1 {
        font-size: 32px;
    }
    
    .hero-section h2 {
        font-size: 18px;
    }
    
    .hero-section h3 {
        font-size: 15px;
        padding: 7px 16px;
    }
}

@media (max-width: 768px) { 
    .uniform-grid { 
        grid-template-columns: 1fr; 
        gap: 20px;
    }
    
    .uniform-grid-container {
        padding: 0 15px;
    }
    
    #slider > .item { 
        flex: 0 0 calc(50% - 10px); 
    }
    
    .slider-btn {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
    
    .slider-btn.left { 
        left: 5px; 
    }
    
    .slider-btn.right { 
        right: 5px; 
    }
    
    .jadwal-sholat-container {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .search-box {
        flex-direction: column;
        gap: 15px;
    }
    
    .search-input, .search-btn {
        width: 100%;
        border-radius: 12px;
    }
    
    /* Hero Section Responsive untuk Mobile */
    .hero-section {
        padding: 80px 20px;
        min-height: 300px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        background-attachment: scroll; /* Hindari fixed background di mobile */
    }
    
    .hero-section h1 {
        font-size: 28px;
        line-height: 1.3;
    }
    
    .hero-section h2 {
        font-size: 16px;
    }
    
    .hero-section h3 {
        font-size: 14px;
        padding: 6px 14px;
    }
    
    .section-title {
        font-size: 28px;
        margin-bottom: 30px;
    }
    
    .statistik {
        padding: 50px 15px;
        border-radius: 25px;
        margin: 40px auto;
        width: 90%;
    }
    
    .statistik h2 {
        font-size: 24px;
        margin-bottom: 30px;
    }
    
    .profil {
        padding: 50px 20px;
    }
    
    .profil-text h2 {
        font-size: 28px;
    }
    
    .apb-desa {
        padding: 50px 20px;
    }
    
    .apb-info h2 {
        font-size: 28px;
    }
    
    .berita-section,
    .agenda-section,
    .umkm-section,
    .galeri-section {
        padding: 50px 0;
    }
    
    .search-section {
        margin: 30px auto;
        padding: 30px 20px;
        border-radius: 15px;
    }
    
    .search-title {
        font-size: 24px;
    }
    
    .jadwal-sholat-section {
        padding: 50px 20px;
    }
    
    .jadwal-item {
        padding: 12px 15px;
    }
    
    .jadwal-name {
        font-size: 14px;
    }
    
    .jadwal-time {
        font-size: 16px;
    }
    
    .next-time {
        font-size: 28px;
    }
    
    .galeri-modal-content {
        width: 95%;
        margin: 15% auto;
    }
    
    .galeri-close {
        top: -35px;
        right: 5px;
        width: 35px;
        height: 35px;
        font-size: 25px;
    }
    
    .btn-view-all {
        padding: 12px 25px;
        font-size: 14px;
    }
    
    .uniform-card-img {
        height: 180px;
    }
    
    .uniform-card-content {
        padding: 1rem 1.25rem;
    }
    
    .uniform-card-title {
        font-size: 1rem;
    }
    
    .apb-card {
        padding: 15px 20px;
    }
    
    .apb-card h3 {
        font-size: 20px;
    }

    /* Perbaikan tombol UMKM untuk mobile */
    .umkm-btn, .btn-outline-success {
        width: 100%;
        padding: 10px 16px;
        font-size: 0.9rem;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Container tombol UMKM */
    .d-grid.gap-2 {
        gap: 12px !important;
    }
}

@media (max-width: 576px) {
    .uniform-grid-container {
        padding: 0 10px;
    }
    
    #slider > .item {
        flex: 0 0 calc(100% - 10px);
    }
    
    /* Hero Section Responsive untuk Small Mobile */
    .hero-section {
        padding: 60px 15px;
        min-height: 250px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
    
    .hero-section h1 {
        font-size: 24px;
    }
    
    .hero-section h2 {
        font-size: 14px;
    }
    
    .hero-section h3 {
        font-size: 13px;
        padding: 5px 12px;
    }
    
    .section-title {
        font-size: 24px;
        margin-bottom: 25px;
    }
    
    .statistik {
        padding: 40px 10px;
        border-radius: 20px;
        width: 95%;
    }
    
    .statistik h2 {
        font-size: 20px;
        margin-bottom: 25px;
    }
    
    .statistik .item {
        padding: 15px;
    }
    
    .statistik .angka {
        font-size: 22px;
    }
    
    .statistik .label {
        font-size: 13px;
    }
    
    .statistik img {
        width: 50px;
    }
    
    .profil {
        padding: 40px 15px;
        gap: 25px;
    }
    
    .profil-text h2 {
        font-size: 24px;
    }
    
    .apb-desa {
        padding: 40px 15px;
    }
    
    .apb-info h2 {
        font-size: 24px;
    }
    
    .search-section {
        padding: 25px 15px;
        margin: 25px auto;
    }
    
    .search-title {
        font-size: 20px;
        margin-bottom: 15px;
    }
    
    .jadwal-sholat-section {
        padding: 40px 15px;
    }
    
    .jadwal-sholat-card {
        padding: 20px;
    }
    
    .jadwal-sholat-header h3 {
        font-size: 20px;
    }
    
    .berita-section,
    .agenda-section,
    .umkm-section,
    .galeri-section {
        padding: 40px 0;
    }
    
    .uniform-card-img {
        height: 160px;
    }
    
    .btn-view-all-container {
        margin-top: 35px;
    }
    
    .search-results {
        padding: 20px;
    }
    
    .search-results-title {
        font-size: 20px;
    }
    
    .search-result-item {
        padding: 15px;
    }

    /* Perbaikan tambahan untuk tombol UMKM di mobile kecil */
    .umkm-btn, .btn-outline-success {
        padding: 12px 16px;
        font-size: 0.85rem;
    }
}

@media (max-width: 400px) {
    /* Hero Section Responsive untuk Extra Small Mobile */
    .hero-section {
        padding: 50px 12px;
        min-height: 220px;
    }
    
    .hero-section h1 {
        font-size: 22px;
    }
    
    .hero-section h2 {
        font-size: 13px;
    }
    
    .hero-section h3 {
        font-size: 12px;
        padding: 4px 10px;
    }
    
    .section-title {
        font-size: 22px;
    }
    
    .statistik h2 {
        font-size: 18px;
    }
    
    .profil-text h2,
    .apb-info h2 {
        font-size: 22px;
    }
    
    .jadwal-sholat-header h3 {
        font-size: 18px;
    }
    
    .next-time {
        font-size: 24px;
    }

    /* Perbaikan tombol UMKM untuk mobile sangat kecil */
    .umkm-btn, .btn-outline-success {
        padding: 10px 12px;
        font-size: 0.8rem;
    }
}

/* Optimize images for mobile */
img {
    max-width: 100%;
    height: auto;
}

/* Improve touch targets for mobile */
@media (max-width: 768px) {
    .search-btn,
    .slider-btn,
    .btn-view-all,
    .apb-btn,
    .umkm-btn,
    .btn-outline-success {
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
}

/* Improve text readability on mobile */
@media (max-width: 768px) {
    body {
        font-size: 14px;
        line-height: 1.5;
    }
    
    .uniform-card-text,
    .profil-text p {
        font-size: 14px;
        line-height: 1.6;
    }
}

/* Smooth scrolling for better mobile experience */
@media (prefers-reduced-motion: no-preference) {
    html {
        scroll-behavior: smooth;
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
        
        {{-- Search Results --}}
        <div class="search-results" id="searchResults">
            <div class="search-results-header">
                <h3 class="search-results-title">Hasil Pencarian</h3>
                <span class="search-results-count" id="resultsCount">0 hasil</span>
            </div>
            <div class="search-results-list" id="resultsList">
                {{-- Hasil pencarian akan ditampilkan di sini --}}
            </div>
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
{{-- ---------------- Chart Section ---------------- --}}
<div class="chart-section">
    <h2>Visualisasi Statistik Penduduk</h2>
    <div class="chart-wrapper">
        <canvas id="chartPenduduk"></canvas>
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

{{-- ---------------- Jadwal Sholat Section ---------------- --}}
<div class="jadwal-sholat-section">
    <div class="uniform-grid-container">
        <h2 class="section-title">Jadwal Sholat</h2>
        <div class="jadwal-sholat-container">
            <div class="jadwal-sholat-card">
                <div class="jadwal-sholat-header">
                    <h3>Jadwal Sholat Hari Ini</h3>
                    <div class="jadwal-date" id="current-date">Senin, 18 Maret 2024</div>
                    <div class="jadwal-location">Lokasi: Desa Manggalung, Kabupaten Pangkep</div>
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
                        Jadwal sholat ini dihitung berdasarkan koordinat lokasi Desa Manggalung, Kabupaten Pangkep. 
                        Waktu dapat berbeda ±2 menit tergantung kondisi cuaca dan observasi.
                    </p>
                </div>
            </div>
        </div>
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
            <div class="uniform-card umkm-card" onclick="window.location.href='{{ route('belanja.usershow', $umkm->id) }}'" style="cursor: pointer;" tabindex="0">
                <div class="position-relative">
                    <img src="{{ $umkm->foto ? asset('storage/' . $umkm->foto) : asset('img/default-product.png') }}"
                         alt="{{ $umkm->judul }}" 
                         class="uniform-card-img">

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

                <div class="uniform-card-content">
                    <h4 class="uniform-card-title">{{ $umkm->judul }}</h4>
                    @if($umkm->deskripsi)
                        <p class="uniform-card-text">{{ Str::limit(strip_tags($umkm->deskripsi), 120) }}</p>
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

                    <div class="d-grid gap-2 mt-auto">
                        <a href="{{ route('belanja.usershow', $umkm->id) }}" class="umkm-btn" onclick="event.stopPropagation()">
                            <i class="fas fa-eye me-2"></i>Lihat Detail
                        </a>
                        @if($umkm->wa)
                        <a href="https://wa.me/62{{ ltrim($umkm->wa, '0') }}?text=Halo%20{{ urlencode($umkm->pemilik) }},%20saya%20tertarik%20dengan%20{{ urlencode($umkm->judul) }}."
                           target="_blank" class="btn-outline-success" onclick="event.stopPropagation()">
                           <i class="fab fa-whatsapp me-2"></i>Chat WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        plugins: { 
            legend: { 
                position: 'bottom', 
                labels: { 
                    usePointStyle: true, 
                    padding: 16,
                    font: {
                        size: window.innerWidth < 768 ? 12 : 14
                    }
                } 
            } 
        },
        cutout: '65%',
        responsive: true,
        maintainAspectRatio: true
    }
});

// ---------------- Slider Otomatis ----------------
const slider = document.getElementById('slider');
const leftBtn = document.getElementById('slideLeft');
const rightBtn = document.getElementById('slideRight');
let autoSlideInterval;

function updateItemWidth() {
    if (slider.children.length > 0) {
        return slider.children[0].offsetWidth + 20;
    }
    return 300; // fallback width
}

let itemWidth = updateItemWidth();

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

function resetAutoSlide(){ 
    clearInterval(autoSlideInterval); 
    autoSlide(); 
}

// Initialize slider
autoSlide();
slider.addEventListener('mouseenter',()=>clearInterval(autoSlideInterval));
slider.addEventListener('mouseleave', autoSlide);

// Update item width on resize
window.addEventListener('resize', () => {
    itemWidth = updateItemWidth();
});

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
    const particleCount = window.innerWidth < 768 ? 15 : 20;
    
    // Clear existing particles
    particlesContainer.innerHTML = '';
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        // Random size and position
        const size = Math.random() * 8 + 3;
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

// ---------------- UMKM Card Click Handler ----------------
document.addEventListener('DOMContentLoaded', function() {
    // Handle klik pada card UMKM
    const umkmCards = document.querySelectorAll('.umkm-card');
    
    umkmCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Cek jika yang diklik adalah tombol atau link
            if (e.target.tagName === 'A' || e.target.closest('a') || 
                e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                return; // Biarkan event default untuk tombol/link
            }
            
            // Cari link detail di dalam card
            const detailLink = this.querySelector('a[href*="belanja"]');
            if (detailLink) {
                window.location.href = detailLink.href;
            }
        });
        
        // Tambahkan efek keyboard accessibility
        card.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const detailLink = this.querySelector('a[href*="belanja"]');
                if (detailLink) {
                    window.location.href = detailLink.href;
                }
            }
        });
    });
});

// ---------------- Jadwal Sholat Functionality untuk Kabupaten Pangkep ----------------
async function updatePrayerTimes() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);

    // Koordinat untuk Kabupaten Pangkep, Desa Manggalung
    const latitude = -4.7686;  // Latitude Kabupaten Pangkep
    const longitude = 119.5578; // Longitude Kabupaten Pangkep
    const method = 2; // Muslim World League
    const timezone = 'Asia/Makassar'; // WITA

    // Format tanggal untuk API: DD-MM-YYYY
    const day = String(now.getDate()).padStart(2, '0');
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const year = now.getFullYear();
    const dateString = `${day}-${month}-${year}`;

    // API URL untuk Kabupaten Pangkep
    const apiUrl = `https://api.aladhan.com/v1/timings/${dateString}?latitude=${latitude}&longitude=${longitude}&method=${method}&timezonestring=${timezone}`;

    try {
        const response = await fetch(apiUrl);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.code === 200 && data.data && data.data.timings) {
            const timings = data.data.timings;

            const prayerOrder = ['Fajr', 'Sunrise', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
            const prayerNames = {
                'Fajr': 'Subuh',
                'Sunrise': 'Syuruq', 
                'Dhuhr': 'Dzuhur',
                'Asr': 'Ashar',
                'Maghrib': 'Maghrib',
                'Isha': 'Isya'
            };

            const prayerTimes = prayerOrder.map((key) => {
                const time = timings[key];
                const [hours, minutes] = time.split(':').map(Number);
                const totalMinutes = hours * 60 + minutes;

                const nowMinutes = now.getHours() * 60 + now.getMinutes();
                const passed = nowMinutes >= totalMinutes;

                return {
                    name: prayerNames[key],
                    time: time,
                    passed: passed,
                    totalMinutes: totalMinutes
                };
            });

            displayPrayerTimes(prayerTimes);
            updateNextPrayer(prayerTimes);
            
        } else {
            throw new Error('Data jadwal sholat tidak valid');
        }
    } catch (error) {
        console.error('Gagal mengambil jadwal sholat:', error);
        // Fallback ke jadwal statis untuk Pangkep
        displayFallbackPrayerTimes();
    }
}

function displayPrayerTimes(prayerTimes) {
    const container = document.getElementById('prayer-times');
    container.innerHTML = ''; // Clear existing list

    // Hapus class 'next-prayer' dari semua item sebelumnya
    const existingItems = document.querySelectorAll('.jadwal-item');
    existingItems.forEach(item => item.classList.remove('next-prayer'));

    // Cari sholat berikutnya
    const now = new Date();
    const nowMinutes = now.getHours() * 60 + now.getMinutes();
    let nextPrayerFound = false;

    prayerTimes.forEach(prayer => {
        const div = document.createElement('div');
        div.className = `jadwal-item`;
        
        // Tandai sholat berikutnya dengan warna hijau
        if (!nextPrayerFound && !prayer.passed) {
            div.classList.add('next-prayer');
            nextPrayerFound = true;
        }
        
        const nameSpan = document.createElement('span');
        nameSpan.className = 'jadwal-name';
        nameSpan.textContent = prayer.name;
        
        const timeSpan = document.createElement('span');
        timeSpan.className = 'jadwal-time';
        timeSpan.textContent = prayer.time;
        
        div.appendChild(nameSpan);
        div.appendChild(timeSpan);
        container.appendChild(div);
    });
}

function updateNextPrayer(prayerTimes) {
    const now = new Date();
    const nowMinutes = now.getHours() * 60 + now.getMinutes();
    
    // Cari sholat berikutnya yang belum lewat
    const nextPrayer = prayerTimes.find(prayer => {
        return !prayer.passed;
    });

    if (nextPrayer) {
        document.getElementById('next-prayer-name').textContent = nextPrayer.name;
        document.getElementById('next-prayer-time').textContent = nextPrayer.time;
        
        // Hitung countdown
        const [hours, minutes] = nextPrayer.time.split(':').map(Number);
        const nextPrayerDate = new Date();
        nextPrayerDate.setHours(hours, minutes, 0, 0);
        
        if (nextPrayerDate < now) {
            nextPrayerDate.setDate(nextPrayerDate.getDate() + 1);
        }
        
        updateCountdown(nextPrayerDate);
    } else {
        // Jika semua sholat hari ini sudah lewat, tampilkan sholat pertama besok
        document.getElementById('next-prayer-name').textContent = 'Subuh';
        document.getElementById('next-prayer-time').textContent = prayerTimes[0].time;
        
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(0, 0, 0, 0);
        
        updateCountdown(tomorrow);
    }
}

function updateCountdown(targetDate) {
    function update() {
        const now = new Date();
        const diff = targetDate - now;
        
        if (diff <= 0) {
            // Waktu sholat sudah tiba
            document.getElementById('countdown').textContent = 'Waktu sholat telah tiba';
            updatePrayerTimes(); // Refresh data
            return;
        }
        
        const hours = Math.floor(diff / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('countdown').textContent = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
    
    update();
    setInterval(update, 1000);
}

// Fallback jadwal sholat untuk Kabupaten Pangkep jika API tidak bekerja
function displayFallbackPrayerTimes() {
    const now = new Date();
    const nowMinutes = now.getHours() * 60 + now.getMinutes();
    
    // Jadwal sholat estimasi untuk Kabupaten Pangkep
    const fallbackTimes = [
        { name: 'Subuh', time: '04:45', passed: nowMinutes >= (4*60+45), totalMinutes: 4*60+45 },
        { name: 'Syuruq', time: '06:05', passed: nowMinutes >= (6*60+5), totalMinutes: 6*60+5 },
        { name: 'Dzuhur', time: '12:10', passed: nowMinutes >= (12*60+10), totalMinutes: 12*60+10 },
        { name: 'Ashar', time: '15:25', passed: nowMinutes >= (15*60+25), totalMinutes: 15*60+25 },
        { name: 'Maghrib', time: '18:15', passed: nowMinutes >= (18*60+15), totalMinutes: 18*60+15 },
        { name: 'Isya', time: '19:30', passed: nowMinutes >= (19*60+30), totalMinutes: 19*60+30 }
    ];
    
    displayPrayerTimes(fallbackTimes);
    updateNextPrayer(fallbackTimes);
    
    // Update informasi lokasi
    document.querySelector('.jadwal-location').textContent = 'Lokasi: Desa Manggalung, Kabupaten Pangkep (Data Estimasi)';
    
    // Update informasi di card kanan
    const infoElement = document.querySelector('.jadwal-sholat-card:last-child p');
    if (infoElement) {
        infoElement.innerHTML = 'Jadwal sholat ini dihitung berdasarkan koordinat lokasi Desa Manggalung, Kabupaten Pangkep. Waktu dapat berbeda ±2 menit tergantung kondisi cuaca dan observasi. <strong>Menggunakan data estimasi.</strong>';
    }
}

// ---------------- Search Functionality dengan jQuery ----------------
$(document).ready(function() {
    const $searchInput = $('.search-input');
    const $searchBtn = $('.search-btn');
    const $searchResults = $('#searchResults');
    const $resultsList = $('#resultsList');
    const $resultsCount = $('#resultsCount');

    // Data untuk pencarian
    const searchData = {
        beritas: [
            @foreach($beritas as $berita)
            {
                id: {{ $berita->id }},
                title: "{{ addslashes($berita->judul) }}",
                content: "{{ addslashes(strip_tags($berita->isi)) }}",
                category: "Berita",
                date: "{{ $berita->tanggal_event ? \Carbon\Carbon::parse($berita->tanggal_event)->translatedFormat('d M Y') : $berita->created_at->translatedFormat('d M Y') }}",
                url: "{{ route('berita.show', $berita->id) }}",
                image: "{{ $berita->foto ? asset('storage/'.$berita->foto) : asset('img/example-image.jpg') }}"
            },
            @endforeach
        ],
        agendas: [
            @foreach($latest_agendas as $agenda)
            {
                id: {{ $agenda->id }},
                title: "{{ addslashes($agenda->nama_kegiatan) }}",
                content: "{{ addslashes(strip_tags($agenda->deskripsi)) }}",
                category: "Agenda",
                date: "{{ $agenda->waktu_pelaksanaan ? \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->translatedFormat('d M Y') : '' }}",
                url: "{{ route('agenda.show', $agenda->id) }}",
                image: "{{ $agenda->foto ? asset('storage/'.$agenda->foto) : asset('img/example-image.jpg') }}"
            },
            @endforeach
        ],
        umkms: [
            @foreach($belanjas as $umkm)
            {
                id: {{ $umkm->id }},
                title: "{{ addslashes($umkm->judul) }}",
                content: "{{ addslashes(strip_tags($umkm->deskripsi)) }}",
                category: "UMKM",
                date: "",
                url: "{{ route('belanja.usershow', $umkm->id) }}",
                image: "{{ $umkm->foto ? asset('storage/' . $umkm->foto) : asset('img/default-product.png') }}",
                price: "Rp {{ number_format($umkm->harga, 0, ',', '.') }}",
                pemilik: "{{ addslashes($umkm->pemilik) }}"
            },
            @endforeach
        ],
    };

    // Fungsi pencarian
    function performSearch(query) {
        if (!query.trim()) {
            hideSearchResults();
            return;
        }

        const results = [];
        const searchTerms = query.toLowerCase().split(' ').filter(term => term.length > 2);

        // Cari di semua kategori
        Object.keys(searchData).forEach(category => {
            searchData[category].forEach(item => {
                const searchableText = (item.title + ' ' + item.content + ' ' + (item.pemilik || '')).toLowerCase();
                const matches = searchTerms.some(term => searchableText.includes(term));
                
                if (matches) {
                    // Hitung relevansi
                    let relevance = 0;
                    searchTerms.forEach(term => {
                        if (item.title.toLowerCase().includes(term)) relevance += 3;
                        if (item.content.toLowerCase().includes(term)) relevance += 1;
                        if (item.pemilik && item.pemilik.toLowerCase().includes(term)) relevance += 2;
                    });
                    
                    results.push({
                        ...item,
                        relevance: relevance,
                        matches: searchTerms.filter(term => searchableText.includes(term))
                    });
                }
            });
        });

        // Urutkan berdasarkan relevansi
        results.sort((a, b) => b.relevance - a.relevance);
        displaySearchResults(results, query);
    }

    // Tampilkan hasil pencarian
    function displaySearchResults(results, query) {
        $resultsList.empty();
        
        if (results.length === 0) {
            $resultsList.html(`
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h4>Tidak ada hasil ditemukan</h4>
                    <p>Tidak ada hasil untuk "<strong>${query}</strong>". Coba dengan kata kunci lain.</p>
                </div>
            `);
        } else {
            results.forEach(result => {
                const highlightedTitle = highlightText(result.title, query);
                const highlightedContent = highlightText(result.content.substring(0, 150) + '...', query);
                
                const resultItem = `
                    <div class="search-result-item" onclick="window.location.href='${result.url}'" style="cursor: pointer;">
                        <span class="search-result-category">${result.category}</span>
                        <h4 class="search-result-title">${highlightedTitle}</h4>
                        ${result.date ? `<small><i class="fas fa-calendar"></i> ${result.date}</small>` : ''}
                        <p class="search-result-text">${highlightedContent}</p>
                        ${result.price ? `<div class="price">${result.price}</div>` : ''}
                    </div>
                `;
                $resultsList.append(resultItem);
            });
        }

        $resultsCount.text(`${results.length} hasil`);
        $searchResults.addClass('active');
        
        // Scroll ke hasil pencarian
        $('html, body').animate({
            scrollTop: $searchResults.offset().top - 100
        }, 500);
    }

    // Fungsi untuk highlight teks
    function highlightText(text, query) {
        const searchTerms = query.toLowerCase().split(' ').filter(term => term.length > 2);
        let highlightedText = text;
        
        searchTerms.forEach(term => {
            const regex = new RegExp(`(${term})`, 'gi');
            highlightedText = highlightedText.replace(regex, '<span class="search-result-highlight">$1</span>');
        });
        
        return highlightedText;
    }

    // Sembunyikan hasil pencarian
    function hideSearchResults() {
        $searchResults.removeClass('active');
    }

    // Event handlers
    $searchBtn.on('click', function() {
        const query = $searchInput.val().trim();
        performSearch(query);
    });

    $searchInput.on('keypress', function(e) {
        if (e.which === 13) {
            const query = $searchInput.val().trim();
            performSearch(query);
        }
    });

    $searchInput.on('input', function() {
        const query = $(this).val().trim();
        if (query.length === 0) {
            hideSearchResults();
        } else if (query.length >= 3) {
            // Debounce search
            clearTimeout($(this).data('timeout'));
            $(this).data('timeout', setTimeout(() => {
                performSearch(query);
            }, 500));
        }
    });

    // Klik di luar untuk menutup hasil pencarian
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.search-container').length) {
            hideSearchResults();
        }
    });

    // Prevent hiding when clicking inside search results
    $searchResults.on('click', function(e) {
        e.stopPropagation();
    });
});

// Initialize everything when page loads
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
    updatePrayerTimes();
    
    // Recreate particles on resize
    window.addEventListener('resize', createParticles);
});

// Handle window resize for better responsiveness
window.addEventListener('resize', function() {
    // Update any layout-dependent calculations
    if (typeof updateItemWidth === 'function') {
        updateItemWidth();
    }
});

// Auto refresh jadwal sholat setiap 1 menit
setInterval(updatePrayerTimes, 60000);
</script>
@endpush
@endsection