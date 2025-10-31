@extends('layouts.landing.app')

@section('content')

@push('styles')
<style>
/* ---------------- Body ---------------- */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8fafc;
    color: #333;
    margin: 0;
    max-width: 100%;
    overflow-x: hidden;
}

/* ---------------- Hero Section dengan Search ---------------- */
.hero-section {
    background: 
        linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.3)),
        url('{{ asset("landing/images/slider-main/makassar.png") }}') center/cover no-repeat;
    color: white;
    text-align: center;
    padding: 120px 20px;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
    position: relative;
    overflow: hidden;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
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
    color: #f8fafc;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.8), 0 0 20px rgba(0,0,0,0.6);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease forwards;
    font-weight: 600;
}

.hero-section h1 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 40px;
    color: #ffffff;
    text-shadow: 3px 3px 12px rgba(0,0,0,0.9), 0 0 30px rgba(0,0,0,0.7);
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease 0.5s forwards;
    line-height: 1.2;
}

.hero-section h3 {
    display: inline-block;
    background: linear-gradient(135deg, #2E7D32, #2E7D32);
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 16px;
    color: #fff;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.8s ease 1s forwards;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* ---------------- Search Box di Hero ---------------- */
.hero-search {
    max-width: 500px;
    margin: 0 auto;
    position: relative;
}

.hero-search-box {
    display: flex;
    gap: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50px;
    padding: 5px;
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.hero-search-input {
    flex: 1;
    padding: 15px 20px;
    border: none;
    border-radius: 50px 0 0 50px;
    font-size: 16px;
    outline: none;
    background: transparent;
    color: #333;
}

.hero-search-input::placeholder {
    color: #666;
}

.hero-search-btn {
    background: linear-gradient(135deg, #2E7D32, #2E7D32);
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 50px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    aspect-ratio: 1/1;
}

.hero-search-btn:hover {
    background: linear-gradient(135deg, #2E7D32, #2E7D32);
    transform: scale(1.05);
}

/* Animasi untuk teks muncul satu per satu */
@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ---------------- Search Results ---------------- */
.search-results {
    display: none;
    background: white;
    border-radius: 15px;
    padding: 30px;
    margin-top: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    max-height: 400px;
    overflow-y: auto;
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
    border-bottom: 2px solid #f8fafc;
}

.search-results-title {
    color: #2E7D32;
    font-size: 24px;
    font-weight: 600;
    margin: 0;
}

.search-results-count {
    background: #2E7D32;
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
    background: #f8fafc;
    border-radius: 10px;
    padding: 20px;
    border-left: 4px solid #2E7D32;
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
    background: #2E7D32;
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

/* ---------------- Statistik Slider ---------------- */
.statistik {
    background: linear-gradient(135deg, #C0D09D, #2E7D32);
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
    color: #ffffffff; 
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
    background: #f8fafc;
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
    color: #2E7D32;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    transition: all 0.3s;
    z-index: 10;
}

.slider-btn:hover { 
    background: #2E7D32; 
    color: #f8fafc; 
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
    background: #f8fafc; 
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
    background: #f8fafc; 
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
    transition: all 0.3s ease;
}

.apbdesa-img img:hover {
    transform: scale(1.05);
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
    background: #f8fafc; 
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
    background: linear-gradient(135deg, #2E7D32, #2E7D32); 
    color: white; 
}

.apb-card.belanja { 
    background: linear-gradient(135deg, #E53935, #EF5350); 
    color: white; 
}

.apb-btn { 
    display:inline-block; 
    text-decoration:none; 
    background:#2E7D32; 
    color:#fff; 
    padding:12px 22px; 
    border-radius:8px; 
    font-weight:600; 
    transition: 0.3s; 
}

.apb-btn:hover { 
    background:#2E7D32; 
}

/* ---------------- Section Title ---------------- */
.section-title { 
    text-align:center; 
    color:#2e7d32; 
    margin-bottom:40px; 
    font-size:32px; 
    font-weight:700; 
}

/* ---------------- Jadwal Sholat Section ---------------- */
.jadwal-sholat-section {
    background: #f8fafc;
    padding: 80px 20px;
}

.jadwal-sholat-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}

.jadwal-sholat-card {
    background: #f8fafc;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.jadwal-sholat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.08);
}

.jadwal-sholat-header {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 25px;
    border-bottom: 2px solid #e9ecef;
}

.jadwal-sholat-header h3 {
    color: #2E7D32;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 15px;
}

.jadwal-date {
    font-size: 18px;
    color: #2E7D32;
    font-weight: 600;
    margin-bottom: 10px;
}

.jadwal-location {
    font-size: 14px;
    color: #666;
    background: #f8f9fa;
    padding: 8px 16px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}

.current-time {
    font-size: 14px;
    color: #2E7D32;
    font-weight: 600;
    background: #f8f9fa;
    padding: 8px 16px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

#live-clock {
    font-family: 'Courier New', monospace;
    font-weight: 700;
    color: #2E7D32;
}

.jadwal-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.jadwal-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 20px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
    border-left: 5px solid #e9ecef;
    position: relative;
    overflow: hidden;
}

.jadwal-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(46, 125, 50, 0.1), transparent);
    transition: left 0.5s ease;
}

.jadwal-item:hover::before {
    left: 100%;
}

/* Perbaikan untuk sholat aktif */
.jadwal-item.active {
    background: linear-gradient(135deg, #2E7D32, #2E7D32) !important;
    color: white !important;
    border-left-color: #2E7D32 !important;
    transform: translateX(5px);
    box-shadow: 0 3px 10px rgba(46, 125, 50, 0.3);
}

.jadwal-item.active .jadwal-name,
.jadwal-item.active .jadwal-time {
    color: white !important;
}

.jadwal-item.active .jadwal-time {
    background: rgba(255,255,255,0.2) !important;
    color: white !important;
    border-color: rgba(255,255,255,0.3) !important;
}

/* Pastikan sholat yang sudah lewat tetap terlihat */
.jadwal-item.passed {
    opacity: 0.7;
    background: #f1f3f4 !important;
    color: #666 !important;
}

.jadwal-item.passed .jadwal-time {
    background: #e9ecef !important;
    color: #666 !important;
}

.jadwal-name {
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.jadwal-name i {
    font-size: 18px;
    width: 20px;
    text-align: center;
}

.jadwal-time {
    font-weight: 700;
    font-size: 18px;
    font-family: 'Courier New', monospace;
    background: rgba(255,255,255,0.9);
    padding: 8px 14px;
    border-radius: 8px;
    color: #2E7D32;
    border: 2px solid #e9ecef;
}

.jadwal-item.active .jadwal-time {
    background: rgba(255,255,255,0.2);
    color: white;
    border-color: rgba(255,255,255,0.3);
}

.jadwal-item.passed .jadwal-time {
    background: #e9ecef;
    color: #666;
}

/* Card Sholat Berikutnya */
.jadwal-next {
    background: linear-gradient(135deg, #2E7D32, #2E7D32);
    border-radius: 16px;
    padding: 30px 25px;
    color: white;
    text-align: center;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(46, 125, 50, 0.2);
    position: relative;
    overflow: hidden;
}

.jadwal-next::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.05); opacity: 0.7; }
}

.next-prayer-label {
    font-size: 16px;
    margin-bottom: 15px;
    opacity: 0.9;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-weight: 500;
}

.next-prayer-info {
    position: relative;
    z-index: 2;
}

.next-prayer-name {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #FFEB3B;
}

.next-time {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 15px;
    font-family: 'Courier New', monospace;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
    color: white;
}

.countdown-container {
    background: rgba(255,255,255,0.2);
    padding: 12px 16px;
    border-radius: 10px;
    backdrop-filter: blur(10px);
}

.countdown-label {
    font-size: 12px;
    margin-bottom: 5px;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.countdown {
    font-size: 18px;
    font-weight: 700;
    color: #FFEB3B;
    font-family: 'Courier New', monospace;
}

.jadwal-info {
    margin-top: 25px;
    padding-top: 20px;
    border-top: 2px solid #e9ecef;
}

.jadwal-info h4 {
    color: #2E7D32;
    font-size: 18px;
    margin-bottom: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.jadwal-info p {
    color: #666;
    line-height: 1.6;
    font-size: 14px;
    margin: 0;
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
    border-color: #ffffffff;
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
    background: rgba(46, 125, 50, 0);
    transition: background 0.3s ease;
    border-radius: 12px;
    pointer-events: none;
}

.umkm-card:hover::after {
    background: rgba(46, 125, 50, 0.05);
}

.badge {
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 6px;
    padding: 0.35em 0.65em;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.badge-category {
    background: #2E7D32;
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
    color: #2E7D32;
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.umkm-btn {
    background: #2E7D32;
    color: white;
    border: none;
    padding: 12px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: auto;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    width: 100%;
    margin-bottom: 10px;
}

.umkm-btn:hover {
    background: #2E7D32;
    color: white;
    text-decoration: none;
}

/* ---------------- Tombol WhatsApp ---------------- */
.btn-outline-success {
    background: transparent;
    color: #2E7D32;
    border: 2px solid #2E7D32;
    padding: 12px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    width: 100%;
}

.btn-outline-success:hover {
    background: #2E7D32;
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
    background: #2E7D32;
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
    background: #2E7D32;
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

/* ---------------- PERBAIKAN RESPONSIVE MOBILE ---------------- */

/* Tablet dan Mobile Landscape */
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
        text-align: left;
        gap: 30px;
    }
    
    .apb-container {
        flex-direction: column;
        text-align: left;
    }
    
    .apbdesa-img img {
        max-width: 100%;
    }

    /* Hero Section Responsive untuk Tablet */
    .hero-section {
        padding: 100px 20px;
        min-height: 450px;
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
    
    .hero-search {
        max-width: 450px;
    }
    
    /* PERBAIKAN TOMBOL PENCARIAN TABLET - TOMBOL BULAT */
    .hero-search-btn {
        border-radius: 50% !important;
        min-width: 50px !important;
        aspect-ratio: 1/1;
        padding: 12px !important;
    }
    
    .jadwal-sholat-container {
        grid-template-columns: 1fr;
    }
}

/* Mobile Portrait */
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
    
    /* PERBAIKAN HERO SEARCH MOBILE - Tombol Bulat */
    .hero-search-box {
        flex-direction: row !important;
        gap: 0 !important;
        border-radius: 50px !important;
        padding: 4px !important;
    }
    
    .hero-search-input {
        border-radius: 50px 0 0 50px !important;
        padding: 12px 16px !important;
        font-size: 14px !important;
    }
    
    .hero-search-btn {
        border-radius: 50% !important;
        padding: 12px !important;
        min-height: auto !important;
        min-width: 50px !important;
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-search-btn i {
        font-size: 14px !important;
    }
    
    /* Hero Section Responsive untuk Mobile */
    .hero-section {
        padding: 80px 20px;
        min-height: 400px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }
    
    .hero-section h1 {
        font-size: 28px;
        line-height: 1.3;
        margin-bottom: 30px;
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
    
    /* PERBAIKAN PROFIL MOBILE - Rata Kiri */
    .profil {
        padding: 50px 20px;
        text-align: left;
    }
    
    .profil-text {
        text-align: left;
    }
    
    .profil-text h2 {
        font-size: 28px;
        text-align: left;
    }
    
    .profil-text p {
        text-align: left;
        line-height: 1.6;
    }
    
    .profil-img {
        text-align: center;
    }
    
    /* PERBAIKAN APB DESA MOBILE - Side by Side */
    .apb-desa {
        padding: 50px 20px;
    }
    
    .apb-container {
        flex-direction: row !important;
        align-items: flex-start;
        gap: 20px;
        text-align: left;
    }
    
    .apbdesa-img {
        flex: 0 0 120px;
        min-width: 120px;
        text-align: center;
    }
    
    .apbdesa-img img {
        max-width: 100px;
        height: auto;
        border-radius: 10px;
    }
    
    .apb-info {
        flex: 1;
        min-width: 0;
        text-align: left;
    }
    
    .apb-info h2 {
        font-size: 28px;
        text-align: left;
    }
    
    .apb-info p {
        text-align: left;
    }
    
    .apb-card {
        padding: 15px 20px;
    }
    
    .apb-card h3 {
        font-size: 20px;
    }

    .berita-section,
    .agenda-section,
    .umkm-section,
    .galeri-section {
        padding: 50px 0;
    }
    
    .jadwal-sholat-section {
        padding: 50px 20px;
    }
    
    .jadwal-item {
        padding: 15px 18px;
    }
    
    .jadwal-name {
        font-size: 15px;
    }
    
    .jadwal-time {
        font-size: 16px;
    }
    
    .next-time {
        font-size: 32px;
    }
    
    .countdown {
        font-size: 16px;
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

/* Mobile Small */
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
        min-height: 350px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }
    
    .hero-section h1 {
        font-size: 24px;
        margin-bottom: 25px;
    }
    
    .hero-section h2 {
        font-size: 14px;
    }
    
    .hero-section h3 {
        font-size: 13px;
        padding: 5px 12px;
    }
    
    .hero-search {
        max-width: 100%;
    }
    
    /* PERBAIKAN HERO SEARCH MOBILE KECIL - Tombol Tetap Bulat */
    .hero-search-input {
        padding: 10px 14px !important;
        font-size: 13px !important;
    }
    
    .hero-search-btn {
        padding: 10px !important;
        min-width: 45px !important;
        border-radius: 50% !important;
        aspect-ratio: 1/1;
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
    
    /* PERBAIKAN PROFIL MOBILE KECIL */
    .profil {
        padding: 40px 15px;
        gap: 25px;
    }
    
    .profil-text h2 {
        font-size: 24px;
        text-align: left;
    }
    
    /* PERBAIKAN APB DESA MOBILE KECIL */
    .apb-desa {
        padding: 40px 15px;
    }
    
    .apb-container {
        flex-direction: row;
        gap: 15px;
    }
    
    .apbdesa-img {
        flex: 0 0 100px;
    }
    
    .apbdesa-img img {
        max-width: 90px;
    }
    
    .apb-info h2 {
        font-size: 24px;
        text-align: left;
    }
    
    .apb-info p {
        font-size: 14px;
        text-align: left;
    }
    
    .apb-card {
        padding: 12px 15px;
    }
    
    .apb-card span {
        font-size: 13px;
    }
    
    .apb-card h3 {
        font-size: 18px;
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
    
    .jadwal-item {
        padding: 12px 15px;
        flex-direction: column;
        gap: 8px;
        text-align: center;
    }
    
    .jadwal-name {
        font-size: 14px;
    }
    
    .jadwal-time {
        font-size: 15px;
        padding: 6px 12px;
    }
    
    .jadwal-next {
        padding: 20px 15px;
        margin-bottom: 20px;
    }
    
    .next-prayer-name {
        font-size: 18px;
    }
    
    .next-time {
        font-size: 28px;
    }
    
    .countdown {
        font-size: 14px;
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

/* Mobile Extra Small */
@media (max-width: 400px) {
    /* Hero Section Responsive untuk Extra Small Mobile */
    .hero-section {
        padding: 50px 12px;
        min-height: 300px;
    }
    
    .hero-section h1 {
        font-size: 22px;
        margin-bottom: 20px;
    }
    
    .hero-section h2 {
        font-size: 13px;
    }
    
    .hero-section h3 {
        font-size: 12px;
        padding: 4px 10px;
    }
    
    /* PERBAIKAN HERO SEARCH MOBILE SANGAT KECIL - Tombol Tetap Bulat */
    .hero-search-input {
        padding: 8px 12px !important;
        font-size: 12px !important;
    }
    
    .hero-search-btn {
        padding: 8px !important;
        min-width: 40px !important;
        border-radius: 50% !important;
        aspect-ratio: 1/1;
    }
    
    .hero-search-btn i {
        font-size: 12px !important;
    }
    
    .section-title {
        font-size: 22px;
    }
    
    .statistik h2 {
        font-size: 18px;
    }
    
    /* PERBAIKAN PROFIL MOBILE SANGAT KECIL */
    .profil-text h2,
    .apb-info h2 {
        font-size: 22px;
        text-align: left;
    }
    
    /* PERBAIKAN APB DESA MOBILE SANGAT KECIL */
    .apb-container {
        flex-direction: row;
        gap: 12px;
    }
    
    .apbdesa-img {
        flex: 0 0 80px;
    }
    
    .apbdesa-img img {
        max-width: 70px;
    }
    
    .apb-info h2 {
        font-size: 20px;
    }
    
    .apb-info p {
        font-size: 13px;
    }
    
    .apb-card {
        padding: 10px 12px;
    }
    
    .apb-card span {
        font-size: 12px;
    }
    
    .apb-card h3 {
        font-size: 16px;
    }
    
    .jadwal-sholat-header h3 {
        font-size: 18px;
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
    .hero-search-btn,
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

{{-- ---------------- Hero Section dengan Search ---------------- --}}
<div class="hero-section">
    <div class="hero-content">
        <h2 class="typing-text">Selamat Datang di Website Resmi</h2>
        <h1>Desa Cantik Desa Manggalung</h1>
        <h3>Badan Pusat Statistik Sulsel</h3>
        
        {{-- Search Box di Hero --}}
        <div class="hero-search">
            <div class="hero-search-box">
                <input type="text" class="hero-search-input" placeholder="Cari berita, agenda, UMKM, statistik...">
                <button class="hero-search-btn">
                    <i class="fa fa-search"></i>
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
</div>

<?php
if (!isset($stats)) {
    $stats = [
        'tahun' => date('Y'),
        'dusun' => 7,
        'rt' => 23,
        'rw' => 12,
        'kepala_keluarga' => 2463,
        'laki_laki' => 4952,
        'perempuan' => 4716,
        'disabilitas' => 4,
        'total_penduduk' => 9668
    ];
}
?>

{{-- ---------------- Statistik Section dengan Data Dinamis ---------------- --}}
<div class="statistik">
    <h2>Statistik Penduduk Desa Manggalung Tahun {{ $stats['tahun'] ?? date('Y') }}</h2>
    <button class="slider-btn left" id="slideLeft"><i class="fa fa-chevron-left"></i></button>
    <button class="slider-btn right" id="slideRight"><i class="fa fa-chevron-right"></i></button>
    <div class="slider-wrapper overflow-hidden">
        <div id="slider">
            {{-- Statistik Items dengan Data Dinamis --}}
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/dusun.png') }}" alt="Dusun">
                <p class="angka">{{ $stats['dusun'] ?? 0 }}</p>
                <p class="label">Dusun</p>
            </div>
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/rt.png') }}" alt="RT">
                <p class="angka">{{ $stats['rt'] ?? 0 }}</p>
                <p class="label">RT</p>
            </div>
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/rw.png') }}" alt="RW">
                <p class="angka">{{ $stats['rw'] ?? 0 }}</p>
                <p class="label">RW</p>
            </div>
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/kepalaKeluarga.png') }}" alt="Kepala Keluarga">
                <p class="angka">{{ number_format($stats['kepala_keluarga'] ?? 0) }}</p>
                <p class="label">Kepala Keluarga</p>
            </div>
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/male.png') }}" alt="Laki-laki">
                <p class="angka">{{ number_format($stats['laki_laki'] ?? 0) }}</p>
                <p class="label">Laki-laki</p>
            </div>
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/women.png') }}" alt="Perempuan">
                <p class="angka">{{ number_format($stats['perempuan'] ?? 0) }}</p>
                <p class="label">Perempuan</p>
            </div>
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/disabi.png') }}" alt="Disabilitas">
                <p class="angka">{{ $stats['disabilitas'] ?? 0 }}</p>
                <p class="label">Disabilitas</p>
            </div>
            <div class="item">
                <img src="{{ asset('landing/images/icon-image/family.png') }}" alt="Jumlah Penduduk">
                <p class="angka">{{ number_format($stats['total_penduduk'] ?? 0) }}</p>
                <p class="label">Jumlah Penduduk</p>
            </div>
        </div>
    </div>
</div>

{{-- ---------------- Chart Section dengan Data Dinamis ---------------- --}}
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

        <div class="jadwal-sholat-container">
            {{-- Card Jadwal Sholat --}}
            <div class="jadwal-sholat-card">
                <div class="jadwal-sholat-header">
                    <h3>Jadwal Sholat Hari Ini</h3>
                    <div class="jadwal-date" id="current-date">Loading...</div>
                    <div class="jadwal-location">
                        <i class="fas fa-map-marker-alt"></i>
                        Lokasi: Desa Manggalung, Kabupaten Pangkep (WITA)
                    </div>
                    <div class="current-time" id="current-time">
                        <i class="fas fa-clock"></i>
                        Jam Sekarang: <span id="live-clock">--:--:--</span>
                    </div>
                </div>
                <div class="jadwal-list" id="prayer-times">
                    <!-- Jadwal sholat akan diisi oleh JavaScript -->
                </div>
            </div>

            {{-- Card Sholat Berikutnya --}}
            <div class="jadwal-sholat-card">
                <div class="jadwal-next">
                    <div class="next-prayer-label">
                        <i class="fas fa-pray"></i>
                        Sholat Berikutnya
                    </div>
                    <div class="next-prayer-info">
                        <div class="next-prayer-name" id="next-prayer-name">-</div>
                        <div class="next-time" id="next-prayer-time">--:--</div>
                        <div class="countdown-container">
                            <div class="countdown-label">Menuju Sholat</div>
                            <div class="countdown" id="countdown">--:--:--</div>
                        </div>
                    </div>
                </div>
                <div class="jadwal-info">
                    <h4><i class="fas fa-info-circle"></i> Informasi</h4>
                    <p>Jadwal sholat ini dihitung berdasarkan koordinat lokasi Desa Manggalung, Kabupaten Pangkep. Waktu dapat berbeda ±2 menit tergantung kondisi cuaca dan observasi.</p>
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
// ---------------- Chart Penduduk dengan Data Dinamis ----------------
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chartPenduduk');
    
    // Data dari controller (PHP akan meng-inject data ini)
    const chartData = {
        labels: ['Kepala Keluarga', 'Laki-laki', 'Perempuan', 'Disabilitas', 'Jumlah Penduduk'],
        datasets: [{
            data: [
                {{ $stats['kepala_keluarga'] ?? 0 }},
                {{ $stats['laki_laki'] ?? 0 }},
                {{ $stats['perempuan'] ?? 0 }},
                {{ $stats['disabilitas'] ?? 0 }},
                {{ $stats['total_penduduk'] ?? 0 }}
            ],
            backgroundColor: ['#22c55e', '#60a5fa', '#f97316', '#a78bfa', '#ef4444'],
            borderColor: '#ffffff',
            borderWidth: 2,
            hoverOffset: 8,
            borderRadius: 6
        }]
    };

    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
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
                        },
                        // Menambahkan tooltip untuk legend
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    } 
                },
                cutout: '65%',
                responsive: true,
                maintainAspectRatio: true
            }
        });
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

// ---------------- Jadwal Sholat Functions ---------------- 
function updateLiveClock() {
    const now = new Date();
    const options = { 
        timeZone: 'Asia/Makassar',
        hour12: false,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    const timeString = now.toLocaleTimeString('id-ID', options);
    document.getElementById('live-clock').textContent = timeString;
}

// Update jam setiap detik
setInterval(updateLiveClock, 1000);
updateLiveClock(); // Panggil sekali saat pertama kali load

// Fungsi untuk format tanggal Indonesia
function formatTanggalIndonesia(date) {
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    };
    return date.toLocaleDateString('id-ID', options);
}

async function fetchPrayerTimes() {
    try {
        // Koordinat Desa Manggalung, Kabupaten Pangkep
        const latitude = -4.8051;
        const longitude = 119.5542;
        const today = new Date();
        const dateString = today.toISOString().split('T')[0];
        
        // Menggunakan API Aladhan
        const response = await fetch(`https://api.aladhan.com/v1/timings/${dateString}?latitude=${latitude}&longitude=${longitude}&method=2&timezonestring=Asia/Makassar`);
        const data = await response.json();
        
        if (data.code === 200) {
            return {
                timings: data.data.timings,
                date: {
                    readable: formatTanggalIndonesia(today)
                }
            };
        } else {
            throw new Error('Failed to fetch prayer times');
        }
    } catch (error) {
        console.error('Error fetching prayer times:', error);
        // Jika API gagal, coba lagi setelah 10 detik
        setTimeout(fetchPrayerTimes, 10000);
        throw error; // Tetap throw error agar proses berhenti
    }
}

function convertToWITA(time24) {
    // API sudah mengembalikan waktu dalam WITA karena timezone Asia/Makassar
    return time24;
}

function updatePrayerTimesDisplay(prayerData) {
    const prayerTimesContainer = document.getElementById('prayer-times');
    const currentDateElement = document.getElementById('current-date');
    
    // Update tanggal dengan format Indonesia
    currentDateElement.textContent = prayerData.date.readable;
    
    // Daftar sholat dengan nama Indonesia dan icon
    const prayers = [
        { key: 'Fajr', name: 'Subuh', icon: 'fas fa-moon' },
        { key: 'Sunrise', name: 'Terbit', icon: 'fas fa-sun' },
        { key: 'Dhuhr', name: 'Dzuhur', icon: 'fas fa-sun' },
        { key: 'Asr', name: 'Ashar', icon: 'fas fa-cloud-sun' },
        { key: 'Maghrib', name: 'Maghrib', icon: 'fas fa-sun' },
        { key: 'Isha', name: 'Isya', icon: 'fas fa-moon' }
    ];
    
    // Kosongkan container
    prayerTimesContainer.innerHTML = '';
    
    // Tambahkan setiap waktu sholat
    prayers.forEach(prayer => {
        const time = convertToWITA(prayerData.timings[prayer.key]);
        const prayerElement = document.createElement('div');
        prayerElement.className = 'jadwal-item';
        prayerElement.id = `prayer-${prayer.key.toLowerCase()}`;
        prayerElement.innerHTML = `
            <span class="jadwal-name">
                <i class="${prayer.icon}"></i>
                ${prayer.name}
            </span>
            <span class="jadwal-time">${time}</span>
        `;
        prayerTimesContainer.appendChild(prayerElement);
    });
    
    // Update sholat berikutnya
    updateNextPrayer(prayerData.timings);
}

function updateNextPrayer(timings) {
    const now = new Date();
    const currentTime = now.getHours().toString().padStart(2, '0') + ':' + 
                       now.getMinutes().toString().padStart(2, '0');
    
    const prayers = [
        { key: 'Fajr', name: 'Subuh', time: convertToWITA(timings.Fajr) },
        { key: 'Sunrise', name: 'Terbit', time: convertToWITA(timings.Sunrise) },
        { key: 'Dhuhr', name: 'Dzuhur', time: convertToWITA(timings.Dhuhr) },
        { key: 'Asr', name: 'Ashar', time: convertToWITA(timings.Asr) },
        { key: 'Maghrib', name: 'Maghrib', time: convertToWITA(timings.Maghrib) },
        { key: 'Isha', name: 'Isya', time: convertToWITA(timings.Isha) }
    ];
    
    // Reset semua item
    document.querySelectorAll('.jadwal-item').forEach(item => {
        item.classList.remove('active', 'passed');
    });
    
    let nextPrayer = null;
    let foundNext = false;
    
    // Tandai sholat yang sudah lewat dengan warna abu-abu
    prayers.forEach(prayer => {
        const prayerElement = document.getElementById(`prayer-${prayer.key.toLowerCase()}`);
        if (currentTime >= prayer.time) {
            if (prayerElement) {
                prayerElement.classList.add('passed');
            }
        }
    });
    
    // Cari sholat berikutnya (yang belum datang)
    for (let i = 0; i < prayers.length; i++) {
        const prayer = prayers[i];
        const prayerTime = prayer.time;
        
        if (currentTime < prayerTime) {
            // Waktu sholat belum datang - ini adalah sholat berikutnya
            nextPrayer = prayer;
            foundNext = true;
            
            // Tandai sholat berikutnya dengan warna hijau
            const prayerElement = document.getElementById(`prayer-${prayer.key.toLowerCase()}`);
            if (prayerElement) {
                prayerElement.classList.add('active');
            }
            break; // Hentikan loop setelah menemukan sholat berikutnya
        }
    }
    
    // Jika tidak ada sholat berikutnya (sudah lewat Isya), set ke Subuh besok
    if (!foundNext) {
        nextPrayer = prayers[0]; // Subuh besok
        
        // Tandai Subuh sebagai sholat berikutnya
        const subuhElement = document.getElementById('prayer-fajr');
        if (subuhElement) {
            subuhElement.classList.add('active');
        }
    }
    
    // Update info sholat berikutnya
    if (nextPrayer) {
        document.getElementById('next-prayer-name').textContent = nextPrayer.name;
        document.getElementById('next-prayer-time').textContent = nextPrayer.time;
        
        // Hitung countdown
        updateCountdown(nextPrayer.time);
    }
}

function updateCountdown(nextPrayerTime) {
    const now = new Date();
    const [hours, minutes] = nextPrayerTime.split(':');
    const prayerTime = new Date();
    prayerTime.setHours(parseInt(hours), parseInt(minutes), 0, 0);
    
    // Jika waktu sholat sudah lewat hari ini, set untuk besok
    if (prayerTime <= now) {
        prayerTime.setDate(prayerTime.getDate() + 1);
    }
    
    const diff = prayerTime - now;
    
    if (diff > 0) {
        const hoursLeft = Math.floor(diff / (1000 * 60 * 60));
        const minutesLeft = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const secondsLeft = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('countdown').textContent = 
            `${hoursLeft.toString().padStart(2, '0')}:${minutesLeft.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;
    } else {
        document.getElementById('countdown').textContent = '00:00:00';
    }
}

// Inisialisasi jadwal sholat
async function initializePrayerTimes() {
    try {
        const prayerData = await fetchPrayerTimes();
        updatePrayerTimesDisplay(prayerData);
        
        // Update countdown setiap detik
        setInterval(() => {
            const nextPrayerTime = document.getElementById('next-prayer-time').textContent;
            if (nextPrayerTime && nextPrayerTime !== '--:--') {
                updateCountdown(nextPrayerTime);
            }
        }, 1000);
        
        // Update jadwal setiap 5 menit
        setInterval(async () => {
            try {
                const updatedData = await fetchPrayerTimes();
                updatePrayerTimesDisplay(updatedData);
            } catch (error) {
                console.error('Error updating prayer times:', error);
            }
        }, 300000); // Update setiap 5 menit
    } catch (error) {
        console.error('Error initializing prayer times:', error);
        // Coba lagi setelah 30 detik jika gagal
        setTimeout(initializePrayerTimes, 30000);
    }
}

// Panggil fungsi inisialisasi ketika halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    initializePrayerTimes();
});

// ---------------- Search Functionality untuk Hero Search ---------------- 
$(document).ready(function() {
    const $searchInput = $('.hero-search-input');
    const $searchBtn = $('.hero-search-btn');
    const $searchResults = $('#searchResults');
    const $resultsList = $('#resultsList');
    const $resultsCount = $('#resultsCount');

    // Data untuk pencarian - SEMUA KONTEN WEBSITE
   const searchData = {
    // Data Statistik Dinamis
    statistik: [
        {
            id: 'stat-dusun',
            title: 'Dusun',
            content: 'Desa memiliki {{ $stats["dusun"] ?? 0 }} dusun yang tersebar di wilayah kelurahan',
            category: 'Statistik',
            angka: '{{ $stats["dusun"] ?? 0 }}',
            url: '#statistik',
            icon: 'dusun.png'
        },
        {
            id: 'stat-rt',
            title: 'RT',
            content: 'Terdapat {{ $stats["rt"] ?? 0 }} RT di wilayah kelurahan untuk administrasi',
            category: 'Statistik',
            angka: '{{ $stats["rt"] ?? 0 }}',
            url: '#statistik',
            icon: 'rt.png'
        },
        {
            id: 'stat-rw',
            title: 'RW',
            content: 'Wilayah kelurahan dibagi menjadi {{ $stats["rw"] ?? 0 }} RW',
            category: 'Statistik',
            angka: '{{ $stats["rw"] ?? 0 }}',
            url: '#statistik',
            icon: 'rw.png'
        },
        {
            id: 'stat-kk',
            title: 'Kepala Keluarga',
            content: 'Jumlah kepala keluarga di kelurahan sebanyak {{ number_format($stats["kepala_keluarga"] ?? 0) }} KK',
            category: 'Statistik',
            angka: '{{ number_format($stats["kepala_keluarga"] ?? 0) }}',
            url: '#statistik',
            icon: 'kepalaKeluarga.png'
        },
        {
            id: 'stat-laki',
            title: 'Laki-laki',
            content: 'Penduduk laki-laki berjumlah {{ number_format($stats["laki_laki"] ?? 0) }} jiwa',
            category: 'Statistik',
            angka: '{{ number_format($stats["laki_laki"] ?? 0) }}',
            url: '#statistik',
            icon: 'male.png'
        },
        {
            id: 'stat-perempuan',
            title: 'Perempuan',
            content: 'Penduduk perempuan berjumlah {{ number_format($stats["perempuan"] ?? 0) }} jiwa',
            category: 'Statistik',
            angka: '{{ number_format($stats["perempuan"] ?? 0) }}',
            url: '#statistik',
            icon: 'women.png'
        },
        {
            id: 'stat-disabilitas',
            title: 'Disabilitas',
            content: 'Warga dengan disabilitas berjumlah {{ $stats["disabilitas"] ?? 0 }} orang',
            category: 'Statistik',
            angka: '{{ $stats["disabilitas"] ?? 0 }}',
            url: '#statistik',
            icon: 'disabi.png'
        },
        {
            id: 'stat-total',
            title: 'Jumlah Penduduk',
            content: 'Total penduduk kelurahan sebanyak {{ number_format($stats["total_penduduk"] ?? 0) }} jiwa',
            category: 'Statistik',
            angka: '{{ number_format($stats["total_penduduk"] ?? 0) }}',
            url: '#statistik',
            icon: 'family.png'
        }
    ],
        
        // Data dari controller
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
        
        // Data tambahan untuk APB Desa
        apb: [
            {
                id: 'apb-pendapatan',
                title: 'Pendapatan Desa 2024',
                content: 'Total pendapatan desa tahun 2024 sebesar Rp4.802.205.800,00',
                category: 'APB Desa',
                angka: 'Rp4.802.205.800,00',
                url: "{{ url('/apbd') }}"
            },
            {
                id: 'apb-belanja',
                title: 'Belanja Desa 2024',
                content: 'Total belanja desa tahun 2024 sebesar Rp4.888.222.678,00',
                category: 'APB Desa',
                angka: 'Rp4.888.222.678,00',
                url: "{{ url('/apbd') }}"
            }
        ],
        
        // Data profil desa
        profil: [
            {
                id: 'profil-desa',
                title: 'Profil Desa Manggalung',
                content: 'Kelurahan Maccini Sombala merupakan salah satu kelurahan di Kota Makassar yang memiliki potensi besar dalam pembangunan masyarakat. Dengan jumlah penduduk lebih dari 9.600 jiwa',
                category: 'Profil',
                url: '#profil'
            }
        ]
    };

    // Fungsi pencarian yang lebih komprehensif
    function performSearch(query) {
        if (!query.trim()) {
            hideSearchResults();
            return;
        }

        const results = [];
        const searchTerms = query.toLowerCase().split(' ').filter(term => term.length > 1);

        // Cari di semua kategori
        Object.keys(searchData).forEach(category => {
            searchData[category].forEach(item => {
                const searchableText = (item.title + ' ' + item.content + ' ' + (item.pemilik || '') + ' ' + (item.angka || '')).toLowerCase();
                
                // Cek kecocokan dengan berbagai kriteria
                let matches = false;
                let relevance = 0;
                
                searchTerms.forEach(term => {
                    // Exact match di title
                    if (item.title.toLowerCase().includes(term)) {
                        matches = true;
                        relevance += 5;
                    }
                    // Match di content
                    if (item.content.toLowerCase().includes(term)) {
                        matches = true;
                        relevance += 3;
                    }
                    // Match di angka/statistik
                    if (item.angka && item.angka.toLowerCase().includes(term)) {
                        matches = true;
                        relevance += 4;
                    }
                    // Match di pemilik UMKM
                    if (item.pemilik && item.pemilik.toLowerCase().includes(term)) {
                        matches = true;
                        relevance += 3;
                    }
                    // Match di kategori
                    if (item.category.toLowerCase().includes(term)) {
                        matches = true;
                        relevance += 2;
                    }
                });
                
                if (matches) {
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
                    <p>Tidak ada hasil untuk "<strong>${query}</strong>". Coba dengan kata kunci lain seperti: kepala keluarga, berita, agenda, UMKM, dusun, RT, RW, pendapatan desa.</p>
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
                        ${result.angka ? `<div class="search-result-highlight" style="margin: 5px 0; font-size: 16px; font-weight: bold;">${result.angka}</div>` : ''}
                        <p class="search-result-text">${highlightedContent}</p>
                        ${result.price ? `<div class="price">${result.price}</div>` : ''}
                    </div>
                `;
                $resultsList.append(resultItem);
            });
        }

        $resultsCount.text(`${results.length} hasil`);
        $searchResults.addClass('active');
    }

    // Fungsi untuk highlight teks
    function highlightText(text, query) {
        const searchTerms = query.toLowerCase().split(' ').filter(term => term.length > 1);
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
        } else if (query.length >= 2) {
            // Debounce search
            clearTimeout($(this).data('timeout'));
            $(this).data('timeout', setTimeout(() => {
                performSearch(query);
            }, 300));
        }
    });

    // Klik di luar untuk menutup hasil pencarian
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.hero-search').length) {
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
    // Bubble effect sudah dihapus sesuai permintaan
});
</script>
@endpush
@endsection