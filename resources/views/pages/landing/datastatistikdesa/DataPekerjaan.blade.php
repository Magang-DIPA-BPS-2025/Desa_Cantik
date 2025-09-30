@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pekerjaan</title>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #f0f4f8, #fefefe);
    color: #333;
  }

  /* Container dibatasi max-width */
  .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 15px;
  }

  .card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
  }

  .card h6 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 18px;
    color: #222;
    border-left: 6px solid #3B82F6;
    padding-left: 10px;
  }

  /* Table styling */
  .data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
  }

  .data-table th, .data-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
  }

  .data-table th {
    background: #f5f5f5;
    font-weight: bold;
  }

  .filter-toggle {
    display: block;
    background: linear-gradient(90deg, #3B82F6, #2563EB);
    color: white;
    text-align: center;
    padding: 10px;
    cursor: pointer;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 12px;
    font-weight: 600;
  }

  .filter-content {
    display: none;
    max-height: 300px;
    overflow-y: auto;
  }

  .filter-content.active {
    display: block;
  }

  .dusun-card {
    background: #f0fdf4;
    border-radius: 8px;
    padding: 10px 12px;
    margin-bottom: 12px;
    border: 1px solid #d1fae5;
    transition: background 0.3s;
  }

  .dusun-card:hover {
    background: #dcfce7;
  }

  .dusun-card h4 {
    margin: 0 0 4px 0;
    font-size: 15px;
    font-weight: 600;
    color: #065f46;
  }

  .dusun-card small {
    font-size: 12px;
    color: #444;
  }

  .search-box {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 13px;
  }

  /* Footer styling agar selalu center */
  footer {
  text-align: center;
  padding: 20px 10px;
  font-size: 14px;
  color: #555;
  background: #f9f9f9;
  border-top: 2px solid #4CAF50;
}

  @media (max-width: 992px) {
    .row {
      flex-direction: column;
    }
  }
</style>

<div class="container py-5">
  <div class="row g-4">
    <!-- Main Content -->
    <div class="col-lg-9 col-md-8 d-flex flex-column gap-4">

      <!-- Chart Card -->
      <div class="card">
        <h6>Statistik Pekerjaan Penduduk</h6>
        <div id="pie-chart" style="min-height:420px"></div>
      </div>

      <!-- Table Card -->
      <div class="card">
        <h6>Tabel Data Pekerjaan</h6>
        <table class="data-table mt-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Pekerjaan</th>
              <th>Jumlah</th>
              <th>Presentase</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Tidak Bekerja</td><td>20</td><td>20%</td></tr>
            <tr><td>2</td><td>Petani</td><td>30</td><td>30%</td></tr>
            <tr><td>3</td><td>PNS</td><td>10</td><td>10%</td></tr>
            <tr><td>4</td><td>Pelajar/Mahasiswa</td><td>15</td><td>15%</td></tr>
            <tr><td>5</td><td>Karyawan Swasta</td><td>15</td><td>15%</td></tr>
            <tr><td>6</td><td>Wiraswasta</td><td>10</td><td>10%</td></tr>
            <tr class="fw-bold"><td colspan="2">Total</td><td>100</td><td>100%</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Sidebar Filter -->
    <div class="col-lg-3 col-md-4 d-flex">
      <div class="card flex-fill">
        <div class="card-body">
          <div class="filter-toggle" onclick="toggleFilter()">☰ Filter Dusun</div>
          <div class="filter-content" id="filterContent">
            <input type="search" placeholder="Cari Dusun..." class="search-box" id="searchBox" />

            <!-- Card per Dusun -->
            <div class="dusun-card">
              <h4>Dusun A</h4>
              <small>Tahun 2024</small><br>
              <small>Tahun 2025</small>
            </div>
            <div class="dusun-card">
              <h4>Dusun B</h4>
              <small>Tahun 2024</small><br>
              <small>Tahun 2025</small>
            </div>
            <div class="dusun-card">
              <h4>Dusun C</h4>
              <small>Tahun 2024</small><br>
              <small>Tahun 2025</small>
            </div>
            <div class="dusun-card">
              <h4>Dusun D</h4>
              <small>Tahun 2024</small><br>
              <small>Tahun 2025</small>
            </div>
            <div class="dusun-card">
              <h4>Dusun E</h4>
              <small>Tahun 2024</small><br>
              <small>Tahun 2025</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const getChartOptions = () => {
    return {
      series: [20, 30, 10, 15, 15, 10],
      colors: ["#C0D09D", "#A4BC92", "#95A78D", "#BCC5A8", "#8C9C74", "#708B75"],
      chart: { height: 400, width: "100%", type: "pie" },
      stroke: { colors: ["white"] },
      labels: ["Tidak Bekerja", "Petani", "PNS", "Pelajar/Mahasiswa", "Karyawan Swasta", "Wiraswasta"],
      dataLabels: {
        enabled: true,
        style: { fontFamily: "Arial, sans-serif", fontSize: "12px" },
        formatter: function (val) { return val.toFixed(1) + '%'; }
      },
      legend: { position: "bottom", fontFamily: "Arial, sans-serif", fontSize: "13px" },
    }
  }

  if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
    chart.render();
  }

  function toggleFilter() {
    document.getElementById('filterContent').classList.toggle('active');
  }

  document.getElementById('searchBox').addEventListener('keyup', function () {
    let query = this.value.toLowerCase();
    document.querySelectorAll('.dusun-card').forEach(card => {
      card.style.display = card.innerText.toLowerCase().includes(query) ? 'block' : 'none';
    });
  });
</script>
@endsection

