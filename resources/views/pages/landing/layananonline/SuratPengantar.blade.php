@extends('layouts.landing.app')

@section('content')
<title>Layanan Administrasi Online</title>

<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f0f4f8;
    margin: 0;
    padding: 0;
    line-height: 1.6;
    color: #333;
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
    text-align: left;
  }

  .content-header h1 {
    font-size: 32px;
    margin-bottom: 10px;
    font-weight: 700;
    color: #2c3e50;
  }

  .content-header p {
    font-size: 16px;
    margin-bottom: 20px;
    color: #555;
  }

  .content-header h2 {
    font-size: 24px;
    margin-bottom: 25px;
    font-weight: 700;
    color: #34495e;
  }

  .form-box {
    background: #fff;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    flex: 1;
    min-width: 350px;
    max-width: 600px;
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .form-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
  }

  .form-group {
    margin-bottom: 18px;
  }

  .form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #2c3e50;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: border-color 0.3s, box-shadow 0.3s;
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: #3B82F6;
    box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
    outline: none;
  }

  .checkbox-group {
    margin-top: 15px;
  }

  .checkbox-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    cursor: pointer;
  }

  .btn-submit {
    background: linear-gradient(90deg, #3B82F6, #31C48D);
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    font-weight: 600;
    transition: background 0.3s, transform 0.2s;
  }

  .btn-submit:hover {
    background: linear-gradient(90deg, #2c6ed5, #28a172);
    transform: translateY(-2px);
  }

  input[type="file"] {
    padding: 5px;
    border-radius: 8px;
  }

  /* Responsive adjustments */
  @media (max-width: 992px) {
    .container {
      flex-direction: column;
      align-items: center;
    }
  }
</style>

<div class="content-header">
  <h1>Layanan Online</h1>
  <p>
    Pelayanan online merupakan fitur administrasi di Desa ------
    yang mempermudah masyarakat dalam pengurusan surat secara online dimanapun dan kapanpun.
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
