@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pekerjaan</title>

<!-- Library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
/* Terapkan font modern */
body, .container-main, .card, .filter-toggle, .btn-download, .dropdown-content, .table, .layout-sidebar, .layout-main {
    font-family: 'Open Sans', sans-serif;
}

h1, h2, h3, h4, h5, h6, .gallery-title, .filter-toggle, .btn-download, .table th {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

body { 
    color: #000; 
    background: #fff; 
}

.container-main { 
    max-width: 1400px; 
    margin: auto; 
    padding: 20px; 
}

/* Header Section - Sama seperti halaman sejarah */
.gallery-header {
    margin-bottom: 2rem;
    margin-top: -1rem;
}

.gallery-title {
    font-size: 2.8rem;
    font-weight: 600;
    color: #2E7D32;
    line-height: 1.1;
    margin-bottom: 0.5rem;
}

.gallery-header p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 0;
}

.layout-wrapper { 
    display: flex; 
    gap: 20px; 
    margin-top: 2rem;
}

.layout-sidebar { 
    order: 2; 
    flex: 0 0 20%; 
}

.layout-main { 
    order: 1; 
    flex: 1; 
    display: flex; 
    flex-direction: column; 
    gap: 25px; 
}

@media (max-width: 992px) { 
    .layout-wrapper { 
        flex-direction: column; 
    } 
    .layout-sidebar, .layout-main { 
        width: 100%; 
        order: unset; 
    } 
}

.card { 
    background: #fff; 
    border-radius: 14px; 
    padding: 25px; 
    box-shadow: 0 8px 20px rgba(0,0,0,0.06); 
    transition: 0.25s; 
    border: none;
}

.card:hover { 
    transform: translateY(-3px); 
    box-shadow: 0 12px 28px rgba(0,0,0,0.12); 
}

/* Filter */
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
    border: none;
    width: 100%;
}

.filter-toggle i { 
    transition: transform 0.3s; 
}

.filter-toggle.active i { 
    transform: rotate(180deg); 
}

.filter-content { 
    overflow: hidden; 
    max-height: 0; 
    opacity: 0; 
    transition: all 0.4s; 
    background: #f9fafb; 
    border-radius: 0 0 12px 12px; 
    margin-top: 10px; 
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
    font-family: 'Open Sans', sans-serif; 
}

.btn-reset { 
    display: inline-block; 
    margin-top: 10px; 
    color: #000; 
    border: 1px solid #000; 
    border-radius: 8px; 
    padding: 6px 12px; 
    background: #fff; 
    font-family: 'Poppins', sans-serif; 
    text-decoration: none;
    transition: all 0.3s;
}

.btn-reset:hover { 
    background: #000; 
    color: #fff; 
    text-decoration: none;
}

/* Download Button */
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
    font-weight: 500; 
    cursor: pointer; 
    transition: 0.3s; 
    font-family: 'Poppins', sans-serif; 
    text-decoration: none;
}

.btn-download:hover { 
    background: #15803d; 
    color: #fff;
    text-decoration: none;
}

/* Dropdown */
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
    min-width: 170px; 
    border-radius: 10px; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
    z-index: 99; 
    animation: fadeIn 0.25s ease-in-out; 
}

@keyframes fadeIn { 
    from { 
        opacity: 0; 
        transform: translateY(-6px);
    } 
    to { 
        opacity: 1; 
        transform: translateY(0);
    } 
}

.dropdown-content a { 
    color: #000; 
    padding: 10px 14px; 
    text-decoration: none; 
    display: flex; 
    align-items: center; 
    gap: 8px; 
    font-size: 14px; 
    border-bottom: 1px solid #eee; 
    transition: 0.3s; 
    font-family: 'Open Sans'; 
}

.dropdown-content a:hover { 
    background: #f4f4f4; 
    text-decoration: none;
}

.dropdown.show .dropdown-content { 
    display: block; 
}

.dropdown .dropdown-icon { 
    transition: transform 0.3s; 
}

.dropdown.show .dropdown-icon { 
    transform: rotate(180deg); 
}

/* Table */
.table { 
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 18px; 
    font-size: 15px; 
    font-family: 'Open Sans', sans-serif; 
}

.table th, .table td { 
    padding: 12px; 
    text-align: center; 
    border-bottom: 1px solid #e5e7eb; 
}

