@extends('layouts.landing.app')

@section('content')

  {{-- Bagian konten dengan background hijau muda --}}
  <div class="hero-banner">
    <div class="hero-content">

      {{-- Judul --}}
      <h1 class="title">Sejarah Singkat Desa</h1>

   {{-- Meta --}}
<div class="meta">
  <div class="left">
    <span>🕒 10 September 2025</span>
    <span>👤 Ditulis oleh Orang</span>
  </div>
  <div class="right">
    <span>👁️ Dilihat 100 kali</span>
  </div>
</div>


      {{-- Isi Konten --}}
      <div class="content">
        <h2>Sejarah Singkat Desa</h2>
        <p>Desa ini berdiri sejak zaman kolonial Belanda dan menjadi pusat perdagangan lokal pada abad ke-19.</p>

        <h2>Pendudukan Awal</h2>
        <p>Penduduk pertama berasal dari suku asli yang mendiami daerah pesisir sungai utama.</p>

        <h2>Perkembangan Sejarah</h2>
        <p>Setelah kemerdekaan, desa berkembang pesat dengan dibangunnya jalan dan sekolah.</p>

        <h2>Budaya dan Tradisi</h2>
        <p>Desa mempertahankan tradisi seperti sedekah bumi dan kesenian tari daerah.</p>
      </div>
    </div>
  </div>
@endsection

@push('styles')
<style>
/* Full putih default */
body, html {
  background: #fff !important;
  margin: 0;
  padding: 0;
  width: 100%;
  min-height: 100%;
}

/* Section hijau full */
.hero-banner {
  background: #C0D09D;
  width: 100%;
  padding: 60px 20px; /* jarak atas bawah */
  display: flex;
  justify-content: center;
}

/* Kotak putih di tengah */
.hero-content {
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  max-width: 800px;  /* biar tidak kepenuhan di layar besar */
  width: 100%;
  margin:2%;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Responsive */
@media (max-width: 992px) {
  .hero-content {
    max-width: 90%;
    padding: 25px;
  }
}

@media (max-width: 576px) {
  .hero-content {
    max-width: 95%;
    padding: 20px;
  }
}

.meta {
  display: flex;
  justify-content: space-between; /* kiri-kanan */
  align-items: center;
  font-size: 14px;
  color: #666;
  margin-bottom: 20px;
  flex-wrap: wrap; /* biar rapi di HP */
}

.meta .left {
  display: flex;
  gap: 15px; /* jarak antar item kiri */
}

.meta .right {
  text-align: right;
}

</style>
@endpush
