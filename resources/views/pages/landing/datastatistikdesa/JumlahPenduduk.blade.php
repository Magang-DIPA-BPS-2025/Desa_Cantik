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
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.16);
  }

  .card h6 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 20px;
    border-left: 5px solid #3B82F6;
    padding-left: 12px;
    color: #333;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }

  .data-table th, .data-table td {
    padding: 12px 10px;
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

  .filter-card {
    background: #f7faff;
    border-radius: 16px;
    padding: 15px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  }

  .filter-card h6 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 12px;
    color: #333;
  }

  .filter-select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: border-color 0.3s;
  }

  .filter-select:focus {
    outline: none;
    border-color: #3B82F6;
    box-shadow: 0 0 5px rgba(59,130,246,0.3);
  }

  .reset-btn {
    display: block;
    margin-top: 10px;
    width: 100%;
  }

  @media (max-width: 992px) {
    .row {
      flex-direction: column;
    }
  }
</style>

<div class="container py-4">
  <div class="row g-4">
    <!-- Main Content -->
    <div class="col-lg-9 d-flex flex-column gap-4">
      <!-- Chart Card -->
      <div class="card">
        <h6>Statistik Jumlah Penduduk</h6>
        <div id="pie-chart"></div>
      </div>

      <!-- Table Card -->
      <div class="card">
        <h6>Tabel Data Penduduk</h6>
        <div class="table-responsive">
          <table class="data-table mt-3">
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
                <td id="persen-kepala"></td>
              </tr>
              <tr>
                <td>2</td>
                <td>Laki-laki</td>
                <td>{{ $laki }}</td>
                <td id="persen-laki"></td>
              </tr>
              <tr>
                <td>3</td>
                <td>Perempuan</td>
                <td>{{ $perempuan }}</td>
                <td id="persen-perempuan"></td>
              </tr>
              <tr>
                <td>4</td>
                <td>Disabilitas</td>
                <td>{{ $disabilitas }}</td>
                <td id="persen-disabilitas"></td>
              </tr>
              <tr class="fw-bold">
                <td colspan="2">Jumlah Penduduk</td>
                <td>{{ $totalPenduduk }}</td>
                <td>100%</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Sidebar Filter -->
<div class="col-lg-3 d-flex">
  <div class="filter-card flex-fill" style="max-height: 460px; overflow-y: auto;">
    <h6>Filter Berdasarkan Dusun</h6>
    <form method="GET" action="{{ route('statistik.penduduk') }}">
      <select name="dusun" class="filter-select" onchange="this.form.submit()">
        <option value="">Semua Dusun</option>
        @foreach($dusunList as $dusun)
          <option value="{{ $dusun->dusun }}" {{ request('dusun') == $dusun->dusun ? 'selected' : '' }}>
            {{ ucfirst($dusun->dusun) }}
          </option>
        @endforeach
      </select>

      @if(request('dusun'))
        <a href="{{ route('statistik.penduduk') }}" class="btn btn-outline-secondary btn-sm reset-btn">Reset Filter</a>
      @endif
    </form>
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

  // ApexCharts Pie
  const getChartOptions = () => ({
    series: [data.laki, data.perempuan, data.disabilitas, data.kepala],
    colors: ["#4F46E5", "#3B82F6", "#10B981", "#F59E0B"],
    chart: { height: 420, type: "pie" },
    labels: ["Laki-laki", "Perempuan", "Disabilitas", "Kepala Keluarga"],
    stroke: { colors: ["white"] },
    dataLabels: {
      enabled: true,
      formatter: function(val) { return val.toFixed(1) + "%"; }
    },
    legend: { position: "bottom", fontSize: "14px" }
  });

  if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
    chart.render();
  }

  // Hitung persentase tabel
  document.getElementById('persen-kepala').innerText = ((data.kepala/totalPenduduk)*100).toFixed(1) + '%';
  document.getElementById('persen-laki').innerText = ((data.laki/totalPenduduk)*100).toFixed(1) + '%';
  document.getElementById('persen-perempuan').innerText = ((data.perempuan/totalPenduduk)*100).toFixed(1) + '%';
  document.getElementById('persen-disabilitas').innerText = ((data.disabilitas/totalPenduduk)*100).toFixed(1) + '%';
</script>
@endsection
