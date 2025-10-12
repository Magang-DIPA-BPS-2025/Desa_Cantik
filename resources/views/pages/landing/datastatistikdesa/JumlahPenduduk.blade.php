@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Jumlah Penduduk</title>

<!-- CDN Libraries -->
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
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 15px;
  }

  .btn-download {
    margin-left: 5px;
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

  /* Atur tata letak dua kolom */
  .row-layout {
    display: flex;
    gap: 20px;
  }

  .col-left {
    flex: 1;
  }

  .col-right {
    width: 320px;
  }

  /* Saat mobile, ubah posisi filter jadi di atas */
  @media (max-width: 992px) {
    .row-layout {
      flex-direction: column;
    }
    .col-right {
      order: -1;
      width: 100%;
    }
  }
</style>

<div class="container-main">
  <div class="row-layout">

    <!-- Kolom kiri: Chart & Tabel -->
    <div class="col-left d-flex flex-column gap-4">

      <!-- CARD CHART -->
      <div class="card">
        <div class="chart-header">
          <h6 style="margin:0;">Statistik Jumlah Penduduk</h6>

          <!-- Filter Tahun + Download -->
          <div style="display:flex; align-items:center; gap:10px;">
            <form method="GET" id="filterTahunForm" action="{{ route('statistik.penduduk') }}">
              <select name="tahun" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">Semua Tahun</option>
                @foreach(range(date('Y'), date('Y') - 5) as $tahun)
                  <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
              </select>
            </form>
            <button class="btn btn-sm btn-success btn-download" onclick="downloadChart()">Download Grafik</button>
          </div>
        </div>

        <div id="pie-chart" style="min-height: 400px;"></div>
      </div>

      <!-- CARD TABLE -->
      <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h6>Tabel Data Penduduk</h6>
          <button class="btn btn-sm" style="background-color:#16a34a; color:#fff;" onclick="downloadExcel()">
            Download Excel
          </button>
        </div>

        @php
          $totalPenduduk = $laki + $perempuan;
        @endphp

        <table id="tabelPenduduk" class="table table-bordered text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kepala Keluarga</td>
              <td>{{ $kepalaKeluarga }}</td>
              <td>{{ $totalPenduduk ? round(($kepalaKeluarga/$totalPenduduk)*100,1) : 0 }}%</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Laki-laki</td>
              <td>{{ $laki }}</td>
              <td>{{ $totalPenduduk ? round(($laki/$totalPenduduk)*100,1) : 0 }}%</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Perempuan</td>
              <td>{{ $perempuan }}</td>
              <td>{{ $totalPenduduk ? round(($perempuan/$totalPenduduk)*100,1) : 0 }}%</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Disabilitas</td>
              <td>{{ $disabilitas }}</td>
              <td>{{ $totalPenduduk ? round(($disabilitas/$totalPenduduk)*100,1) : 0 }}%</td>
            </tr>
            <tr class="fw-bold table-light">
              <td colspan="2">Jumlah Penduduk</td>
              <td>{{ $totalPenduduk }}</td>
              <td>100%</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Kolom kanan: Filter Dusun -->
    <div class="col-right">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilterPenduduk()">☰ Filter Dusun</div>
        <div class="filter-content" id="filterContentPenduduk">
          <form method="GET" action="{{ route('statistik.penduduk') }}">
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
              <a href="{{ route('statistik.penduduk') }}" class="btn btn-sm btn-outline-secondary">Reset Filter</a>
            @endif
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  const totalPenduduk = {{ $laki + $perempuan  }};
  const data = {
    kepala: {{ $kepalaKeluarga }},
    laki: {{ $laki }},
    perempuan: {{ $perempuan }},
    disabilitas: {{ $disabilitas }}
  };

  // Chart
  let chart;
  const options = {
    series: [data.kepala, data.laki, data.perempuan, data.disabilitas],
    colors: ["#a78bfa", "#22c55e", "#60a5fa", "#f97316"],
    chart: { height: 420, type: "donut", id: 'chartPenduduk' },
    labels: ["Kepala Keluarga", "Laki-laki", "Perempuan", "Disabilitas"],
    stroke: { colors: ["#ffffff"] },
    dataLabels: {
      enabled: true,
      formatter: (val) => val.toFixed(1) + "%",
      style: { fontSize: "13px" }
    },
    legend: { position: "bottom", fontSize: "14px" },
    plotOptions: {
      pie: {
        donut: {
          size: "65%",
          labels: {
            show: true,
            total: { show: true, label: "Total", formatter: () => totalPenduduk }
          }
        }
      }
    }
  };

  if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    chart = new ApexCharts(document.getElementById("pie-chart"), options);
    chart.render();
  }

  function downloadChart() {
    if (typeof chart !== 'undefined') {
      chart.dataURI().then(({ imgURI }) => {
        const a = document.createElement("a");
        a.href = imgURI;
        a.download = "Statistik_Penduduk.png";
        a.click();
      });
    }
  }

  function downloadExcel() {
    const table = document.getElementById("tabelPenduduk");
    const wb = XLSX.utils.table_to_book(table, { sheet: "Data Penduduk" });
    XLSX.writeFile(wb, "Data_Penduduk.xlsx");
  }

  function toggleFilterPenduduk() {
    document.getElementById('filterContentPenduduk').classList.toggle('active');
  }
</script>
@endsection