.table thead { 
    background: linear-gradient(90deg, #16a34a, #16a34a); 
    color: #fff; 
    font-weight: 600; 
    font-family: 'Poppins', sans-serif; 
}

/* Chart container styling */
.chart-container {
    position: relative;
    min-height: 420px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gallery-title { 
        font-size: 2.2rem; 
    }
    
    .container-main {
        padding: 15px;
    }
    
    .card {
        padding: 20px;
    }
    
    .table {
        font-size: 14px;
    }
    
    .table th, .table td {
        padding: 8px;
    }
}

@media (max-width: 576px) {
    .gallery-title { 
        font-size: 1.8rem; 
    }
    
    .gallery-header p {
        font-size: 1rem;
    }
    
    .layout-wrapper {
        gap: 15px;
    }
    
    .card {
        padding: 15px;
    }
}
</style>

<div class="container-main">
    <!-- Judul Halaman - Sama seperti halaman sejarah -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            DATA PEKERJAAN
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Statistik jenis pekerjaan masyarakat Desa Manggalung
        </p>
    </div>

    <div class="layout-wrapper">

        <!-- FILTER SIDEBAR -->
        <div class="layout-sidebar">
            <div class="card">
                <div class="filter-toggle" onclick="toggleFilter(this)">
                    <span>Filter Data</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="filter-content" id="filterContent">
                    <form method="GET" action="{{ route('pekerjaan') }}">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Dusun:</label>
                            <select name="dusun" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Dusun</option>
                                @foreach($dusunList as $dusun)
                                    <option value="{{ $dusun->dusun }}" {{ request('dusun')==$dusun->dusun?'selected':'' }}>{{ ucfirst($dusun->dusun) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(request('dusun'))
                            <a href="{{ route('pekerjaan') }}" class="btn-reset">Reset</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- MAIN -->
        <div class="layout-main">

            <!-- CHART -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                    <h5 class="mb-0">
                        Statistik Pekerjaan Penduduk 
                        @if(request('dusun')) (Dusun {{ ucfirst(request('dusun')) }}) @else (Seluruh Dusun) @endif
                    </h5>
                    <button class="btn-download" onclick="downloadChart()">
                        Download Grafik
                    </button>
                </div>
                <div class="chart-container">
                    <div id="pie-chart-Pekerjaan"></div>
                </div>
            </div>

            <!-- TABLE -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h5 class="mb-2 mb-md-0">
                        Tabel Data Pekerjaan
                    </h5>
                    <div class="dropdown">
                        <button class="btn-download" onclick="toggleDropdown(event,this)">
                            Download <i class="bi bi-chevron-down ms-1 dropdown-icon"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#" onclick="downloadExcel()">Excel</a>
                            <a href="#" onclick="downloadCSV()">CSV</a>
                            <a href="#" onclick="downloadPDF()">PDF</a>
                        </div>
                    </div>
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
                            @php $persen = $total > 0 ? round(($item->jumlah/$total)*100,1) : 0; @endphp
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $persen }}%</td>
                            </tr>
                        @endforeach
                        <tr class="fw-bold table-light">
                            <td colspan="2">Total</td>
                            <td>{{ number_format($total, 0, ',', '.') }}</td>
                            <td>100%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
  // Toggle Filter
  function toggleFilter(el){
    el.classList.toggle('active');
    el.nextElementSibling.classList.toggle('active');
  }

  // Toggle Dropdown & Arrow
  function toggleDropdown(event, btn){
    event.stopPropagation();
    const dropdown = btn.parentElement;
    const icon = btn.querySelector(".dropdown-icon");
    dropdown.classList.toggle("show");
    icon.classList.toggle("rotate");
    document.addEventListener("click", ()=>{
        dropdown.classList.remove("show");
        icon.classList.remove("rotate");
    }, {once:true});
  }

  // Chart
  document.addEventListener("DOMContentLoaded",function(){
    const data = @json($pekerjaanStats);
    const total = data.reduce((sum, d) => sum + d.jumlah, 0);
    const chart = new ApexCharts(document.querySelector("#pie-chart-Pekerjaan"),{
      series: data.map(d => d.jumlah),
      colors: ["#22c55e","#3b82f6","#f97316","#8b5cf6","#ef4444","#14b8a6","#eab308","#84cc16"],
      chart: {
          height: 420,
          type: "donut",
          fontFamily: 'Open Sans, sans-serif'
      },
      labels: data.map(d => d.pekerjaan),
      dataLabels: {
          enabled: true,
          style: {
              fontSize: '13px',
              fontFamily: 'Open Sans, sans-serif'
          }
      },
      legend: {
          position: "bottom",
          fontSize: "14px",
          fontFamily: "Poppins, sans-serif",
          fontWeight: 500
      },
      plotOptions: { 
          pie: { 
              donut: { 
                  size: "65%", 
                  labels: { 
                      show: true, 
                      total: { 
                          show: true, 
                          label: "Total Pekerjaan",
                          color: "#000",
                          fontFamily: "Poppins, sans-serif",
                          fontWeight: 600,
                          formatter: () => total.toLocaleString('id-ID')
                      }
                  }
              }
          }
      },
      tooltip: {
          y: {
              formatter: function(value) {
                  return value.toLocaleString('id-ID');
              }
          }
      }
    });
    chart.render();

    window.downloadChart = function(){
      chart.dataURI().then(({imgURI}) => {
        const a = document.createElement("a");
        a.href = imgURI;
        a.download = "Statistik_Pekerjaan_Desa_Manggalung.png";
        a.click();
      });
    }
  });

  // Download Table
  function downloadExcel(){ 
    const wb = XLSX.utils.table_to_book(document.getElementById("tabelPekerjaan")); 
    XLSX.writeFile(wb, "Data_Pekerjaan_Desa_Manggalung.xlsx"); 
  }
  
  function downloadCSV(){ 
    const wb = XLSX.utils.table_to_book(document.getElementById("tabelPekerjaan")); 
    XLSX.writeFile(wb, "Data_Pekerjaan_Desa_Manggalung.csv"); 
  }
  
  function downloadPDF(){
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    // Add title
    doc.setFont("Poppins", "bold");
    doc.setFontSize(18);
    doc.text("DATA PEKERJAAN DESA MANGGAUNG", 105, 15, { align: "center" });
    
    // Add date
    doc.setFont("Open Sans", "normal");
    doc.setFontSize(10);
    doc.text(`Dicetak pada: ${new Date().toLocaleDateString('id-ID')}`, 105, 22, { align: "center" });
    
    // Add table
    doc.autoTable({
        html: '#tabelPekerjaan',
        startY: 30,
        styles: {
            font: 'Open Sans',
            fontSize: 10
        },
        headStyles: {
            fillColor: [22, 163, 74],
            textColor: 255,
            fontStyle: 'bold',
            font: 'Poppins'
        },
        alternateRowStyles: {
            fillColor: [245, 245, 245]
        }
    });
    
    doc.save("Data_Pekerjaan_Desa_Manggalung.pdf");
  }
</script>
@endsection