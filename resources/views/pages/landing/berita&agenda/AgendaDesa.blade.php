@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Agenda</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #C0D09D; /* hijau muda background */
  }

  .container {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    padding: 20px;
  }

  /* Bagian kiri (agenda kegiatan) */
  .agenda-list {
    flex: 3;
  }

  .agenda-list h2 {
    margin-bottom: 20px;
  }

  .agenda-card {
    background: #fff;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  .agenda-card h3 {
    margin: 0 0 10px 0;
  }

  .agenda-meta {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
  }

  .agenda-card button {
    background: #444;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  /* Bagian kanan (sidebar) */
  .sidebar {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .search-box input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  /* Kategori Agenda jadi button */
  .kategori {
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  .kategori h3 {
    margin-bottom: 10px;
  }

  .kategori button {
    display: block;
    width: 100%;
    padding: 8px;
    margin-bottom: 8px;
    border: none;
    border-radius: 5px;
    background: #e0e0e0;
    cursor: pointer;
    text-align: left;
  }

  .kategori button:hover {
    background: #c0c0c0;
  }

  /* Agenda Terbaru */
  .agenda-terbaru {
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  .agenda-terbaru h3 {
    margin-bottom: 15px;
  }

  .agenda-item {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
    align-items: center;
  }

  .agenda-date {
    background: #4caf50;
    color: white;
    padding: 8px;
    border-radius: 5px;
    text-align: center;
    width: 60px;
    flex-shrink: 0;
  }

  .agenda-date .day {
    font-size: 16px;
    font-weight: bold;
  }

  .agenda-date .month {
    font-size: 12px;
  }

  .agenda-info {
    flex: 1;
  }

  .agenda-info h4 {
    margin: 0;
    font-size: 14px;
  }

  .agenda-info p {
    margin: 2px 0 0;
    font-size: 12px;
    color: #555;
  }

</style>

<div class="container">
  <!-- Kiri -->
  <div class="agenda-list">
    <h2>Agenda Kegiatan</h2>

    <div class="agenda-card">
      <h3>Judul Agenda</h3>
      <div class="agenda-meta">📅 11 September 2025 | 📍 Aula</div>
      <p>Keterangan agenda kegiatan...</p>
      <button>Selengkapnya →</button>
    </div>

    <div class="agenda-card">
      <h3>Judul Agenda 2</h3>
      <div class="agenda-meta">📅 15 September 2025 | 📍 Balai Desa</div>
      <p>Keterangan agenda kegiatan...</p>
      <button>Selengkapnya →</button>
    </div>

    <div class="agenda-card">
      <h3>Judul Agenda 3</h3>
      <div class="agenda-meta">📅 20 September 2025 | 📍 Lapangan</div>
      <p>Keterangan agenda kegiatan...</p>
      <button>Selengkapnya →</button>
    </div>
  </div>

  <!-- Kanan -->
  <div class="sidebar">
    <div class="search-box">
      <h3>Cari Agenda</h3>
      <input type="text" placeholder="Cari Agenda...">
    </div>

    <div class="kategori">
      <h3>Kategori Agenda</h3>
      <button>Umum</button>
      <button>Rapat</button>
      <button>Pelatihan</button>
      <button>Sosialisasi</button>
      <button>Acara Resmi</button>
      <button>Internal</button>
      <button>Eksternal</button>
    </div>

    <div class="agenda-terbaru">
      <h3>Agenda Terbaru</h3>

      <div class="agenda-item">
        <div class="agenda-date">
          <div class="day">11</div>
          <div class="month">Sep</div>
        </div>
        <div class="agenda-info">
          <h4>Judul Agenda</h4>
          <p>📍 Aula</p>
        </div>
      </div>

      <div class="agenda-item">
        <div class="agenda-date">
          <div class="day">15</div>
          <div class="month">Sep</div>
        </div>
        <div class="agenda-info">
          <h4>Judul Agenda 2</h4>
          <p>📍 Balai Desa</p>
        </div>
      </div>

      <div class="agenda-item">
        <div class="agenda-date">
          <div class="day">20</div>
          <div class="month">Sep</div>
        </div>
        <div class="agenda-info">
          <h4>Judul Agenda 3</h4>
          <p>📍 Lapangan</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
