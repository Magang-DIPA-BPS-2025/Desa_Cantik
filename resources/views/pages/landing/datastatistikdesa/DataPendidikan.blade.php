@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pendidikan</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
  .pendidikan-container {
    max-width: 1400px;
    margin: auto;
    padding: 20px;
  }

  .card {
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    transition: transform .25s, box-shadow .25s;
  }

  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
  }

  .table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 18px;
    font-size: 15px;
  }

  .table th, .table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e5e7eb;
  }

  .table thead {
    background: linear-gradient(90deg, #2563eb, #16a34a);
    color: #fff;
  }

  .filter-toggle {
    display: block;
    background: #2563eb;
    color: #fff;
    text-align: center;
    padding: 12px;
    cursor: pointer;
    border-radius: 10px;
    margin-bottom: 14px;
    font-weight: 600;
  }

  .filter-content {
    display: none;
    max-height: 450px;
    overflow-y: auto;
  }

  .filter-content.active {
    display: block;
  }

  .search-box {
    width: 100%;
    padding: 8px 12px;
    margin-bottom: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
  }

  .dusun-card {
    background: #f0fdf4;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 12px;
    border: 1px solid #bbf7d0;
    transition: 0.3s;
  }

  .dusun-card:hover {
    background: #dcfce7;
    transform: translateY(-2px);
  }
</style>

<div class="pendidikan-container">
  <div class="row g-4">
    <!-- Chart & Tabel -->
    <div class="col-lg-9">
      <div class="card mb-4">
        <h6>Statistik Pendidikan Penduduk</h6>
        <div id="pendidikan-chart-Agama" style="min-height: 400px;"></div>
      </div>

      <div class="card">
        <h6>Tabel Data Pendidikan</h6>
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Pendidikan</th>
              <th>Jumlah</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>SD</td><td>55</td><td>55%</td></tr>
            <tr><td>2</td><td>SMP</td><td>25</td><td>25%</td></tr>
            <tr><td>3</td><td>SMA</td><td>20</td><td>20%</td></tr>
            <tr class="fw-bold table-light">
              <td colspan="2">Total</td><td>100</td><td>100%</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Filter Dusun -->
    <div class="col-lg-3">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilterAgama()">☰ Filter Dusun</div>
        <div class="filter-content" id="filterContentAgama">
          <input type="search" placeholder="Cari Dusun..." class="search-box" id="searchBoxAgama" />
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
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script Chart dan Filter -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi Chart
    const options = {
      series: [{
        name: "Jumlah",
        data: [55, 25, 20]
      }],
      chart: {
        type: "bar",
        height: 400,
        toolbar: { show: false }
      },
      colors: ["#16a34a", "#2563eb", "#f59e0b"],
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "55%",
          borderRadius: 8
        }
      },
      dataLabels: {
        enabled: true,
        formatter: val => val + "%",
        style: {
          colors: ["#111"]
        }
      },
      xaxis: {
        categories: ["SD", "SMP", "SMA"]
      },
      yaxis: {
        max: 100,
        labels: {
          formatter: val => val + "%"
        }
      },
      legend: { show: false },
      grid: {
        borderColor: "#e2e8f0",
        strokeDashArray: 4
      },
      tooltip: {
        y: {
          formatter: val => val + " Penduduk"
        }
      }
    };

    const chartEl = document.querySelector("#pendidikan-chart-Agama");
    if (chartEl) {
      const chart = new ApexCharts(chartEl, options);
      chart.render();
    }

    // Filter Toggle
    document.querySelector('.filter-toggle').addEventListener('click', function () {
      document.getElementById('filterContentAgama').classList.toggle('active');
    });

    // Pencarian Dusun
    document.getElementById('searchBoxAgama').addEventListener('input', function () {
      const q = this.value.toLowerCase();
      document.querySelectorAll('.dusun-card').forEach(function (card) {
        card.style.display = card.innerText.toLowerCase().includes(q) ? 'block' : 'none';
      });
    });
  });
</script>
@endsection
