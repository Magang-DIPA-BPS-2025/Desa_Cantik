@extends('layouts.landing.app')

@section('content')
<div class="container mt-5">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }

        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            padding: 30px;
            margin-bottom: 80px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        }

        .form-label {
            font-weight: 600;
        }

        h2, h5 {
            color: #2c3e50;
        }

        p {
            color: #555;
        }

        .icon-step {
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: transform 0.3s;
        }

        .icon-step img {
            max-width: 100%;
            max-height: 100%;
        }

        .icon-step:hover {
            transform: scale(1.1);
        }

        .step-title {
            margin-top: 10px;
            font-weight: 600;
            color: #2c3e50;
        }

        .btn-submit {
            border-radius: 10px;
            padding: 12px 0;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #3e8e41;
        }

        @media (max-width: 768px) {
            .d-flex.justify-content-center.text-center.mb-5 {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>

    {{-- Header --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold">PENGADUAN MASYARAKAT</h2>
        <p>Sistem terbuka untuk menyuarakan permasalahan dan memperbaiki pelayanan. Kami mendengar, bertindak, dan membangun solusi bersama untuk meningkatkan kualitas hidup</p>
    </div>

    {{-- Langkah-langkah --}}
    <div class="d-flex justify-content-center text-center mb-5 flex-wrap">
        <div class="mx-4">
            <div class="icon-step">
                <img src="{{ asset('landing/images/footer/formulir.png') }}" alt="Isi Formulir">
            </div>
            <p class="step-title">Isi Formulir</p>
        </div>
        <div class="mx-4">
            <div class="icon-step">
                <img src="{{ asset('landing/images/footer/bukti.png') }}" alt="Unduh Bukti Laporan">
            </div>
            <p class="step-title">Unduh Bukti Laporan</p>
        </div>
        <div class="mx-4">
            <div class="icon-step">
                <img src="{{ asset('landing/images/footer/monitoring.png') }}" alt="Lakukan Monitoring">
            </div>
            <p class="step-title">Lakukan Monitoring</p>
        </div>
    </div>

    {{-- Form --}}
    <div class="card">
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- A. Data Diri --}}
                <div class="col-md-6 mb-4">
                    <h5 class="fw-bold">A. DATA DIRI</h5>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control" placeholder="62..." required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat" rows="3" required></textarea>
                    </div>
                    <small>Data diri pelapor dijamin kerahasiaannya oleh pemerintah desa</small>
                </div>

                {{-- B. Uraian Pengaduan --}}
                <div class="col-md-6 mb-4">
                    <h5 class="fw-bold">B. URAIAN PENGADUAN</h5>
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan Judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="uraian" class="form-label">Uraian</label>
                        <textarea name="uraian" id="uraian" class="form-control" placeholder="Masukkan Uraian" rows="6" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lampiran" class="form-label">Lampiran (Jika ada)</label>
                        <input type="file" name="lampiran" id="lampiran" class="form-control">
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-submit w-100">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection
