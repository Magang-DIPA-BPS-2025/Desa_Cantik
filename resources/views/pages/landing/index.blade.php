@extends('layouts.landing.app')
@section('content')

@push('styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
        color: #333;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(0,0,0,0.5)),
            url('{{ asset("landing/images/slider-main/makassar.jpg") }}') center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 150px 20px;
        position: relative;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        box-shadow: 0 10px 25px rgba(255, 255, 255, 0.3);
    }

    .hero-section h2 {
        font-size: 28px;
        font-weight: 500;
        margin-bottom: 10px;
        letter-spacing: 1px;
        text-shadow: 0 3px 8px rgba(255, 255, 255, 0.5);
        font-weight: bold;
    }

    .hero-section h1 {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 3px 8px rgba(255, 255, 255, 0.5);
    }

    .hero-section h3 {
        display: inline-block;
        background: linear-gradient(45deg, #7CB518, #4CAF50);
        padding: 10px 22px;
        border-radius: 30px;
        font-size: 18px;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.482);
        transition: transform 0.3s ease;
    }

    .hero-section h3:hover {
        transform: scale(1.05);
    }

    /* Info Dusun/RT/RW Section */
    .info-section {
        background: #f1f8f4;
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 60px 20px;
        flex-wrap: wrap;
    }

    .info-card {
        background: #fff;
        width: 200px;
        padding: 40px 20px;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }

    .info-card .angka {
        font-size: 40px;
        font-weight: 700;
        margin-bottom: 12px;
        color: #2e7d32;
    }

    .info-card p {
        font-size: 16px;
        font-weight: 500;
        color: #444;
    }

    /* Statistik Penduduk */
    .statistik {
        background: linear-gradient(135deg, #C0D09D, #A5C37A);
        padding: 70px 20px;
        text-align: center;
        border-radius: 40px;
        margin: 50px auto;
        width: 95%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .statistik h2 {
        margin-bottom: 50px;
        font-size: 28px;
        font-weight: 700;
        color: #222;
    }

    .statistik .item {
        display: inline-block;
        margin: 25px;
        width: 190px;
        padding: 20px;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .statistik .item:hover {
        transform: scale(1.05);
        background: #f9f9f9;
    }

    .statistik img {
        width: 80px;
        margin-bottom: 15px;
        transition: transform 0.3s ease;
    }

    .statistik .item:hover img {
        transform: rotate(10deg) scale(1.1);
    }

    .statistik p:first-child {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
        color: #2e7d32;
    }

    .statistik p:last-child {
        font-size: 16px;
        font-weight: 500;
        color: #444;
    }
</style>
@endpush

{{-- Hero Section --}}
<div class="hero-section">
    <h2>Selamat Datang di Website Resmi</h2>
    <h1>Desa Cantik Kelurahan Maccini Sombala</h1>
    <h3>Badan Pusat Statistik Kota Makassar</h3>
</div>

{{-- Info Dusun/RT/RW --}}
<div class="info-section">
    <div class="info-card">
        <p class="angka">7</p>
        <p>Dusun</p>
    </div>
    <div class="info-card">
        <p class="angka">23</p>
        <p>RT</p>
    </div>
    <div class="info-card">
        <p class="angka">12</p>
        <p>RW</p>
    </div>
</div>

{{-- Statistik Penduduk --}}
<div class="statistik">
    <h2>Statistik Penduduk Kelurahan Maccini Sombala Tahun 2025</h2>
    <div class="item">
        <img src="{{ asset('landing/images/icon-image/kepalaKeluarga.png') }}" alt="Kepala Keluarga">
        <p>2.463</p>
        <p>Kepala Keluarga</p>
    </div>
    <div class="item">
        <img src="{{ asset('landing/images/icon-image/male.png') }}" alt="Laki-laki">
        <p>4.952</p>
        <p>Laki-laki</p>
    </div>
    <div class="item">
        <img src="{{ asset('landing/images/icon-image/women.png') }}" alt="Perempuan">
        <p>4.716</p>
        <p>Perempuan</p>
    </div>
    <div class="item">
        <img src="{{ asset('landing/images/icon-image/disabi.png') }}" alt="Disabilitas">
        <p>4</p>
        <p>Disabilitas</p>
    </div>
    <div class="item">
        <img src="{{ asset('landing/images/icon-image/family.png') }}" alt="Jumlah Penduduk">
        <p>9.668</p>
        <p>Jumlah Penduduk</p>
    </div>
</div>

@endsection
