@extends('layouts.landing.app')

@section('content')
<title>Layanan Administrasi Online</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #c5d6a5;
    margin: 0;
    padding: 0;
    line-height: 1.5;
  }

  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 30px;
    gap: 30px;
  }

  .content-header {
    max-width: 1000px;
    margin: 30px auto 20px;
  }

  .content-header h1 {
    font-size: 28px;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
  }

  .content-header p {
    font-size: 16px;
    margin-bottom: 20px;
    text-align: left;
  }

  .content-header h2 {
    font-size: 22px;
    margin-bottom: 25px;
    font-weight: bold;
    text-align: left;
  }

  .form-box {
    background: #fff;
    padding: 20px 25px;
    border-radius: 10px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    flex: 1;
    min-width: 350px;
    max-width: 600px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
  }

  .form-group input[type="file"] {
    padding: 5px;
  }

  .checkbox-group {
    margin-top: 15px;
  }

  .checkbox-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
  }

  .btn-submit {
    background: #6b8e23;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 15px;
  }

  .btn-submit:hover {
    background: #557a1f;
  }
</style>

<div class="content-header">
  <h1>Layanan Online</h1>
  <p>
    Pelayanan online merupakan fitur layanan administrasi di Desa ------
    yang dapat mempermudah masyarakat dalam pengurusan surat secara online
    dimanapun dan kapanpun.
  </p>
  <h2>Formulir Layanan Administrasi</h2>
</div>

<div class="container">
  <!-- Form kiri -->
  <form class="form-box">
    <div class="form-group">
      <label>Email</label>
      <input type="email" placeholder="Masukkan Email Anda">
    </div>
    <div class="form-group">
      <label>Nama</label>
      <input type="text" placeholder="Masukkan Nama Anda">
    </div>
    <div class="form-group">
      <label>Nomor NIK/KTP</label>
      <input type="text" placeholder="Masukkan Nomor NIK/KTP Anda">
    </div>
    <div class="form-group">
      <label>Nomor KK</label>
      <input type="text" placeholder="Masukkan Nomor KK Anda">
    </div>
    <div class="form-group">
      <label>Jenis Kelamin</label>
      <select>
        <option value="">Pilih Jenis Kelamin</option>
        <option>Laki-laki</option>
        <option>Perempuan</option>
      </select>
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="text" placeholder="Masukkan Alamat Anda">
    </div>
    <div class="form-group">
      <label>Jenis Surat</label>
      <select>
        <option value="">Pilih Jenis Surat</option>
        <option>Pengantar KK</option>
        <option>Pengantar KTP</option>
        <option>Pengantar SKTM</option>
        <option>Surat Keterangan Tidak Mampu</option>
        <option>Surat Domisili</option>
      </select>
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <input type="text" placeholder="Masukkan Alamat">
    </div>
  </form>

  <!-- Form kanan -->
  <form class="form-box">
    <div class="form-group">
      <label>Jenis Pengambilan Surat</label>
      <select>
        <option value="">Pilih Jenis Pengambilan Surat</option>
        <option>Offline</option>
        <option>Online</option>
      </select>
    </div>
    <div class="form-group">
      <label>Upload Berkas Scan/Foto Surat</label>
      <input type="file">
    </div>
    <div class="form-group">
      <label>Upload Berkas Scan/Foto Surat</label>
      <input type="file">
    </div>
    <div class="form-group">
      <label>Upload Berkas Scan/Tanda Pendukung Lainnya (Opsional)</label>
      <input type="file">
    </div>
    <div class="checkbox-group">
      <label>
        <input type="checkbox"> Data yang Anda berikan adalah benar
      </label>
    </div>
    <button type="submit" class="btn-submit">Kirim Surat</button>
  </form>
</div>
@endsection
