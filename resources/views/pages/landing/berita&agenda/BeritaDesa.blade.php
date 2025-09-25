@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Berita</title>
<style>
body {
  font-family: 'Segoe UI', Arial, sans-serif;
  margin: 0;
  background: #f5f6fa;
}

.container {
  display: flex;
  max-width: 1200px;
  margin: 30px auto;
  gap: 25px;
}

/* Judul section */
.section-title {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 25px;
  color: #222;
  border-left: 6px solid #4CAF50;
  padding-left: 12px;
}

/* Grid Berita */
.berita-grid {
  flex: 3;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 25px;
}
.berita-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s, box-shadow 0.3s;
  position: relative;
  min-height: 340px;
}
.berita-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.berita-card .thumb {
  width: 100%;
  height: 200px;
  background: #ccc;
  object-fit: cover;
  transition: transform 0.3s;
}
.berita-card:hover .thumb {
  transform: scale(1.05);
}
.berita-card .info {
  padding: 15px 18px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.berita-card .info span {
  color: #777;
  font-size: 13px;
}
.berita-card .info .title {
  font-size: 17px;
  font-weight: 600;
  color: #222;
  margin: 0;
}
.berita-card .info .desc-text {
  font-size: 14px;
  color: #555;
  line-height: 1.5;
  margin-bottom: 8px;
}
.berita-card .date {
  background: #4CAF50;
  color: #fff;
  font-weight: 600;
  padding: 5px 10px;
  font-size: 12px;
  position: absolute;
  bottom: 15px;
  right: 15px;
  border-radius: 5px;
}
.berita-card .views {
  font-size: 12px;
  color: #888;
  display: flex;
  align-items: center;
  gap: 4px;
}

/* Sidebar */
.sidebar {
  flex: 1;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.08);
  padding: 22px;
  height: fit-content;
}
.sidebar h2 {
  font-size: 22px;
  margin-bottom: 22px;
  border-bottom: 2px solid #4CAF50;
  padding-bottom: 8px;
  color: #222;
}
.sidebar .item {
  display: flex;
  gap: 12px;
  margin-bottom: 18px;
  transition: background 0.2s;
  padding: 6px;
  border-radius: 8px;
}
.sidebar .item:hover {
  background: #f0f9f0;
}
.sidebar .item .thumb {
  width: 65px;
  height: 45px;
  background: #ccc;
  flex-shrink: 0;
  border-radius: 6px;
  object-fit: cover;
}
.sidebar .item .desc h4 {
  font-size: 15px;
  margin: 0 0 3px 0;
  color: #333;
}
.sidebar .item .desc small {
  color: #777;
  font-size: 12px;
  display: block;
}
.sidebar .item .desc .views {
  display: flex;
  align-items: center;
  gap: 4px;
  color: #888;
}

/* Pagination */
.pagination {
  margin: 30px 0;
  text-align: center;
  grid-column: span 3;
}
.pagination ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: inline-flex;
  gap: 10px;
  align-items: center;
}
.pagination li {
  display: inline-block;
}
.pagination a {
  text-decoration: none;
  color: #333;
  padding: 6px 14px;
  border-radius: 6px;
  font-size: 14px;
  transition: all 0.3s;
  border: 1px solid #ddd;
}
.pagination .active a {
  background: #4CAF50;
  color: #fff;
  border-color: #4CAF50;
}
.pagination a:hover {
  background: #4CAF50;
  color: #fff;
  border-color: #4CAF50;
}

/* Responsive */
@media (max-width: 992px) {
  .berita-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 768px) {
  .container {
    flex-direction: column;
  }
  .berita-grid {
    grid-template-columns: 1fr;
  }
  .sidebar {
    margin-top: 25px;
  }
}
</style>

<div class="container">
  <!-- Grid Berita -->
  <div style="flex:3">
    <div class="section-title">Daftar Berita</div>

    <div class="berita-grid">
      @for ($i = 1; $i <= 9; $i++)
      <div class="berita-card">
        <div class="thumb"></div>
        <div class="info">
          <span>9 September 2025</span>
          <h3 class="title">Judul Berita Desa Cantik #{{ $i }}</h3>
          <p class="desc-text">Deskripsi singkat mengenai berita desa cantik ini agar pembaca lebih mudah memahami isi berita dan mendapatkan informasi yang jelas.</p>
          <div class="views">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="#888" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 4a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
              <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
            </svg>
            Dilihat {{ 100 + $i }} kali
          </div>
          <div class="date">11 Sep 2025</div>
        </div>
      </div>
      @endfor

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
    @for ($j = 1; $j <= 3; $j++)
    <div class="item">
      <div class="thumb"></div>
      <div class="desc">
        <h4>Judul berita #{{ $j }}</h4>
        <small>20 September 2025</small>
        <div class="views">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#888" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 4a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
            <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
          </svg>
          Dilihat {{ 100 + $j * 10 }} kali
        </div>
      </div>
    </div>
    @endfor
  </div>
</div>
@endsection
