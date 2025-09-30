@extends('layouts.landing.app')

@section('content')
<div class="container my-5">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(90deg, #3B82F6, #31C48D);
            color: #fff;
        }

        table th, table td {
            vertical-align: middle;
        }

        /* Tombol dengan gradient biru */
        .btn-gradient-primary {
            background: linear-gradient(90deg, #3B82F6, #31C48D);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-gradient-primary:hover {
            opacity: 0.9;
        }

        .btn-gradient-success {
            background: linear-gradient(90deg, #4caf50, #81c784);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-gradient-success:hover {
            opacity: 0.9;
        }

        /* Form styling */
        .form-control, .form-check-input {
            border-radius: 8px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 5px rgba(59,130,246,0.3);
        }

        .form-check-label {
            font-size: 14px;
        }

        h5 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 20px;
        }

        button.btn {
            font-weight: 600;
            padding: 10px 20px;
        }

        /* Card khusus form bawah */
        .form-card {
            width: 100% !important;     /* isi penuh container */
            max-width: 1200px;          /* biar tidak terlalu melebar */
        }

        /* Responsive */
        @media (max-width: 768px) {
            .d-flex.justify-content-center {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>

    {{-- Judul --}}
    <div class="card p-4">
        <h4 class="fw-bold">Form Permohonan & Keberatan Informasi untuk Penyandang Disabilitas</h4>
        <p class="mb-0">
            Masyarakat difabel dapat mengakses layanan ini secara online maupun dengan bantuan petugas PPID.
            Tujuannya adalah memastikan setiap warga negara memiliki hak yang sama dalam memperoleh informasi publik
            sesuai dengan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
        </p>
    </div>

    {{-- Tabel Layanan --}}
    <div class="card">
        <div class="card-header">
            Tabel Layanan Formulir
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead style="background: linear-gradient(90deg, #3B82F6, #31C48D); color: white;">
                    <tr>
                        <th>Jenis Layanan</th>
                        <th>Deskripsi Singkat</th>
                        <th>Formulir Online</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Permohonan Informasi</td>
                        <td>Pengajuan permintaan informasi publik oleh penyandang disabilitas. Petugas siap membantu jika diperlukan.</td>
                        <td>
                            <button class="btn btn-gradient-success btn-sm" onclick="showForm('formPermohonan')">
                                Isi Form Permohonan Informasi
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Pernyataan Keberatan</td>
                        <td>Pengajuan keberatan jika permohonan informasi ditolak atau tidak sesuai ketentuan.</td>
                        <td>
                            <button class="btn btn-gradient-primary btn-sm" onclick="showForm('formKeberatan')">
                                Isi Form Pernyataan Keberatan
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="d-flex justify-content-center flex-column align-items-center">
        {{-- Form Permohonan --}}
        <div id="formPermohonan" class="card p-4 mb-5 form-card d-none">
            <h5>Form Permohonan Informasi Disabilitas</h5>
            <form>
                <div class="mb-3"><label>Nama</label><input type="text" class="form-control" placeholder="Masukkan Nama Anda"></div>
                <div class="mb-3"><label>Alamat</label><input type="text" class="form-control" placeholder="Masukkan Alamat Anda"></div>
                <div class="mb-3"><label>Pekerjaan</label><input type="text" class="form-control" placeholder="Masukkan Pekerjaan Anda"></div>
                <div class="mb-3"><label>Nomor Telepon</label><input type="text" class="form-control" placeholder="Masukkan Nomor Telepon Anda"></div>
                <div class="mb-3"><label>Identitas (KTP/SIM/KTM)</label><input type="file" class="form-control"></div>
                <div class="mb-3"><label>Rincian Informasi yang Dibutuhkan</label><textarea class="form-control"></textarea></div>
                <div class="mb-3"><label>Tujuan Penggunaan</label><textarea class="form-control"></textarea></div>
                <button type="submit" class="btn btn-gradient-success w-100">Kirim</button>
            </form>
        </div>

        {{-- Form Keberatan --}}
        <div id="formKeberatan" class="card p-4 mb-5 form-card d-none">
            <h5>Form Pernyataan Keberatan Untuk Disabilitas</h5>
            <form>
                <div class="mb-3"><label>Tujuan Pengguna Informasi</label><input type="text" class="form-control" placeholder="Masukkan Tujuan Pengguna Informasi"></div>
                <div class="mb-3"><label>Nama</label><input type="text" class="form-control" placeholder="Masukkan Nama Anda"></div>
                <div class="mb-3"><label>Alamat</label><input type="text" class="form-control" placeholder="Masukkan Alamat Anda"></div>
                <div class="mb-3"><label>Pekerjaan</label><input type="text" class="form-control" placeholder="Masukkan Pekerjaan Anda"></div>
                <div class="mb-3"><label>Nomor Telepon</label><input type="text" class="form-control" placeholder="Masukkan Nomor Telepon Anda"></div>
                <div class="mb-3">
                    <label>Alasan Pengajuan Keberatan</label><br>
                    <div class="form-check"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Permohonan Informasi Ditolak</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Informasi Berkala Tidak Disediakan</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Permintaan Informasi Tidak Ditanggapi</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox"> <label class="form-check-label">Permintaan Informasi Tidak Dipenuhi</label></div>
                </div>
                <div class="mb-3"><label>Kasus Posisi</label><textarea class="form-control"></textarea></div>
                <button type="submit" class="btn btn-gradient-primary w-100">Kirim</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showForm(formId) {
        document.getElementById('formPermohonan').classList.add('d-none');
        document.getElementById('formKeberatan').classList.add('d-none');
        document.getElementById(formId).classList.remove('d-none');
        window.scrollTo({ top: document.getElementById(formId).offsetTop - 100, behavior: 'smooth' });
    }
</script>
@endsection
