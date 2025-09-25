@extends('layouts.landing.app')

@section('content')

  {{-- Hero Image Full --}}
  <div class="hero-image">
    <img src="https://via.placeholder.com/1920x500.png?text=Foto+Desa" alt="Hero Desa">
    <div class="overlay">
      <h1 class="hero-title">Sejarah Singkat Desa</h1>
    </div>
  </div>

  {{-- Konten Putih --}}
  <div class="hero-content">
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
@endsection

@push('styles')
<style>
/* Hero Image */
.hero-image {
  position: relative;
  width: 100%;
  height: 400px;
  overflow: hidden;
}

.hero-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-image .overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.3);
  display: flex;
  justify-content: center;
  align-items: center;
}

.hero-image .hero-title {
  color: #fff;
  font-size: 2.5rem;
  font-weight: 700;
  text-shadow: 0 2px 6px rgba(0,0,0,0.4);
  text-align: center;
}

/* Konten Putih */
.hero-content {
  background: #fff;
  padding: 40px 25px;
  max-width: 900px;
  margin: -60px auto 40px auto; /* naik sedikit di atas */
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  position: relative;
  z-index: 2;
}

/* Meta */
.meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 14px;
  color: #777;
  margin-bottom: 20px;
  flex-wrap: wrap;
  border-bottom: 1px solid #eee;
  padding-bottom: 10px;
}

.meta .left {
  display: flex;
  gap: 15px;
}

.meta .right {
  font-weight: 500;
  color: #444;
}

/* Content */
.content h2 {
  font-size: 1.4rem;
  font-weight: 600;
  margin-top: 25px;
  margin-bottom: 10px;
  color: #34495e;
  position: relative;
}

.content h2::after {
  content: "";
  display: block;
  width: 40px;
  height: 3px;
  background: #C0D09D;
  margin-top: 6px;
  border-radius: 3px;
}

.content p {
  margin-bottom: 15px;
  text-align: justify;
  color: #555;
  font-size: 15px;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-image {
    height: 250px;
  }
  .hero-image .hero-title {
    font-size: 1.6rem;
  }
  .hero-content {
    margin: -40px auto 20px auto;
    padding: 20px;
  }
}
</style>
@endpush
