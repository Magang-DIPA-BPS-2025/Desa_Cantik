@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Statistik Penduduk</title>

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
    border-left: 5px solid #3B82F6; /* biru sesuai dataagama */
    padding-left: 10px;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 14px;
    border-radius: 12px;
    overflow: hidden;
  }

  .data-table th, .data-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
  }

  /* Header tabel biru gradient */
  .data-table thead {
    background: linear-gradient(90deg, #3B82F6, #31C48D);
    color: #fff;
  }

  .data-table tbody tr:hover {
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
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 15px;
    transition: background 0.3s;
  }

  .dusun-card:hover {
    background: #d6efd6;
  }

  .dusun-card h4 {
    margin: 0 0 5px 0;
    font-size: 15px;
    font-weight: 600;
    color: #333;
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

  /* Responsive adjustments */
  @media (max-width: 992px) {
    .row {
      flex-direction: column;
    }
  }
</style>

<div class="container py-4">
  <div class="row g-3">
    <!-- Chart + Table -->
    <div class="col-md-9 d-flex flex-column gap-3">
      <div class="card">
        <h6>Statistik Penduduk</h6>
        <div id="chart-penduduk"></div>
      </div>

      <div class="card">
        <h6>Tabel Data Penduduk</h6>
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

    <!-- Sidebar Filter -->
    <div class="col-md-3 d-flex">
      <div class="card flex-fill">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Data chart
  var total = {{ $totalPenduduk }};
  var data = [
    {{ $kepalaKeluarga }},
    {{ $laki }},
    {{ $perempuan }},
    {{ $disabilitas }}
  ];
  var labels = ["Kepala Keluarga", "Laki-laki", "Perempuan", "Disabilitas"];
  var totalChart = data.reduce((a,b)=>a+b,0);
  var percentages = data.map(v => totalChart>0?(v/totalChart*100):0);

  document.getElementById('persen-kk').textContent = percentages[0].toFixed(1)+'%';
  document.getElementById('persen-laki').textContent = percentages[1].toFixed(1)+'%';
  document.getElementById('persen-perempuan').textContent = percentages[2].toFixed(1)+'%';
  document.getElementById('persen-disabilitas').textContent = percentages[3].toFixed(1)+'%';

  var options = {
    series: data,
    chart: { type: 'pie', height: 400 },
    labels: labels,
    colors: ['#C0D09D', '#A4BC92', '#95A78D', '#BCC5A8'],
    legend: { position: 'bottom' },
    dataLabels: { formatter: function(val){ return val.toFixed(1)+'%'; } },
    tooltip: {
      y: { formatter: function(val,i){ return data[i]+' orang ('+percentages[i].toFixed(1)+'%)'; } }
    }
  };
  var chart = new ApexCharts(document.querySelector("#chart-penduduk"), options);
  chart.render();
});

function toggleFilter(){
  document.getElementById('filterContent').classList.toggle('active');
}

document.getElementById('searchBox').addEventListener('keyup', function(){
  let query = this.value.toLowerCase();
  document.querySelectorAll('.dusun-card').forEach(card=>{
    card.style.display = card.innerText.toLowerCase().includes(query)?'block':'none';
  });
});
</script>
@endsection
