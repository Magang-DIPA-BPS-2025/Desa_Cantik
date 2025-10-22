@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Jumlah Penduduk</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
  body {
    font-family: 'Open Sans', sans-serif;
    color: #000;
    background: #fff;
  }

  h6, h5, h4, h3 {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    color: #000;
  }

  /* === Layout Utama === */
  .container-main {
    max-width: 1400px;
    margin: auto;
    padding: 20px;
  }

  .layout-wrapper {
    display: flex;
    gap: 20px;
  }

  .layout-sidebar {
    order: 2;
    flex: 0 0 20%;
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

  /* === Kartu === */
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

  /* === Filter === */
  .filter-toggle {
    background: #16a34a;
    color: #fff;
    padding: 14px 18px;
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 600;
  }
  .filter-toggle i { transition: transform 0.3s; }
  .filter-toggle.active i { transform: rotate(180deg); }

  .filter-content {
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transition: all 0.4s;
    background: #f9fafb;
    border-radius: 0 0 12px 12px;
  }
  .filter-content.active {
    max-height: 600px;
    opacity: 1;
    padding: 16px;
  }

  .form-select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
  }

  .btn-reset {
    display: inline-block;
    margin-top: 10px;
    color: #000;
    border: 1px solid #000;
    border-radius: 8px;
    padding: 6px 12px;
    background: #fff;
  }
  .btn-reset:hover {
    background: #000;
    color: #fff;
  }

  /* === Tombol Download === */
  .btn-download {
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
  }
  .btn-download:hover {
    background: #15803d;
  }

  /* === Dropdown Download === */
  .dropdown {
    position: relative;
    display: inline-block;
  }
  .dropdown-content {
    position: absolute;
    right: 0;
    top: 110%;
    display: none;
    background: #fff;
    min-width: 150px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    z-index: 99;
  }
  .dropdown-content a {
    color: #000;
    padding: 10px 14px;
    text-decoration: none;
    display: block;
    font-size: 14px;
    border-bottom: 1px solid #eee;
  }
  .dropdown-content a:hover {
    background: #f4f4f4;
  }
  .dropdown.show .dropdown-content {
    display: block;
  }

  /* === Tabel === */
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
</style>

