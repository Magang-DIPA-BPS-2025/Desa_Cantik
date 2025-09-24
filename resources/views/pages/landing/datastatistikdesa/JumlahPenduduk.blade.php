@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Statistik Penduduk</title>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #cfe2b8;
  }
  .data-table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    margin-top: 20px;
  }
  .data-table th, .data-table td {
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
    <!-- Chart Card -->
    <div class="col-md-9 d-flex flex-column main-content">
      <div class="card shadow-sm">
        <div class="card-body">
          <h6 class="card-title">Statistik Penduduk</h6>
          <div id="chart-penduduk"></div>
        </div>
      </div>

      <!-- Tabel -->
      <div class="card shadow-sm flex-fill">
        <div class="card-body">
          <h6 class="card-title">Tabel Data Penduduk</h6>
          <table class="data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Presentase</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Kepala Keluarga</td>
                <td>{{ $kepalaKeluarga }}</td>
                <td id="persen-kk">0%</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Laki-laki</td>
                <td>{{ $laki }}</td>
                <td id="persen-laki">0%</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Perempuan</td>
                <td>{{ $perempuan }}</td>
                <td id="persen-perempuan">0%</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Disabilitas</td>
                <td>{{ $disabilitas }}</td>
                <td id="persen-disabilitas">0%</td>
              </tr>
              <tr>
                <td>5</td>
                <td>Total Penduduk</td>
                <td>{{ $totalPenduduk }}</td>
                <td>100%</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Sidebar Filter (tetap seperti sebelumnya) -->
    <div class="col-md-3 d-flex">
      <div class="card flex-fill shadow-sm">
        <div class="card-body">
          <div class="filter-toggle" onclick="toggleFilter()">☰ Filter Dusun</div>
          <div class="filter-content" id="filterContent">
            <input type="search" placeholder="Cari Dusun..." class="search-box" id="searchBox" />

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
            <!-- Tambah lagi jika perlu -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Data dari controller
    var total = {{ $totalPenduduk }};
    var data = [
      {{ $kepalaKeluarga }},
      {{ $laki }},
      {{ $perempuan }},
      {{ $disabilitas }}
    ];
    var labels = ["Kepala Keluarga", "Laki-laki", "Perempuan", "Disabilitas"];

    // Hitung total data untuk chart (jumlah semua kategori)
    var totalChart = data.reduce((a, b) => a + b, 0);

    // Hitung persentase seperti yang dilakukan ApexCharts
    var percentages = data.map(value => totalChart > 0 ? (value / totalChart * 100) : 0);

    // Update persentase di tabel
    document.getElementById('persen-kk').textContent = percentages[0].toFixed(1) + '%';
    document.getElementById('persen-laki').textContent = percentages[1].toFixed(1) + '%';
    document.getElementById('persen-perempuan').textContent = percentages[2].toFixed(1) + '%';
    document.getElementById('persen-disabilitas').textContent = percentages[3].toFixed(1) + '%';

    var options = {
      series: data,
      chart: {
        type: 'pie',
        height: 400
      },
      labels: labels,
      colors: ['#C0D09D', '#A4BC92', '#95A78D', '#BCC5A8'],
      legend: {
        position: 'bottom'
      },
      dataLabels: {
        formatter: function(val, opts) {
          return val.toFixed(1) + "%";
        }
      },
      tooltip: {
        y: {
          formatter: function(value, { seriesIndex }) {
            // Tampilkan jumlah dan persentase yang sama dengan chart
            return data[seriesIndex] + ' orang (' + percentages[seriesIndex].toFixed(1) + '%)';
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart-penduduk"), options);
    chart.render();
  });

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
