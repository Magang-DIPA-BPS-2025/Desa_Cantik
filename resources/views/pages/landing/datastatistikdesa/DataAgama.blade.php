@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Agama</title>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    margin: 0;
    background-color: #f5f7fa;
    color: #333;
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 15px;
  }

  .row {
    align-items: stretch;
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

  /* Inherit global footer from layouts.landing.footer */
</style>

<div class="container py-4">
  <div class="row g-3">
    <!-- Main Content -->
    <div class="col-md-9 d-flex flex-column gap-3">
      <!-- Chart Card -->
      <div class="card">
        <h6>Statistik Agama Penduduk</h6>
        <div id="pie-chart-Agama"></div>
      </div>

      <!-- Table Card -->
      <div class="card">
        <h6>Tabel Data Agama</h6>
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
            @php $total = $agamaStats->sum('jumlah'); @endphp
            @foreach($agamaStats as $index => $item)
              @php $persentase = $total > 0 ? round(($item->jumlah / $total) * 100, 1) : 0; @endphp
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->agama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $persentase }}%</td>
              </tr>
            @endforeach
            <tr class="fw-bold">
              <td colspan="2">Total</td>
              <td>{{ $total }}</td>
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
          <div class="filter-toggle" onclick="toggleFilterAgama()">☰ Filter Dusun</div>
          <div class="filter-content" id="filterContentAgama">
            <form method="GET" action="{{ route('agama') }}">
              <div class="mb-3">
                <label for="dusun" class="form-label">Pilih Dusun:</label>
                <select name="dusun" id="dusun" class="form-select" onchange="this.form.submit()">
                  <option value="">Semua Dusun</option>
                  @foreach($dusunList as $dusun)
                    <option value="{{ $dusun->dusun }}" {{ request('dusun') == $dusun->dusun ? 'selected' : '' }}>
                      {{ ucfirst($dusun->dusun) }}
                    </option>
                  @endforeach
                </select>
              </div>
              @if(request('dusun'))
                <a href="{{ route('agama') }}" class="btn btn-sm btn-outline-secondary">Reset Filter</a>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Data dari database
  const agamaData = @json($agamaStats);
  const agamaLabels = agamaData.map(item => item.agama);
  const agamaValues = agamaData.map(item => item.jumlah);

  const getChartOptions = () => {
    return {
      series: agamaValues,
      colors: ["#C0D09D", "#A4BC92", "#95A78D", "#BCC5A8", "#8C9C74", "#708B75", "#5A6B5D", "#4A5D4A"],
      chart: { height: 420, width: "100%", type: "pie" },
      stroke: { colors: ["white"] },
      labels: agamaLabels,
      dataLabels: {
        enabled: true,
        style: { fontFamily: "Arial, sans-serif", fontSize: "13px" },
        formatter: function (val) { return val.toFixed(1) + '%'; }
      },
      legend: { position: "bottom", fontFamily: "Arial, sans-serif", fontSize: "13px" },
    }
  }

  if (document.getElementById("pie-chart-Agama") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart-Agama"), getChartOptions());
    chart.render();
  }

  function toggleFilterAgama() {
    document.getElementById('filterContentAgama').classList.toggle('active');
  }

</script>
@endsection