<div class="container-main">
  <div class="layout-wrapper">

    <!-- === SIDEBAR FILTER === -->
    <div class="layout-sidebar">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilterPenduduk(this)">
          <span><i class="bi bi-funnel-fill me-2"></i> Filter Data</span>
          <i class="bi bi-chevron-down"></i>
        </div>

        <div class="filter-content" id="filterContentPenduduk">
          <form method="GET" action="{{ route('statistik.penduduk') }}">
            <div class="mb-3">
              <label class="form-label fw-semibold">Pilih Dusun:</label>
              <select name="dusun" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Dusun</option>
                @foreach($dusunList as $dusun)
                  <option value="{{ $dusun->dusun }}" {{ request('dusun') == $dusun->dusun ? 'selected' : '' }}>
                    {{ ucfirst($dusun->dusun) }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Pilih Tahun:</label>
              <select name="tahun" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Tahun</option>
                @foreach(range(date('Y'), date('Y')-5) as $tahun)
                  <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                    {{ $tahun }}
                  </option>
                @endforeach
              </select>
            </div>
            @if(request('dusun') || request('tahun'))
              <a href="{{ route('statistik.penduduk') }}" class="btn-reset"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset</a>
            @endif
          </form>
        </div>
      </div>
    </div>

    <!-- === MAIN CONTENT === -->
    <div class="layout-main d-flex flex-column gap-4">

      <!-- === CHART === -->
      <div class="card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
          <h6>
            Statistik Jumlah Penduduk 
            @if(request('dusun')) (Dusun {{ ucfirst(request('dusun')) }}) @else (Seluruh Dusun) @endif
            @if(request('tahun')) - Tahun {{ request('tahun') }} @endif
          </h6>
          <button class="btn-download" onclick="downloadChart()">
            <i class="bi bi-download"></i> Download Grafik
          </button>
        </div>
        <div id="pie-chart-Penduduk" style="min-height: 420px;"></div>
      </div>

      <!-- === TABEL === -->
      <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h6>Tabel Data Penduduk</h6>
          <div class="dropdown">
            <button class="btn-download" onclick="toggleDropdown(event, this)">
              <i class="bi bi-download"></i> Download
            </button>
            <div class="dropdown-content">
              <a href="#" onclick="downloadExcel()">Excel</a>
              <a href="#" onclick="downloadCSV()">CSV</a>
              <a href="#" onclick="downloadPDF()">PDF</a>
            </div>
          </div>
        </div>

        <table id="tabelPenduduk" class="table table-bordered text-center">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            @php $totalPenduduk = $laki + $perempuan; @endphp
            <tr><td>1</td><td>Kepala Keluarga</td><td>{{ $kepalaKeluarga }}</td><td>{{ $totalPenduduk ? round(($kepalaKeluarga/$totalPenduduk)*100,1) : 0 }}%</td></tr>
            <tr><td>2</td><td>Laki-laki</td><td>{{ $laki }}</td><td>{{ $totalPenduduk ? round(($laki/$totalPenduduk)*100,1) : 0 }}%</td></tr>
            <tr><td>3</td><td>Perempuan</td><td>{{ $perempuan }}</td><td>{{ $totalPenduduk ? round(($perempuan/$totalPenduduk)*100,1) : 0 }}%</td></tr>
            <tr><td>4</td><td>Disabilitas</td><td>{{ $disabilitas }}</td><td>{{ $totalPenduduk ? round(($disabilitas/$totalPenduduk)*100,1) : 0 }}%</td></tr>
            <tr class="fw-bold table-light"><td colspan="2">Jumlah Penduduk</td><td>{{ $totalPenduduk }}</td><td>100%</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  // === Toggle Filter ===
  function toggleFilterPenduduk(el) {
    const filter = el.nextElementSibling;
    el.classList.toggle('active');
    filter.classList.toggle('active');
  }

  // === Toggle Dropdown Download ===
  function toggleDropdown(event, btn) {
    event.stopPropagation();
    const dropdown = btn.parentElement;
    dropdown.classList.toggle("show");
    document.addEventListener("click", () => dropdown.classList.remove("show"), { once: true });
  }

  // === Chart ===
  document.addEventListener("DOMContentLoaded", function () {
    const totalPenduduk = {{ $laki + $perempuan }};
    const chart = new ApexCharts(document.querySelector("#pie-chart-Penduduk"), {
      series: [{{ $kepalaKeluarga }}, {{ $laki }}, {{ $perempuan }}, {{ $disabilitas }}],
      colors: ["#22c55e", "#3b82f6", "#f97316", "#8b5cf6"],
      chart: { height: 420, type: "donut" },
      labels: ["Kepala Keluarga", "Laki-laki", "Perempuan", "Disabilitas"],
      dataLabels: { enabled: true, style: { fontSize: '13px' } },
      legend: { position: "bottom", fontSize: "14px" },
      plotOptions: {
        pie: {
          donut: {
            size: "65%",
            labels: {
              show: true,
              total: {
                show: true,
                label: "Total",
                color: "#000",
                formatter: () => totalPenduduk
              }
            }
          }
        }
      }
    });
    chart.render();

    window.downloadChart = function(){
      chart.dataURI().then(({ imgURI }) => {
        const a = document.createElement("a");
        a.href = imgURI;
        a.download = "Statistik_Penduduk.png";
        a.click();
      });
    };
  });

  // === Download Table ===
  function downloadExcel(){
    const wb = XLSX.utils.table_to_book(document.getElementById("tabelPenduduk"));
    XLSX.writeFile(wb, "Data_Penduduk.xlsx");
  }
  function downloadCSV(){
    const wb = XLSX.utils.table_to_book(document.getElementById("tabelPenduduk"));
    XLSX.writeFile(wb, "Data_Penduduk.csv");
  }
  function downloadPDF(){
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text("Data Penduduk", 10, 10);
    doc.autoTable({ html: '#tabelPenduduk' });
    doc.save("Data_Penduduk.pdf");
  }
</script>
@endsection
