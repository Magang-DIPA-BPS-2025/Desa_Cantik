@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pekerjaan</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<style>
  .container-main {
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
    gap: 10px;
    margin-bottom: 15px;
    flex-wrap: wrap;
  }

  /* --- Tombol dan filter --- */
  .filter-toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #16a34a;
    color: #fff;
    padding: 12px;
    cursor: pointer;
    border-radius: 10px;
    margin-bottom: 14px;
    font-weight: 600;
    transition: background 0.3s;
  }
  .filter-toggle:hover {
    background: #15803d;
  }
  .filter-toggle i {
    margin-right: 8px;
    font-size: 18px;
  }
  .filter-content {
    display: none;
    max-height: 450px;
    overflow-y: auto;
  }
  .filter-content.active {
    display: block;
  }

  /* --- Layout utama --- */
  .layout-wrapper {
    display: flex;
    gap: 20px;
  }
  .layout-sidebar {
    order: 2;
    flex: 0 0 25%;
  }
  .layout-main {
    order: 1;
    flex: 1;
  }
  @media (max-width: 992px) {
    .layout-wrapper {
      flex-direction: column;
    }
    .layout-sidebar {
      order: 1;
      width: 100%;
    }
    .layout-main {
      order: 2;
      width: 100%;
    }
  }
</style>

<div class="container-main">
  <div class="layout-wrapper">
    <!-- Sidebar Filter Dusun -->
    <div class="layout-sidebar">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilterPekerjaan()">
          <i class="bi bi-funnel"></i> Filter Dusun
        </div>
        <div class="filter-content" id="filterContentPekerjaan">
          <form method="GET" action="{{ route('pekerjaan') }}">
            <div class="mb-3">
              <label for="dusun" class="form-label">Pilih Dusun:</label>
              <select name="dusun" id="dusun" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Dusun</option>
                @foreach($dusunList as $dusun)
                  <option value="{{ $dusun->dusun }}" {{ request('dusun')==$dusun->dusun?'selected':'' }}>
                    {{ ucfirst($dusun->dusun) }}
                  </option>
                @endforeach
              </select>
            </div>
            @if(request('dusun'))
              <a href="{{ route('pekerjaan') }}" class="btn btn-sm btn-outline-secondary">Reset Filter</a>
            @endif
          </form>
        </div>
      </div>
    </div>

    <!-- Main Chart & Table -->
    <div class="layout-main d-flex flex-column gap-4">
      <!-- CARD CHART -->
      <div class="card">
        <div class="chart-header">
          <h6>Statistik Pekerjaan Penduduk</h6>
          <div style="display:flex; align-items:center; gap:10px;">
            <form method="GET" action="{{ route('pekerjaan') }}">
              <select name="tahun" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">Semua Tahun</option>
                @foreach(range(date('Y'), date('Y')-5) as $tahun)
                  <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
              </select>
            </form>
            <button class="btn btn-sm btn-success" onclick="downloadChart()">
              <i class="bi bi-download"></i> Download Grafik
            </button>
          </div>
        </div>
        <div id="pie-chart-Pekerjaan" style="min-height: 400px;"></div>
      </div>

      <!-- CARD TABLE -->
      <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h6>Tabel Data Pekerjaan</h6>
          <button class="btn btn-sm" style="background-color:#16a34a; color:#fff;" onclick="downloadExcel()">
            <i class="bi bi-download"></i> Download Excel
          </button>
        </div>
        <table id="tabelPekerjaan" class="table table-bordered text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Pekerjaan</th>
              <th>Jumlah</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            @php $total = $pekerjaanStats->sum('jumlah'); @endphp
            @foreach($pekerjaanStats as $index => $item)
              @php $persentase = $total > 0 ? round(($item->jumlah/$total)*100,1) : 0; @endphp
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->pekerjaan }}</td>
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
  </div>
</div>

<script>
  const pekerjaanData = @json($pekerjaanStats);
  const total = pekerjaanData.reduce((sum, item) => sum + item.jumlah, 0);

  const chartOptions = {
    series: pekerjaanData.map(item => item.jumlah),
    colors: ["#22c55e", "#60a5fa", "#f97316", "#a78bfa", "#ef4444", "#14b8a6", "#eab308", "#84cc16"],
    chart: { height: 420, type: "donut" },
    labels: pekerjaanData.map(item => item.pekerjaan),
    stroke: { colors: ["#fff"] },
    dataLabels: { enabled:true, formatter: val => val.toFixed(1)+"%", style:{fontSize:"13px"} },
    legend: { position:"bottom", fontSize:"14px" },
    plotOptions: {
      pie: {
        donut: {
          size: "65%",
          labels: { show:true, total:{ show:true, label:"Total", formatter:()=>total } }
        }
      }
    }
  };

  let chart;
  if(document.getElementById("pie-chart-Pekerjaan") && typeof ApexCharts !== 'undefined'){
    chart = new ApexCharts(document.getElementById("pie-chart-Pekerjaan"), chartOptions);
    chart.render();
  }

  function toggleFilterPekerjaan(){ document.getElementById('filterContentPekerjaan').classList.toggle('active'); }

  function downloadChart(){
    if(typeof chart!=='undefined'){
      chart.dataURI().then(({imgURI})=>{
        const a=document.createElement("a");
        a.href=imgURI;
        a.download="Statistik_Pekerjaan.png";
        a.click();
      });
    }
  }

  function downloadExcel(){
    const table=document.getElementById("tabelPekerjaan");
    const wb=XLSX.utils.table_to_book(table,{sheet:"Data Pekerjaan"});
    XLSX.writeFile(wb,"Data_Pekerjaan.xlsx");
  }
</script>
@endsection
