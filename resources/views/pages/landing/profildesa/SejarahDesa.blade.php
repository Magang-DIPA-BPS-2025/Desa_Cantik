@extends('layouts.landing.app')

@section('content')
{{-- UBAH container menjadi container-fluid untuk lebar penuh --}}
<div class="history-section py-5 py-lg-6" style="min-height: 100vh;">
    <div class="container-fluid px-0 px-lg-5">

        {{-- Judul --}}
        <div class="text-center mb-5 mb-lg-6 mx-auto" style="max-width: 1000px;">
            <h1 class="fw-bolder display-4 mb-3" style="color:#1B5E20;">
                <i class="bi bi-clock-history me-2"></i> SEJARAH SINGKAT DESA
            </h1>
            <div class="decor-line mx-auto mt-4" style="width:100px; height:5px; background:#4CAF50; border-radius:5px;"></div>
            <p class="text-secondary fs-5 mt-3">Mengenal asal-usul, perkembangan, dan tradisi desa</p>
        </div>

        {{-- Card Konten UTAMA --}}
        {{-- Hapus max-width di CSS agar card mengikuti container-fluid. Tambahkan padding horizontal yang besar untuk menjaga estetika --}}
        <div class="card border-0 shadow-lg rounded-0 history-card px-4 py-5 px-lg-6 py-lg-6">

            {{-- Gambar Ilustrasi/Sampul --}}
            <figure class="mb-4 mb-md-5 rounded-4 overflow-hidden shadow-sm">
                {{-- Ganti URL gambar ini dengan gambar sampul atau ilustrasi desa yang relevan --}}
                <img src="https://picsum.photos/1600/400?random=1" class="img-fluid history-img" alt="Ilustrasi Sejarah Desa">
                <figcaption class="p-2 text-center small text-muted">
                    Ilustrasi: Potret Keindahan Alam Desa (Sumber: Dokumentasi Desa)
                </figcaption>
            </figure>

            {{-- Meta Data --}}
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap small text-secondary border-bottom pb-3">
                <div class="d-flex flex-wrap">
                    <span class="me-3 mb-2 mb-sm-0"><i class="bi bi-calendar-event me-1"></i> 10 September 2025</span>
                    <span class="me-3 mb-2 mb-sm-0"><i class="bi bi-person-fill me-1"></i> Ditulis oleh Admin Desa</span>
                </div>
                <div>
                    <span class="mb-2 mb-sm-0"><i class="bi bi-eye-fill me-1"></i> Dilihat 100 kali</span>
                </div>
            </div>

            {{-- Isi Konten --}}
            <div class="content py-3 mx-auto" style="max-width: 1200px;">
                <p>Setiap desa menyimpan cerita, dan desa kami bukanlah pengecualian. Sejarah singkat ini mencoba merangkum jejak waktu, mulai dari pendirian hingga perkembangan terkini yang membentuk karakter desa yang kita cintai saat ini.</p>

                <h3 class="mt-5">Sejarah Awal & Pendirian</h3>
                <p>Desa ini memiliki akar yang dalam, **berdiri sejak zaman kolonial Belanda** dan secara strategis diposisikan di tepian sungai utama, yang menjadikannya **pusat perdagangan lokal** yang ramai pada abad ke-19. Nama desa sendiri konon berasal dari peristiwa penting saat itu (misalnya, tempat bertemunya dua kepala suku).</p>

                <h3 class="mt-5">Pendudukan & Suku Asli</h3>
                <p>Penduduk pertama sebagian besar berasal dari **suku asli [Nama Suku/Etnis]** yang telah mendiami daerah pesisir sungai ini selama berabad-abad. Mereka hidup harmonis dengan alam, mengandalkan pertanian subsisten dan perikanan. Tradisi lisan dan artefak kuno menjadi saksi bisu akan peradaban awal yang kaya.</p>

                {{-- Blockquote/Kutipan Menonjol --}}
                <blockquote class="blockquote border-start border-success border-4 ps-3 my-5">
                    <p class="mb-0 fst-italic text-dark">
                        "Masa lalu adalah pondasi. Dengan memahami sejarah, kita dapat membangun masa depan yang lebih kokoh dan menghargai warisan leluhur."
                    </p>
                </blockquote>

                <h3 class="mt-5">Perkembangan Pasca Kemerdekaan</h3>
                <p>Setelah proklamasi kemerdekaan, desa mengalami **perkembangan pesat**. Infrastruktur dasar mulai dibangun, termasuk jalan utama, fasilitas irigasi, dan sekolah pertama. Perubahan ini membuka isolasi desa dan mendorong pertumbuhan ekonomi yang lebih modern, khususnya di sektor pertanian dan perkebunan.</p>

                <h3 class="mt-5">Budaya, Tradisi, dan Warisan</h3>
                <p>Hingga hari ini, desa kami dengan bangga **mempertahankan banyak tradisi**. Acara tahunan seperti **Sedekah Bumi** (ritual syukur panen) dan **kesenian tari daerah** yang khas selalu dirayakan dengan meriah. Tradisi-tradisi ini bukan hanya hiburan, tetapi juga perekat sosial yang kuat bagi seluruh komunitas.</p>

                <p>Kami berharap sejarah singkat ini dapat memberikan gambaran komprehensif tentang desa kami. Mari kita jaga dan lestarikan warisan ini bersama-sama!</p>
            </div>

            {{-- Tombol Kembali --}}
            <div class="text-center mt-5 pt-3 border-top">
                 <a href="{{ url('/') }}" class="btn btn-success btn-lg shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                 </a>
            </div>

        </div>
    </div>
</div>

<style>
    /* Section Background */
    .history-section {
        background: #fdfdfd;
    }

    /* Card Styling */
    .history-card {
        /* Hapus max-width agar card melebar. Set border-radius ke 0 (sudut kotak) agar menyatu dengan lebar penuh */
        border-radius: 0 !important;
        box-shadow: 0 0 40px rgba(0, 0, 0, 0.05); /* Bayangan lembut di bawah */
        background: #fff;
        transition: all 0.3s ease;
        /* Tambahkan padding horizontal yang besar untuk menjaga teks tetap nyaman dibaca */
    }
    .history-card:hover {
        /* Hilangkan transform Y agar tidak aneh saat lebar penuh, fokus pada box-shadow */
        transform: none;
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
    }

    /* Gambar Sampul/Ilustrasi */
    .history-img {
        object-fit: cover;
        width: 100%;
        height: 350px;
    }

    /* Konten Heading (H3) */
    .content h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-top: 2.5rem;
        color: #1B5E20;
        position: relative;
        padding-bottom: 8px;
    }
    .content h3::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 70px;
        height: 4px;
        background: #4CAF50;
        border-radius: 2px;
    }

    /* Konten Paragraf */
    .content p {
        font-size: 1.15rem;
        line-height: 1.9;
        color: #343a40;
        text-align: justify;
    }

    /* Blockquote */
    .blockquote {
        font-size: 1.25rem;
        color: #555;
    }
</style>
@endsection
