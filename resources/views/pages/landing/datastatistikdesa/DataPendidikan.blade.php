@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pendidikan</title>
<style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #d4e2c2; /* hijau muda background */
    }
    </style>
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
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
    margin-bottom: 12px;
    transition: background 0.2s;
    border: 1px solid #e5e7eb;
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
</style>

<div class="container py-4">
  <div class="row g-3">
    <!-- Main Content -->
    <div class="col-md-9 d-flex flex-column main-content">

      <!-- Card Chart -->
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Statistik Pendidikan Penduduk</h6>
          <div id="pendidikan-chart"></div>
        </div>
      </div>

      <!-- Card Table -->
      <div class="card shadow-sm flex-fill mt-4">
        <div class="card-body">
          <h6 class="card-title">Tabel Data Pendidikan</h6>
          <table class="table table-bordered text-center">
            <thead class="table-light">
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

<script>
  const options = {
    series: [{
      name: "Jumlah",
      data: [55, 25, 20] // data sesuai tabel
    }],
    chart: {
      type: "bar",
      height: 400,
      toolbar: { show: false }
    },
    colors: ["#31C48D", "#3B82F6", "#F59E0B"], // warna: hijau, biru, kuning
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
        borderRadius: 6,
      },
    },
    dataLabels: {
      enabled: true,
      formatter: function (val) {
        return val + "%";
      },
      style: {
        colors: ["#111"]
      }
    },
    xaxis: {
      categories: ["SD", "SMP", "SMA"],
      labels: {
        style: {
          fontFamily: "Inter, sans-serif",
          fontSize: "13px"
        }
      }
    },
    yaxis: {
      max: 100,
      labels: {
        formatter: function (val) {
          return val + "%";
        }
      }
    },
    legend: { show: false },
    grid: { borderColor: "#e5e7eb", strokeDashArray: 4 },
    tooltip: {
      y: {
        formatter: function (val) {
          return val + " Penduduk";
        }
      }
    }
  };

  if(document.getElementById("pendidikan-chart")) {
    const chart = new ApexCharts(document.getElementById("pendidikan-chart"), options);
    chart.render();
  }

  // Toggle Filter
  function toggleFilter() {
    const filter = document.getElementById('filterContent');
    filter.classList.toggle('active');
  }

  // Pencarian Dusun
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
