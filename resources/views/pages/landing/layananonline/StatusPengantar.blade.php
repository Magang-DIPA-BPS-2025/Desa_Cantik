@extends('layouts.landing.app')
@section('content')
<div class="container mt-4">

    {{-- Judul --}}
    <h2 class="mb-3" style="text-align: left;">Form Permohonan & Keberatan Informasi Disabilitas</h2>
    <p>Masyarakat difabel dapat mengakses layanan ini secara online maupun dengan bantuan petugas PPID.</p>

    {{-- Tabel Layanan --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Jenis Layanan</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Permohonan Informasi</td>
                <td>Pengajuan permintaan informasi publik oleh penyandang disabilitas.</td>
                <td>
                    <span class="btn btn-link p-0" onclick="showForm('formPermohonan')">
                        Isi Form Permohonan
                    </span>
                </td>
            </tr>
            <tr>
                <td>Pernyataan Keberatan</td>
                <td>Pengajuan keberatan jika permohonan informasi ditolak atau tidak sesuai ketentuan.</td>
                <td>
                    <span class="btn btn-link p-0" onclick="showForm('formKeberatan')">
                        Isi Form Keberatan
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Form Permohonan --}}
    <div id="formPermohonan" class="card p-4 mt-4 d-none">
        <h4>Form Permohonan Informasi</h4>
        <form>
            <input type="text" class="form-control mb-2" placeholder="Nama">
            <input type="text" class="form-control mb-2" placeholder="Alamat">
            <input type="text" class="form-control mb-2" placeholder="Pekerjaan">
            <input type="text" class="form-control mb-2" placeholder="Nomor Telepon">
            <textarea class="form-control mb-2" placeholder="Rincian Informasi yang Dibutuhkan"></textarea>
            <input type="text" class="form-control mb-2" placeholder="Tujuan Penggunaan">
            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
    </div>

    {{-- Form Keberatan --}}
    <div id="formKeberatan" class="card p-4 mt-4 d-none">
        <h4>Form Pernyataan Keberatan</h4>
        <form>
            <input type="text" class="form-control mb-2" placeholder="Nama">
            <input type="text" class="form-control mb-2" placeholder="Alamat">
            <input type="text" class="form-control mb-2" placeholder="Pekerjaan">
            <input type="text" class="form-control mb-2" placeholder="Nomor Telepon">
            <textarea class="form-control mb-2" placeholder="Kasus Posisi"></textarea>
            <button type="submit" class="btn btn-danger">Kirim</button>
        </form>
    </div>

</div>
@endsection
