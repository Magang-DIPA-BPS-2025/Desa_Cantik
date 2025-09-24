@extends('layouts.landing.app')
@section('content')

@push('styles')
<style>
    /* Navbar */
    .navbar-custom {
        background: #ffffff;
        padding: 15px 30px;
        border-bottom: 1px solid #ddd;
    }

    /* Hero Section */
    .hero-section {
        background: url('{{ asset("landing/images/slider-main/makassar.jpg") }}') center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 120px 20px;
        position: relative;
    }

    /* Overlay gelap untuk makassar.jpg */
    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
    }

    .hero-section h1,
    .hero-section h2,
    .hero-section h3 {
        position: relative;
        z-index: 1;
        color: #ffffff;
    }

    .hero-section h2 {
        font-size: 28px;
        margin-bottom: 10px;
    }
    .hero-section h1 {
        font-size: 36px;
        font-weight: bold;
    }
    .hero-section h3 {
        margin-top: 15px;
        display: inline-block;
        background: #C0D09D;
        padding: 8px 18px;
        border-radius: 5px;
        font-size: 18px;
        color: #ffffff;
    }

    /* Info Dusun/RT/RW Section */
    .info-section {
        background: #C0D09D;
        display: flex;
        justify-content: center;
        gap: 50px;
        padding: 50px 20px;
        flex-wrap: wrap;
    }

    .info-card {
        position: relative;
        background: #fff;
        width: 180px;
        padding: 35px 15px;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .info-card .angka {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .info-card p {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin: 0;
    }

    /* Circle styles */
    .circle {
        position: absolute;
        width: 26px;
        height: 26px;
        border-radius: 50%;
    }
    .circle-blue {
        background: #1E90FF;
        top: -13px;
        left: -13px;
    }
    .circle-red {
        background: #1E90FF;
        top: -13px;
        right: -13px;
    }
    .circle-green {
        background: #2ECC71;
        bottom: -13px;
        right: -13px;
    }
    .circle-orange {
        background: #FFA15A;
        bottom: -13px;
        left: -13px;
    }
    .circle-orang {
        background: #FFA15A;
        bottom: -13px;
        right: -13px;
    }
    .circle-black {
        background: #2ECC71;
        top: -13px;
        left: -13px;
    }

    /* Statistik Penduduk */
    .statistik {
        background: #C0D09D;
        padding: 50px 20px;
        text-align: center;
    }
    .statistik h2 {
        margin-bottom: 40px;
        font-size: 24px;
        font-weight: bold;
        color: #000;
    }
    .statistik .item {
        display: inline-block;
        margin: 20px;
        width: 180px;
    }
    .statistik img {
        width: 100px;
        margin-bottom: 15px;
    }
    .statistik p {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }
    .statistik p:first-child {
        font-size: 20px;
        font-weight: bold;
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
        <span class="circle circle-blue"></span>
        <span class="circle circle-green"></span>
        <p class="angka">7</p>
        <p>Dusun</p>
    </div>
    <div class="info-card">
        <span class="circle circle-red"></span>
        <span class="circle circle-orange"></span>
        <p class="angka">23</p>
        <p>RT</p>
    </div>
    <div class="info-card">
        <span class="circle circle-black"></span>
        <span class="circle circle-orang"></span>
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
        <img src="{{ asset('landing/images/icon-image/disabi.png') }}" alt="Perempuan">
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
