@extends('layouts.landing.app')

@section('content')
<div class="container-fluid py-5 bg-light min-vh-100 d-flex flex-column">
  <div class="container flex-grow-1">
    {{-- Judul --}}
    <div class="text-center mb-5">
      <h2 class="fw-bold text-success mb-3">
        <i class="bi bi-diagram-3-fill me-2"></i> SUSUNAN ORGANISASI PEMERINTAH DESA
      </h2>
      <p class="fw-semibold text-muted fs-5">KECAMATAN SOMBA OPU · KABUPATEN GOWA</p>
      <div class="decor-line mx-auto"></div>
    </div>

    {{-- Struktur Organisasi --}}
    <div class="org-container p-4 bg-white rounded-4 shadow-lg position-relative">
      <img src="{{ asset('landing/images/struktur/struktur-desa.png') }}"
           alt="Struktur Pemerintah Desa"
           class="img-fluid mx-auto d-block rounded-3 border border-2 border-success-subtle">
      <div class="watermark">Desa Digital</div>
    </div>

    {{-- Tupoksi --}}
    <div class="tupoksi bg-success-subtle p-4 mt-5 rounded-4 shadow-sm">
      <h4 class="fw-bold mb-3"><i class="bi bi-journal-text me-2"></i> Tupoksi Desa</h4>
      <p class="mb-0 fs-6">
        Menjelaskan tugas pokok dan fungsi dari setiap perangkat desa sesuai struktur organisasi.
        Setiap perangkat memiliki peran penting dalam mendukung pelayanan publik, pembangunan, dan pemberdayaan masyarakat desa.
      </p>
    </div>
  </div>

</div>

{{-- CSS Tambahan --}}
<style>
  /* Dekorasi garis di bawah judul */
  .decor-line {
    width: 90px;
    height: 4px;
    background: linear-gradient(90deg, #4CAF50, #2E7D32);
    border-radius: 10px;
  }

  /* Struktur organisasi */
  .org-container {
    overflow: hidden;
  }

  .org-container img {
    transition: transform 0.4s ease;
  }

  .org-container:hover img {
    transform: scale(1.05);
  }

  /* Watermark */
  .watermark {
    position: absolute;
    bottom: 15px;
    right: 20px;
    font-size: 0.9rem;
    font-weight: bold;
    color: rgba(76, 175, 80, 0.35);
    pointer-events: none;
  }

  /* Tupoksi */
  .tupoksi {
    border-left: 6px solid #4CAF50;
  }

  .tupoksi h4 {
    color: #2E7D32;
  }

  /* Responsif */
  @media (max-width: 768px) {
    h2 {
      font-size: 1.6rem;
    }
    .tupoksi {
      padding: 1.5rem;
    }
  }
</style>
@endsection
