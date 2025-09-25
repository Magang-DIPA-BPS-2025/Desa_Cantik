@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Agenda</title>
<style>
body {
  font-family: 'Segoe UI', Arial, sans-serif;
  margin: 0;
  background: #f5f7fa;
  color: #333;
}

.container {
  display: flex;
  gap: 25px;
  align-items: flex-start;
  padding: 25px;
}

.agenda-list {
  flex: 3;
}

.agenda-list h2 {
  margin-bottom: 25px;
  font-size: 28px;
  font-weight: 700;
  border-left: 6px solid #4CAF50;
  padding-left: 12px;
  color: #222;
}

.agenda-card {
  background: #fff;
  border-radius: 15px;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  transition: transform 0.3s, box-shadow 0.3s;
}
.agenda-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.agenda-card .thumb {
  width: 100%;
  height: 180px;
  border-radius: 12px;
  object-fit: cover;
  margin-bottom: 15px;
  transition: transform 0.3s;
}
.agenda-card:hover .thumb {
  transform: scale(1.05);
}

.agenda-card h3 {
  margin: 0 0 12px 0;
  font-size: 20px;
  color: #222;
}

.agenda-meta {
  font-size: 14px;
  color: #666;
  margin-bottom: 12px;
}

.agenda-card p {
  font-size: 14px;
  line-height: 1.5;
  color: #555;
}

.agenda-card button {
  background: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: background 0.3s;
}
.agenda-card button:hover {
  background: #45a049;
}

.sidebar {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 25px;
}

.search-box input {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
  transition: border 0.3s;
}
.search-box input:focus {
  border-color: #4CAF50;
  outline: none;
}

.kategori {
  background: #fff;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}
.kategori h3 {
  margin-bottom: 15px;
  font-size: 18px;
  font-weight: 600;
  color: #222;
}
.kategori button {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: none;
  border-radius: 8px;
  background: #e8f5e9;
  color: #333;
  font-weight: 500;
  cursor: pointer;
  text-align: left;
  transition: background 0.3s;
}
.kategori button:hover {
  background: #c8e6c9;
}

.agenda-terbaru {
  background: #fff;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}
.agenda-terbaru h3 {
  margin-bottom: 18px;
  font-size: 18px;
  font-weight: 600;
  color: #222;
}
.agenda-item {
  display: flex;
  gap: 12px;
  margin-bottom: 15px;
  align-items: center;
  transition: background 0.2s;
  padding: 6px;
  border-radius: 8px;
}
.agenda-item:hover {
  background: #f0f9f0;
}

.agenda-date {
  background: #4CAF50;
  color: white;
  padding: 10px;
  border-radius: 10px;
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

.agenda-info h4 {
  margin: 0;
  font-size: 15px;
  font-weight: 600;
}
.agenda-info p {
  margin: 3px 0 0;
  font-size: 13px;
  color: #555;
}

@media (max-width: 992px) {
  .container {
    flex-direction: column;
  }
  .sidebar {
    margin-top: 25px;
  }
}
</style>

<div class="container">
  <!-- Kiri -->
  <div class="agenda-list">
    <h2>Agenda Kegiatan</h2>

    <div class="agenda-card">
      <img class="thumb" src="https://images.unsplash.com/photo-1564869732096-8cf1e2e8c431?crop=entropy&cs=tinysrgb&fit=max&h=180&w=400" alt="Foto Agenda">
      <h3>Judul Agenda</h3>
      <div class="agenda-meta">📅 11 September 2025 | 📍 Aula</div>
      <p>Keterangan agenda kegiatan ini singkat, jelas, dan menarik agar mudah dibaca oleh warga desa.</p>
      <button>Selengkapnya →</button>
    </div>

    <div class="agenda-card">
      <img class="thumb" src="https://images.unsplash.com/photo-1596496057984-7c9f74d8f0e3?crop=entropy&cs=tinysrgb&fit=max&h=180&w=400" alt="Foto Agenda">
      <h3>Judul Agenda 2</h3>
      <div class="agenda-meta">📅 15 September 2025 | 📍 Balai Desa</div>
      <p>Keterangan agenda kegiatan ini singkat, jelas, dan menarik agar mudah dibaca oleh warga desa.</p>
      <button>Selengkapnya →</button>
    </div>

    <div class="agenda-card">
      <img class="thumb" src="https://images.unsplash.com/photo-1581092334156-99f0e19c5d1f?crop=entropy&cs=tinysrgb&fit=max&h=180&w=400" alt="Foto Agenda">
      <h3>Judul Agenda 3</h3>
      <div class="agenda-meta">📅 20 September 2025 | 📍 Lapangan</div>
      <p>Keterangan agenda kegiatan ini singkat, jelas, dan menarik agar mudah dibaca oleh warga desa.</p>
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
