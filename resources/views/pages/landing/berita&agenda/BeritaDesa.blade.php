@extends('layouts.landing.app')

@section('content')
  <title>Desa Cantik - Berita</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #d4e2c2; /* hijau muda background */
    }

    /* Container utama */
    .container {
      display: flex;
      max-width: 1200px;
      margin: 20px auto;
      gap: 20px;
    }

    /* Teks judul di atas grid berita */
    .section-title {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 15px;
      color: #333;
    }

    /* Grid Berita */
    .berita-grid {
      flex: 3;
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* 3 kolom */
      gap: 15px;
    }
    .berita-card {
      background: #fff;
      border: 1px solid #ddd;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      overflow: hidden;
    }
    .berita-card .thumb {
      width: 100%;
      height: 150px;
      background: #ccc;
    }
    .berita-card .info {
      padding: 8px;
      font-size: 12px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .berita-card .info span {
      color: #666;
    }
    .berita-card .date {
      background: #4CAF50;
      color: #fff;
      font-weight: bold;
      padding: 4px 6px;
      font-size: 12px;
      position: absolute;
      bottom: 8px;
      right: 8px;
      border-radius: 3px;
    }
    .berita-card .views {
      font-size: 12px;
      color: #444;
    }

    /* Sidebar */
    .sidebar {
      flex: 1;
      background: #fff;
      border: 1px solid #ddd;
      padding: 15px;
      height: fit-content; /* mengikuti tinggi konten */
    }
    .sidebar h2 {
      font-size: 18px;
      margin-bottom: 15px;
    }
    .sidebar .item {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }
    .sidebar .item .thumb {
      width: 60px;
      height: 40px;
      background: #ccc;
      flex-shrink: 0;
    }
    .sidebar .item .desc h4 {
      font-size: 14px;
      margin: 0;
    }
    .sidebar .item .desc small {
      color: gray;
      font-size: 12px;
      display: block;
    }

    /* Pagination */
    .pagination {
      margin: 20px 0;
      text-align: center;
      grid-column: span 3; /* agar posisinya full width dalam grid */
    }
    .pagination ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: inline-flex;
      gap: 8px;
      align-items: center;
    }
    .pagination li {
      display: inline-block;
    }
    .pagination a {
      text-decoration: none;
      color: #333;
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 14px;
    }
    .pagination .active a {
      background: #333;
      color: #fff;
    }
    .pagination a:hover {
      background: #4CAF50;
      color: #fff;
    }
  </style>

  <!-- Konten -->
  <div class="container">
    <!-- Grid Berita -->
    <div style="flex:3">
      <div class="section-title">Daftar Berita</div>

      <div class="berita-grid">
        <!-- 9 berita dummy (3x3) -->
        @for ($i = 1; $i <= 9; $i++)
          <div class="berita-card">
            <div class="thumb"></div>
            <div class="info">
              <span>9 September 2025</span>
              <div class="date">11 Sep 2025</div>
              <div class="views">Dilihat {{ 100 + $i }} kali</div>
            </div>
          </div>
        @endfor

        <!-- Pagination -->
        <div class="pagination">
          <ul>
            <li><a href="#">&laquo; Previous</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">…</a></li>
            <li><a href="#">67</a></li>
            <li><a href="#">68</a></li>
            <li><a href="#">Next &raquo;</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <h2>Berita Terbaru</h2>
      <div class="item"><div class="thumb"></div><div class="desc"><h4>Judul berita</h4><small>20 September 2025</small><small>Dilihat 100 kali</small></div></div>
      <div class="item"><div class="thumb"></div><div class="desc"><h4>Judul berita</h4><small>19 September 2025</small><small>Dilihat 90 kali</small></div></div>
      <div class="item"><div class="thumb"></div><div class="desc"><h4>Judul berita</h4><small>18 September 2025</small><small>Dilihat 80 kali</small></div></div>
    </div>
  </div>
@endsection
