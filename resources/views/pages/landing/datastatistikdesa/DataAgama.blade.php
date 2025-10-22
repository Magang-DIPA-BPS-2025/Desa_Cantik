@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Agama</title>

<!-- Library -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { font-family: 'Open Sans', sans-serif; color:#000; background:#fff; }
h3,h4,h5,h6 { font-family:'Poppins'; font-weight:600; color:#000; }

.container-main { max-width:1400px; margin:auto; padding:20px; }
.layout-wrapper { display:flex; gap:20px; }
.layout-sidebar { order:2; flex:0 0 20%; }
.layout-main { order:1; flex:1; display:flex; flex-direction:column; gap:25px; }

@media(max-width:992px){ .layout-wrapper{ flex-direction:column; } .layout-sidebar,.layout-main{ width:100%; order:unset; } }

.card { background:#fff; border-radius:14px; padding:25px; box-shadow:0 8px 20px rgba(0,0,0,0.06); transition:.25s; }
.card:hover { transform:translateY(-3px); box-shadow:0 12px 28px rgba(0,0,0,0.12); }

.filter-toggle { background:#16a34a; color:#fff; padding:14px 18px; border-radius:12px; cursor:pointer; display:flex; justify-content:space-between; align-items:center; font-weight:600; }
.filter-toggle i { transition: transform 0.3s; }
.filter-toggle.active i { transform: rotate(180deg); }

.filter-content { overflow:hidden; max-height:0; opacity:0; transition:all 0.4s; background:#f9fafb; border-radius:0 0 12px 12px; margin-top:10px; }
.filter-content.active { max-height:600px; opacity:1; padding:16px; }

.form-select { width:100%; padding:10px; border:1px solid #ccc; border-radius:10px; font-family:'Open Sans'; }
.btn-reset { display:inline-block; margin-top:10px; color:#000; border:1px solid #000; border-radius:8px; padding:6px 12px; background:#fff; font-family:'Poppins'; }
.btn-reset:hover { background:#000; color:#fff; }

.btn-download { background:#16a34a; color:#fff; border:none; border-radius:8px; padding:8px 14px; display:flex; align-items:center; gap:6px; font-size:14px; font-weight:500; cursor:pointer; transition:.3s; font-family:'Poppins'; }
.btn-download:hover { background:#15803d; }

.dropdown { position:relative; display:inline-block; }
.dropdown-content { position:absolute; right:0; top:100%; display:none; background:#fff; min-width:170px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); z-index:99; transition:0.25s; }
.dropdown-content a { color:#000; padding:10px 14px; text-decoration:none; display:flex; align-items:center; gap:8px; font-size:14px; border-bottom:1px solid #eee; transition:.3s; font-family:'Open Sans'; }
.dropdown-content a:hover { background:#f4f4f4; }
.dropdown.show .dropdown-content { display:block; }
.dropdown .dropdown-icon { transition: transform 0.3s; }
.dropdown.show .dropdown-icon { transform: rotate(180deg); }

.table { width:100%; border-collapse:collapse; margin-top:18px; font-size:15px; font-family:'Open Sans'; }
.table th,.table td { padding:12px; text-align:center; border-bottom:1px solid #e5e7eb; }
.table thead { background:linear-gradient(90deg,#16a34a,#16a34a); color:#fff; font-weight:600; font-family:'Poppins'; }
</style>

<div class="container-main">
  <div class="layout-wrapper">

    <!-- Sidebar Filter -->
    <div class="layout-sidebar">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilter(this)">
          <span><i class="bi bi-funnel-fill me-2"></i> Filter Data</span>
          <i class="bi bi-chevron-down"></i>
        </div>
        <div class="filter-content" id="filterContent">
          <form method="GET" action="{{ route('agama') }}">
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
              <a href="{{ route('agama') }}" class="btn-reset"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset</a>
            @endif
          </form>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="layout-main">

      <!-- Chart Card -->
      <div class="card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
          <h6>Statistik Agama Penduduk @if(request('dusun')) (Dusun {{ ucfirst(request('dusun')) }}) @else (Seluruh Dusun) @endif</h6>
          <button class="btn-download" onclick="downloadChart()"><i class="bi bi-download"></i> Download Grafik</button>
        </div>
        <div id="pie-chart-Agama" style="min-height:420px;"></div>
      </div>

      <!-- Table Card -->
      <div class="card">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
          <h6 class="mb-2 mb-md-0">Tabel Data Agama</h6>
          <div class="dropdown">
            <button class="btn-download" onclick="toggleDropdown(event,this)">
              <i class="bi bi-download"></i> Download <i class="bi bi-chevron-down ms-1 dropdown-icon"></i>
            </button>
            <div class="dropdown-content">
              <a href="#" onclick="downloadExcel()"><i class="bi bi-file-earmark-excel text-success"></i> Excel</a>
              <a href="#" onclick="downloadCSV()"><i class="bi bi-filetype-csv text-primary"></i> CSV</a>
              <a href="#" onclick="downloadPDF()"><i class="bi bi-file-earmark-pdf text-danger"></i> PDF</a>
            </div>
          </div>
        </div>
        <table id="tabelAgama" class="table table-bordered text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Agama</th>
              <th>Jumlah</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            @php $total = $agamaStats->sum('jumlah'); @endphp
            @foreach($agamaStats as $index => $item)
              @php $persentase = $total>0 ? round(($item->jumlah/$total)*100,1) : 0; @endphp
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->agama }}</td>
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
// Toggle Filter
function toggleFilter(el){
  el.classList.toggle('active');
  el.nextElementSibling.classList.toggle('active');
}

// Dropdown & Arrow
function toggleDropdown(event, btn){
  event.stopPropagation();
  const dropdown = btn.parentElement;
  dropdown.classList.toggle("show");
  const arrow = btn.querySelector('.dropdown-icon');
  arrow.classList.toggle('rotate-180');
  document.addEventListener("click",()=>{ 
    dropdown.classList.remove("show"); 
    arrow.classList.remove('rotate-180'); 
  },{once:true});
}

// Chart
document.addEventListener("DOMContentLoaded", function(){
  const agamaData = @json($agamaStats);
  const total = agamaData.reduce((sum,item)=>sum+item.jumlah,0);
  const chart = new ApexCharts(document.querySelector("#pie-chart-Agama"),{
    series: agamaData.map(item=>item.jumlah),
    colors:["#22c55e","#60a5fa","#f97316","#a78bfa","#ef4444","#14b8a6","#eab308","#84cc16"],
    chart:{height:420,type:"donut"},
    labels: agamaData.map(item=>item.agama),
    dataLabels:{enabled:true,style:{fontSize:'13px'}},
    legend:{position:"bottom",fontSize:"14px"},
    plotOptions:{pie:{donut:{size:"65%",labels:{show:true,total:{show:true,label:"Total",formatter:()=>total}}}}}
  });
  chart.render();

  window.downloadChart = function(){
    chart.dataURI().then(({imgURI})=>{
      const a=document.createElement("a"); a.href=imgURI; a.download="Statistik_Agama.png"; a.click();
    });
  };
});

// Download Table
function downloadExcel(){ const wb=XLSX.utils.table_to_book(document.getElementById("tabelAgama")); XLSX.writeFile(wb,"Data_Agama.xlsx"); }
function downloadCSV(){ const wb=XLSX.utils.table_to_book(document.getElementById("tabelAgama")); XLSX.writeFile(wb,"Data_Agama.csv"); }
function downloadPDF(){
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  doc.text("Data Agama",14,16);
  doc.autoTable({ html:'#tabelAgama', startY:20 });
  doc.save("Data_Agama.pdf");
}
</script>
@endsection
