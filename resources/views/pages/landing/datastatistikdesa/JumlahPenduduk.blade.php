@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Jumlah Penduduk</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<style>
  .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 15px;
  }

  .card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card h6 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 15px;
    border-left: 5px solid #3B82F6;
    padding-left: 10px;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    border-radius: 12px;
    overflow: hidden;
  }

  .data-table th, .data-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
  }

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
        <h6>Statistik Jumlah Penduduk</h6>
        <div id="pie-chart"></div>
      </div>

      <!-- Table Card -->
      <div class="card">
        <h6>Tabel Data Penduduk</h6>
        <table class="data-table mt-2">
          <thead>
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Presentase</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Kepala Keluarga</td><td>{{ $kepalaKeluarga }}</td><td id="persen-kepala"></td></tr>
            <tr><td>2</td><td>Laki-laki</td><td>{{ $laki }}</td><td id="persen-laki"></td></tr>
            <tr><td>3</td><td>Perempuan</td><td>{{ $perempuan }}</td><td id="persen-perempuan"></td></tr>
            <tr><td>4</td><td>Disabilitas</td><td>{{ $disabilitas }}</td><td id="persen-disabilitas"></td></tr>
            <tr class="fw-bold"><td colspan="2">Jumlah Penduduk</td><td>{{ $totalPenduduk }}</td><td>100%</td></tr>
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
            <div class="dusun-card"><h4>Dusun A</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
            <div class="dusun-card"><h4>Dusun B</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
            <div class="dusun-card"><h4>Dusun C</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
            <div class="dusun-card"><h4>Dusun D</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
            <div class="dusun-card"><h4>Dusun E</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const totalPenduduk = {{ $totalPenduduk }};
  const data = {
    kepala: {{ $kepalaKeluarga }},
    laki: {{ $laki }},
    perempuan: {{ $perempuan }},
    disabilitas: {{ $disabilitas }}
  };

  const getChartOptions = () => {
    return {
      series: [data.laki, data.perempuan, data.disabilitas, data.kepala],
      colors: ["#C0D09D", "#A4BC92", "#95A78D", "#BCC5A8"],
      chart: { height: 420, width: "100%", type: "pie" },
      stroke: { colors: ["white"] },
      labels: ["Laki-laki", "Perempuan", "Disabilitas", "Kepala Keluarga"],
      dataLabels: {
        enabled: true,
        style: { fontFamily: "Arial, sans-serif", fontSize: "13px" },
        formatter: function (val) { return val.toFixed(1) + '%'; }
      },
      legend: { position: "bottom", fontFamily: "Arial, sans-serif", fontSize: "13px" },
    }
  }

  if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
    chart.render();
  }

  // Hitung persen tabel
  document.getElementById('persen-kepala').innerText = ((data.kepala / totalPenduduk) * 100).toFixed(1) + '%';
  document.getElementById('persen-laki').innerText = ((data.laki / totalPenduduk) * 100).toFixed(1) + '%';
  document.getElementById('persen-perempuan').innerText = ((data.perempuan / totalPenduduk) * 100).toFixed(1) + '%';
  document.getElementById('persen-disabilitas').innerText = ((data.disabilitas / totalPenduduk) * 100).toFixed(1) + '%';

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
