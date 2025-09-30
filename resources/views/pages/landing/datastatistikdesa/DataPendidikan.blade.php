@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pendidikan</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
.pendidikan-container { max-width: 1400px; margin:auto; padding:20px; }

.card { background:#fff; border-radius:14px; padding:25px; box-shadow:0 8px 20px rgba(0,0,0,0.06); transition: transform .25s, box-shadow .25s; }
.card:hover { transform:translateY(-3px); box-shadow:0 12px 28px rgba(0,0,0,0.12); }

.table { width:100%; border-collapse:collapse; margin-top:18px; font-size:15px; }
.table th, .table td { padding:12px; text-align:center; border-bottom:1px solid #e5e7eb; }
.table thead { background: linear-gradient(90deg,#2563eb,#16a34a); color:#fff; }

.filter-toggle { display:block; background:#2563eb; color:#fff; text-align:center; padding:12px; cursor:pointer; border-radius:10px; margin-bottom:14px; font-weight:600; }
.filter-content { display:none; max-height:450px; overflow-y:auto; }
.filter-content.active { display:block; }

.dusun-card { background:#f0fdf4; border-radius:12px; padding:12px; margin-bottom:12px; border:1px solid #bbf7d0; }
.dusun-card:hover { background:#dcfce7; transform:translateY(-2px); }
</style>

<div class="pendidikan-container">
  <div class="row g-4">
    <div class="col-lg-9">
      <div class="card">
        <h6>Statistik Pendidikan Penduduk</h6>
        <div id="pendidikan-chart" style="min-height:400px"></div>
      </div>
      <div class="card">
        <h6>Tabel Data Pendidikan</h6>
        <table class="table table-bordered text-center">
          <thead>
            <tr><th>No</th><th>Pendidikan</th><th>Jumlah</th><th>Presentase</th></tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>SD</td><td>55</td><td>55%</td></tr>
            <tr><td>2</td><td>SMP</td><td>25</td><td>25%</td></tr>
            <tr><td>3</td><td>SMA</td><td>20</td><td>20%</td></tr>
            <tr class="fw-bold table-light"><td>4</td><td>Total</td><td>100</td><td>100%</td></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilter()">☰ Filter Dusun</div>
        <div class="filter-content" id="filterContent">
          <input type="search" placeholder="Cari Dusun..." class="search-box" id="searchBox" />
          <div class="dusun-card"><h4>Dusun A</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
          <div class="dusun-card"><h4>Dusun B</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
          <div class="dusun-card"><h4>Dusun C</h4><small>Tahun 2024</small><br><small>Tahun 2025</small></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
const options={series:[{name:"Jumlah",data:[55,25,20]}],chart:{type:"bar",height:400,toolbar:{show:false}},colors:["#16a34a","#2563eb","#f59e0b"],plotOptions:{bar:{horizontal:false,columnWidth:"55%",borderRadius:8}},dataLabels:{enabled:true,formatter: val=>val+"%",style:{colors:["#111"]}},xaxis:{categories:["SD","SMP","SMA"]},yaxis:{max:100,labels:{formatter: val=>val+"%"}},legend:{show:false},grid:{borderColor:"#e2e8f0",strokeDashArray:4},tooltip:{y:{formatter: val=>val+" Penduduk"}}};

if(document.getElementById("pendidikan-chart")) new ApexCharts(document.getElementById("pendidikan-chart"), options).render();

function toggleFilter(){document.getElementById('filterContent').classList.toggle('active');}
document.getElementById('searchBox').addEventListener('keyup', function(){ let q=this.value.toLowerCase(); document.querySelectorAll('.dusun-card').forEach(c=>c.style.display=c.innerText.toLowerCase().includes(q)?'block':'none'); });
</script>
@endsection
