@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pendidikan</title>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    margin: 0;
    background-color: #f5f7fa;
    color: #333;
  }

  .card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  }

  .card h6 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #222;
    border-left: 5px solid #3B82F6;
    padding-left: 10px;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
    border-radius: 12px;
    overflow: hidden;
  }

  .table th, .table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
  }

  .table thead {
    background: linear-gradient(90deg, #3B82F6, #31C48D);
    color: #fff;
  }

  .table tbody tr:hover {
    background-color: #f0f9ff;
    transition: background 0.3s;
  }

  .filter-toggle {
    display: block;
    background-color: #3B82F6;
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
    max-height: 400px;
    overflow-y: auto;
  }

  .filter-content.active {
    display: block;
  }

  .dusun-card {
    background: #f0f9f0;
    border-radius: 10px;
    padding: 12px 15px;
    margin-bottom: 12px;
    transition: background 0.3s;
  }

  .dusun-card:hover {
    background: #d6efd6;
  }

  .dusun-card h4 {
    margin: 0 0 5px 0;
    font-size: 15px;
    font-weight: 600;
    color: #222;
  }

  .dusun-card small {
    font-size: 12px;
    color: #555;
  }

  .search-box {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
  }

  @media (max-width: 992px) {
    .row {
      flex-direction: column;
    }
  }
</style>

<div class="container py-4">
  <div class="row g-3">
    <!-- Main Content -->
    <div class="col-md-9 d-flex flex-column gap-3">
      <!-- Chart Card -->
      <div class="card">
        <h6>Statistik Pendidikan Penduduk</h6>
        <div id="pendidikan-chart"></div>
      </div>

      <!-- Table Card -->
      <div class="card">
        <h6>Tabel Data Pendidikan</h6>
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Tingkat Pendidikan</th>
              <th>Jumlah</th>
              <th>Presentase</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>SD</td><td>55</td><td>55%</td></tr>
            <tr><td>2</td><td>SMP</td><td>25</td><td>25%</td></tr>
            <tr><td>3</td><td>SMA</td><td>20</td><td>20%</td></tr>
            <tr class="fw-bold table-light"><td>4</td><td>Total</td><td>100</td><td>100%</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Sidebar Filter -->
    <div class="col-md-3 d-flex">
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
  const options = {
    series: [{
      name: "Jumlah",
      data: [55, 25, 20]
    }],
    chart: { type: "bar", height: 400, toolbar: { show: false } },
    colors: ["#31C48D", "#3B82F6", "#F59E0B"],
    plotOptions: { bar: { horizontal: false, columnWidth: "50%", borderRadius: 8 } },
    dataLabels: {
      enabled: true,
      formatter: function (val) { return val + "%"; },
      style: { colors: ["#111"] }
    },
    xaxis: { categories: ["SD", "SMP", "SMA"], labels: { style: { fontFamily: "Inter, sans-serif", fontSize: "13px" } } },
    yaxis: { max: 100, labels: { formatter: val => val + "%" } },
    legend: { show: false },
    grid: { borderColor: "#e5e7eb", strokeDashArray: 4 },
    tooltip: { y: { formatter: val => val + " Penduduk" } }
  };

  if(document.getElementById("pendidikan-chart")) {
    const chart = new ApexCharts(document.getElementById("pendidikan-chart"), options);
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
