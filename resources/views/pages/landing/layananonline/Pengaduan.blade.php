@extends('layouts.landing.app')

@section('content')
<div class="container mt-4">
    <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #c5d6a5;
    margin: 0;
    padding: 0;
    line-height: 1.5;
  }

   .card {
    background-color: #ffffff;
    border: none;
    border-radius: 10px;
    margin-bottom: 80px; /* jarak dari bawah */
}

    .form-label {
        font-weight: 500;
    }
</style>

    {{-- Header --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold">PENGADUAN MASYARAKAT</h2>
        <p>Sistem terbuka untuk menyuarakan permasalahan dan memperbaiki pelayanan. Kami mendengar, bertindak, dan membangun solusi bersama untuk meningkatkan kualitas hidup</p>
    </div>

<div class="d-flex justify-content-center text-center mb-5">
    <div class="mx-4">
        <div style="width:150px; height:150px; display:flex; align-items:center; justify-content:center; margin:0 auto;">
            <img src="{{ asset('landing/images/footer/formulir.png') }}" alt="Isi Formulir" style="max-width:100%; max-height:100%;">
        </div>
        <p class="mt-2 fw-bold">Isi Formulir</p>
    </div>
    <div class="mx-4">
        <div style="width:150px; height:150px; display:flex; align-items:center; justify-content:center; margin:0 auto;">
            <img src="{{ asset('landing/images/footer/bukti.png') }}" alt="Unduh Bukti Laporan" style="max-width:100%; max-height:100%;">
        </div>
        <p class="mt-2 fw-bold">Unduh Bukti Laporan</p>
    </div>
    <div class="mx-4">
        <div style="width:150px; height:150px; display:flex; align-items:center; justify-content:center; margin:0 auto;">
            <img src="{{ asset('landing/images/footer/monitoring.png') }}" alt="Lakukan Monitoring" style="max-width:100%; max-height:100%;">
        </div>
        <p class="mt-2 fw-bold">Lakukan Monitoring</p>
    </div>
</div>





    {{-- Form --}}
    <div class="card p-4">
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- A. Data Diri --}}
                <div class="col-md-6 mb-3">
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
                <div class="col-md-6 mb-3">
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
                <button type="submit" class="btn btn-success w-100">Kirim</button>
            </div>
        </form>
    </div>

</div>
@endsection



