@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pekerjaan</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
/* Container halaman */
.statistik-container {
  max-width: 1400px;
  margin: auto;
  padding: 20px;
}

/* Card */
.card {
  background: #fff;
  border-radius: 16px;
  padding: 25px;
  box-shadow: 0 8px 22px rgba(0,0,0,0.08);
  transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* Table */
.data-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 18px;
  font-size: 15px;
}

.data-table th, .data-table td {
  padding: 12px;
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}

.data-table thead {
  background: linear-gradient(90deg, #3B82F6, #31C48D);
  color: #fff;
}

/* Sidebar Filter */
.filter-toggle {
  display: block;
  background: linear-gradient(90deg, #3B82F6, #2563EB);
  color: white;
  text-align: center;
  padding: 12px;
  cursor: pointer;
  border-radius: 10px;
  margin-bottom: 14px;
  font-weight: 600;
}

.filter-content { display: none; max-height: 400px; overflow-y: auto; }
.filter-content.active { display: block; }

.dusun-card {
  background: #f0fdf4;
  border-radius: 10px;
  padding: 12px;
  margin-bottom: 12px;
  border: 1px solid #d1fae5;
}
.dusun-card:hover { background: #dcfce7; }

/* Footer center */
.site-footer {
    width: 100%;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 15px 0;
    background: #f8f9fa;
    font-size: 14px;
    box-sizing: border-box;
    margin: 0;
}

</style>

<div class="statistik-container">
  <div class="row g-3">
    <!-- Main Content -->
    <div class="col-md-9">
      <div class="card">
        <h6>Statistik Pekerjaan Penduduk</h6>
        <div id="chart-pekerjaan"></div>
      </div>

      <div class="card">
        <h6>Tabel Data Pekerjaan</h6>
        <table class="data-table">
          <thead>
            <tr><th>No</th><th>Pekerjaan</th><th>Jumlah</th><th>Presentase</th></tr>
          </thead>
          <tbody>
            <tr><td>1</td><td>Tidak Bekerja</td><td>{{ $tidakBekerja }}</td><td id="persen-tidak"></td></tr>
            <tr><td>2</td><td>Petani</td><td>{{ $petani }}</td><td id="persen-petani"></td></tr>
            <tr><td>3</td><td>PNS</td><td>{{ $pns }}</td><td id="persen-pns"></td></tr>
            <tr><td>4</td><td>Pelajar/Mahasiswa</td><td>{{ $pelajar }}</td><td id="persen-pelajar"></td></tr>
            <tr><td>5</td><td>Karyawan Swasta</td><td>{{ $swasta }}</td><td id="persen-swasta"></td></tr>
            <tr><td>6</td><td>Wiraswasta</td><td>{{ $wiraswasta }}</td><td id="persen-wiraswasta"></td></tr>
            <tr class="fw-bold"><td colspan="2">Total</td><td>{{ $totalPekerjaan }}</td><td>100%</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Sidebar Filter -->
    <div class="col-md-3">
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
document.addEventListener("DOMContentLoaded", function() {
  // Data chart
  let data = [
    {{ $tidakBekerja }},
    {{ $petani }},
    {{ $pns }},
    {{ $pelajar }},
    {{ $swasta }},
    {{ $wiraswasta }}
  ];
  let total = data.reduce((a,b)=>a+b,0);
  let percentages = data.map(v=>total>0? (v/total*100):0);

  document.getElementById('persen-tidak').textContent = percentages[0].toFixed(1)+'%';
  document.getElementById('persen-petani').textContent = percentages[1].toFixed(1)+'%';
  document.getElementById('persen-pns').textContent = percentages[2].toFixed(1)+'%';
  document.getElementById('persen-pelajar').textContent = percentages[3].toFixed(1)+'%';
  document.getElementById('persen-swasta').textContent = percentages[4].toFixed(1)+'%';
  document.getElementById('persen-wiraswasta').textContent = percentages[5].toFixed(1)+'%';

  // Pie Chart
  var options = {
    series: data,
    chart: { type:'pie', height:400 },
    labels: ["Tidak Bekerja","Petani","PNS","Pelajar/Mahasiswa","Karyawan Swasta","Wiraswasta"],
    colors: ['#C0D09D','#A4BC92','#95A78D','#BCC5A8','#8C9C74','#708B75'],
    legend: { position:'bottom' },
    dataLabels: { formatter: val=>val.toFixed(1)+'%' },
    tooltip: { y: { formatter: (val,i)=>data[i]+' orang ('+percentages[i].toFixed(1)+'%)' } }
  };
  new ApexCharts(document.querySelector("#chart-pekerjaan"), options).render();

  // Filter search
  document.getElementById('searchBox').addEventListener('keyup', function(){
    let q=this.value.toLowerCase();
    document.querySelectorAll('.dusun-card').forEach(c=>c.style.display=c.innerText.toLowerCase().includes(q)?'block':'none');
  });
});

function toggleFilter(){ document.getElementById('filterContent').classList.toggle('active'); }
</script>
@endsection
