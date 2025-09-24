@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Agama</title>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #cfe2b8;
  }

  .row {
    align-items: stretch;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
  }

  .data-table th,
  .data-table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
  }

  .data-table thead {
    background-color: #f1f1f1;
  }

  .filter-toggle {
    display: block;
    background-color: #007BFF;
    color: white;
    text-align: center;
    padding: 8px;
    cursor: pointer;
    border-radius: 4px;
    margin-bottom: 8px;
    font-size: 14px;
  }

  .filter-content {
    display: none;
    margin-top: 8px;
    max-height: 100%;
    overflow-y: auto;
    padding-right: 5px;
  }

  .filter-content.active {
    display: block;
  }

  .dusun-card {
    background-color: white;
    border-radius: 4px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.08);
    padding: 6px 8px;
    margin-bottom: 30px;
    transition: background 0.2s;
  }

  .dusun-card:hover {
    background-color: #f8f9fa;
  }

  .dusun-card h4 {
    margin: 0 0 3px 0;
    font-size: 13px;
    font-weight: 600;
  }

  .dusun-card small {
    font-size: 11px;
    color: #666;
  }

  .search-box {
    width: 100%;
    padding: 6px;
    margin-top: 6px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 13px;
  }

  .main-content > .card + .card {
    margin-top: 20px;
  }
</style>

<div class="container py-4">
  <div class="row g-3">
    <!-- Main Content -->
    <div class="col-md-9 d-flex flex-column main-content">

      <!-- Card Chart -->
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Statistik Agama Penduduk</h6>
          <div id="pie-chart"></div>
        </div>
      </div>

      <!-- Card Table -->
      <div class="card shadow-sm flex-fill">
        <div class="card-body">
          <h6 class="card-title">Tabel Data Agama</h6>
          <table class="data-table mt-2">
            <thead>
              <tr>
                <th>No</th>
                <th>Agama</th>
                <th>Jumlah</th>
                <th>Presentase</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>1</td><td>Islam</td><td>70</td><td>70%</td></tr>
              <tr><td>2</td><td>Kristen</td><td>10</td><td>10%</td></tr>
              <tr><td>3</td><td>Katolik</td><td>5</td><td>5%</td></tr>
              <tr><td>4</td><td>Hindu</td><td>5</td><td>5%</td></tr>
              <tr><td>5</td><td>Buddha</td><td>3</td><td>3%</td></tr>
              <tr><td>6</td><td>Khonghucu</td><td>2</td><td>2%</td></tr>
              <tr><td colspan="2"><strong>Total</strong></td><td><strong>100</strong></td><td><strong>100%</strong></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Sidebar Filter -->
    <div class="col-md-3 d-flex">
      <div class="card flex-fill shadow-sm">
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

<!-- Chart Script -->
<script>
  const getChartOptions = () => {
    return {
      series: [70, 10, 5, 5, 3, 2, 5],
      colors: ["#C0D09D", "#A4BC92", "#95A78D", "#BCC5A8", "#8C9C74", "#708B75"],
      chart: {
        height: 420,
        width: "100%",
        type: "pie",
      },
      stroke: {
        colors: ["white"],
      },
      labels: ["Islam", "Kristen", "Katolik", "Hindu", "Buddha", "Khonghucu"],
      dataLabels: {
        enabled: true,
        style: {
          fontFamily: "Arial, sans-serif",
          fontSize: "13px"
        },
        formatter: function (val, opts) {
          return val.toFixed(1) + '%';
        }
      },
      legend: {
        position: "bottom",
        fontFamily: "Arial, sans-serif",
        fontSize: "13px"
      },
    }
  }

  if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
    chart.render();
  }

  function toggleFilter() {
    const filter = document.getElementById('filterContent');
    filter.classList.toggle('active');
  }

  document.getElementById('searchBox').addEventListener('keyup', function () {
    let query = this.value.toLowerCase();
    let cards = document.querySelectorAll('.dusun-card');
    cards.forEach(card => {
      let text = card.innerText.toLowerCase();
      card.style.display = text.includes(query) ? 'block' : 'none';
    });
  });
</script>
@endsection
