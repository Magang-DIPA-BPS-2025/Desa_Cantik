@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pendidikan</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

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
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    transition: transform .25s, box-shadow .25s;
  }

  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
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
    background: linear-gradient(90deg, #16a34a, #16a34a);
    color: #fff;
  }

  .chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 15px;
  }

  .btn-download {
    background-color: #16a34a;
    color: #fff;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
  }

  .filter-toggle {
    display: block;
    background: #16a34a;
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

  /* 🌿 Tata letak normal (desktop) */
  .row.g-4 {
    display: flex;
    flex-wrap: wrap;
  }

  .col-lg-9 {
    order: 1;
    flex: 1;
  }

  .col-lg-3 {
    order: 2;
    width: 320px;
  }

  /* 🌿 Responsive - pindahkan filter ke atas di mobile */
  @media (max-width: 992px) {
    .row.g-4 {
      flex-direction: column;
    }

    .col-lg-3 {
      order: -1; /* Pindahkan ke atas */
      width: 100%;
      margin-bottom: 15px;
    }

    .col-lg-9 {
      order: 1;
    }
  }
</style>

<div class="pendidikan-container">
  <div class="row g-4">
    <!-- Konten Utama -->
    <div class="col-lg-9">
      <!-- CARD CHART -->
      <div class="card">
        <div class="chart-header">
          <h6 style="margin:0;">Statistik Pendidikan Penduduk</h6>

          <!-- Form filter tahun + tombol download -->
          <form method="GET" action="{{ route('pendidikan') }}" id="filterForm" style="display:flex; align-items:center; gap:10px;">
            <select name="tahun" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
              <option value="">Semua Tahun</option>
              @foreach(range(date('Y'), date('Y') - 5) as $tahun)
                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
              @endforeach
            </select>

            <!-- Agar dusun tetap terbawa -->
            @if(request('dusun'))
              <input type="hidden" name="dusun" value="{{ request('dusun') }}">
            @endif

            <button type="button" class="btn-download" onclick="downloadChart()">Download Grafik</button>
          </form>
        </div>

        <!-- Label filter aktif -->
        @if(request('tahun') || request('dusun'))
          <p style="font-size:14px; margin-bottom:10px;">
            Menampilkan data
            @if(request('tahun')) tahun <strong>{{ request('tahun') }}</strong>@endif
            @if(request('dusun')) dusun <strong>{{ ucfirst(request('dusun')) }}</strong>@endif
          </p>
        @endif

        <div id="pendidikan-chart" style="min-height: 400px;"></div>
      </div>

      <!-- CARD TABLE -->
      <div class="card mt-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h6>Tabel Data Pendidikan</h6>
          <button class="btn-download" onclick="downloadExcel()">Download Excel</button>
        </div>

        <table id="tabelPendidikan" class="table table-bordered text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Pendidikan</th>
              <th>Jumlah</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            @php $total = $pendidikanStats->sum('jumlah'); @endphp
            @foreach($pendidikanStats as $index => $item)
              @php $persentase = $total > 0 ? round(($item->jumlah / $total) * 100, 1) : 0; @endphp
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pendidikan }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $persentase }}%</td>
              </tr>
            @endforeach
            <tr class="fw-bold table-light">
              <td colspan="2">Total</td>
              <td>{{ $total }}</td>
              <td>100%</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Sidebar Filter Dusun (dikanan desktop, di atas mobile) -->
    <div class="col-lg-3">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilterPendidikan()">☰ Filter Dusun</div>
        <div class="filter-content" id="filterContentPendidikan">
          <form method="GET" action="{{ route('pendidikan') }}">
            <!-- Agar tahun tetap terbawa -->
            @if(request('tahun'))
              <input type="hidden" name="tahun" value="{{ request('tahun') }}">
            @endif

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
              <a href="{{ route('pendidikan') }}" class="btn btn-sm btn-outline-secondary">Reset Filter</a>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const pendidikanData = @json($pendidikanStats);
  const labels = pendidikanData.map(item => item.pendidikan);
  const values = pendidikanData.map(item => item.jumlah);
  const total = values.reduce((sum, val) => sum + val, 0);

  const colors = ["#166534", "#15803d", "#16a34a", "#22c55e", "#4ade80", "#86efac"];

  const options = {
    series: [{ name: "Jumlah", data: values }],
    chart: { type: "bar", height: 400, toolbar: { show: false } },
    plotOptions: { bar: { horizontal: false, columnWidth: "55%", borderRadius: 8, distributed: true } },
    dataLabels: { enabled: true, formatter: val => val + "", style: { colors: ["#111"] } },
    xaxis: { categories: labels },
    yaxis: { labels: { formatter: val => val + "" } },
    colors: colors,
    grid: { borderColor: "#e2e8f0", strokeDashArray: 4 },
    tooltip: { y: { formatter: val => val + " Penduduk" } }
  };

  let chart;
  if (document.getElementById("pendidikan-chart") && typeof ApexCharts !== 'undefined') {
    chart = new ApexCharts(document.getElementById("pendidikan-chart"), options);
    chart.render();
  }

  function downloadChart() {
    if (typeof chart !== 'undefined') {
      chart.dataURI().then(({ imgURI }) => {
        const a = document.createElement("a");
        a.href = imgURI;
        a.download = "Statistik_Pendidikan.png";
        a.click();
      });
    }
  }

  function downloadExcel() {
    const table = document.getElementById("tabelPendidikan");
    const wb = XLSX.utils.table_to_book(table, { sheet: "Data Pendidikan" });
    XLSX.writeFile(wb, "Data_Pendidikan.xlsx");
  }

  function toggleFilterPendidikan() {
    document.getElementById('filterContentPendidikan').classList.toggle('active');
  }
</script>
@endsection
