@extends('layouts.landing.app')

@section('content')
<div class="container my-5">
    <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #c5d6a5;
    margin: 0;
    padding: 0;
    line-height: 1.5;
  }
  </style>

    {{-- Judul --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="fw-bold">Form Permohonan & Keberatan Informasi untuk Penyandang Disabilitas</h4>
            <p class="mb-0">
                Masyarakat difabel dapat mengakses layanan ini secara online maupun dengan bantuan petugas PPID.
                Tujuannya adalah memastikan setiap warga negara memiliki hak yang sama dalam memperoleh informasi publik
                sesuai dengan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
            </p>
        </div>
    </div>

    {{-- Tabel Layanan --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-bold">
            Tabel Layanan Formulir
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
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
            <button class="btn btn-outline-success btn-sm"
                    onclick="showForm('formPermohonan')">
                Isi Form Permohonan Informasi
            </button>
        </td>
    </tr>
    <tr>
        <td>Pernyataan Keberatan</td>
        <td>Pengajuan keberatan jika permohonan informasi ditolak atau tidak sesuai ketentuan.</td>
        <td>
            <button class="btn btn-outline-primary btn-sm"
                    onclick="showForm('formKeberatan')">
                Isi Form Pernyataan Keberatan
            </button>
        </td>
    </tr>
</tbody>

            </table>
        </div>
    </div>

    {{-- Form Section --}}
    <div class="d-flex justify-content-center">
        {{-- Form Permohonan --}}
        <div id="formPermohonan" class="card shadow p-4 mb-5 w-75 d-none">
            <h5 class="mb-3 fw-bold">Form Permohonan Informasi Disabilitas</h5>
            <form>
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Anda">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" class="form-control" placeholder="Masukkan Alamat Anda">
                </div>
                <div class="mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" class="form-control" placeholder="Masukkan Pekerjaan Anda">
                </div>
                <div class="mb-3">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon Anda">
                </div>
                <div class="mb-3">
                    <label>Identitas (KTP/SIM/KTM)</label>
                    <input type="file" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Rincian Informasi yang Dibutuhkan</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Tujuan Penggunaan</label>
                    <textarea class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Kirim</button>
            </form>
        </div>

        {{-- Form Keberatan --}}
        <div id="formKeberatan" class="card shadow p-4 mb-5 w-75 d-none">
            <h5 class="mb-3 fw-bold">Form Pernyataan Keberatan Untuk Disabilitas</h5>
            <form>
                <div class="mb-3">
                    <label>Tujuan Pengguna Informasi</label>
                    <input type="text" class="form-control" placeholder="Masukkan Tujuan Pengguna Informasi">
                </div>
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Anda">
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" class="form-control" placeholder="Masukkan Alamat Anda">
                </div>
                <div class="mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" class="form-control" placeholder="Masukkan Pekerjaan Anda">
                </div>
                <div class="mb-3">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nomor Telepon Anda">
                </div>
                <div class="mb-3">
                    <label>Alasan Pengajuan Keberatan</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"> <label class="form-check-label">Permohonan Informasi Ditolak</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"> <label class="form-check-label">Informasi Berkala Tidak Disediakan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"> <label class="form-check-label">Permintaan Informasi Tidak Ditanggapi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"> <label class="form-check-label">Permintaan Informasi Tidak Dipenuhi</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Kasus Posisi</label>
                    <textarea class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>

</div>

<script>
    function showForm(formId) {
        // sembunyikan semua form
        document.getElementById('formPermohonan').classList.add('d-none');
        document.getElementById('formKeberatan').classList.add('d-none');

        // tampilkan form yang dipilih
        document.getElementById(formId).classList.remove('d-none');
        window.scrollTo({ top: document.getElementById(formId).offsetTop - 100, behavior: 'smooth' });
    }
</script>
@endsection

