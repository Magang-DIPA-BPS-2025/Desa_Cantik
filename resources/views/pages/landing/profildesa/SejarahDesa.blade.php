@extends('layouts.landing.app')

@section('content')
<div class="container py-5" style="background-color: #f5f6fa; min-height: 100vh;">
    {{-- Judul --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold position-relative d-inline-block" style="font-size: 2.5rem;">
            Sejarah Singkat Desa
            <span class="d-block mx-auto mt-3" style="width: 70px; height: 4px; background: linear-gradient(90deg, #4CAF50, #2E7D32); border-radius: 5px;"></span>
        </h2>
        <p class="text-muted fs-5">Mengenal asal-usul, perkembangan, dan tradisi desa</p>
    </div>

    {{-- Card Konten --}}
    <div class="card border-0 shadow-lg rounded-4 p-5" style="background: linear-gradient(135deg, #C0D09D, #A3C68D); transition: transform 0.3s;">
        {{-- Meta --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div class="small mb-2" style="color: #1a1a1a;">
                <span class="me-3">🕒 10 September 2025</span>
                <span>👤 Ditulis oleh Orang</span>
            </div>
            <div class="small mb-2" style="color: #1a1a1a;">
                <span>👁️ Dilihat 100 kali</span>
            </div>
        </div>

        {{-- Isi Konten --}}
        <div class="content" style="color: #1a1a1a;">
            <h3 class="fw-semibold mb-3">Sejarah Singkat Desa</h3>
            <p>Desa ini berdiri sejak zaman kolonial Belanda dan menjadi pusat perdagangan lokal pada abad ke-19.</p>

            <h3 class="fw-semibold mt-4 mb-3">Pendudukan Awal</h3>
            <p>Penduduk pertama berasal dari suku asli yang mendiami daerah pesisir sungai utama.</p>

            <h3 class="fw-semibold mt-4 mb-3">Perkembangan Sejarah</h3>
            <p>Setelah kemerdekaan, desa berkembang pesat dengan dibangunnya jalan dan sekolah.</p>

            <h3 class="fw-semibold mt-4 mb-3">Budaya dan Tradisi</h3>
            <p>Desa mempertahankan tradisi seperti sedekah bumi dan kesenian tari daerah.</p>
        </div>
    </div>
</div>

{{-- CSS Tambahan --}}
<style>
    .content h3 {
        position: relative;
        padding-bottom: 8px;
        font-size: 1.5rem;
        color: #1a1a1a; /* teks hitam semi untuk judul */
    }
    .content h3::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #4CAF50, #2E7D32);
        border-radius: 3px;
    }
    .content p {
        line-height: 1.8;
        text-align: justify;
        font-size: 1.1rem;
        color: #1a1a1a; /* teks hitam semi untuk paragraf */
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
