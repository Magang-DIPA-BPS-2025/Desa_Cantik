@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Jumlah Penduduk</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    transition: transform .25s, box-shadow .25s;
  }

  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
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
    background: linear-gradient(90deg, #2563eb, #16a34a);
    color: #fff;
  }

  .filter-toggle {
    display: block;
    background: #2563eb;
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

  .filter-select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
    margin-bottom: 10px;
  }

  .reset-btn {
    display: block;
    margin-top: 5px;
    width: 100%;
  }

  @media (max-width: 992px) {
    .row {
      flex-direction: column;
    }
  }
</style>

<div class="container-main">
  <div class="row g-4">
    <!-- Chart & Tabel -->
    <div class="col-lg-9 d-flex flex-column gap-4">
      <div class="card">
        <h6>Statistik Jumlah Penduduk</h6>
        <div id="pie-chart" style="min-height: 400px;"></div>
      </div>

      <div class="card">
        <h6>Tabel Data Penduduk</h6>
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            @php
              $totalPenduduk = $kepalaKeluarga + $laki + $perempuan + $disabilitas;
            @endphp
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

    <!-- Sidebar Filter Dusun (sama dengan Data Pendidikan) -->
    <div class="col-lg-3">
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
  // Chart
  const totalPenduduk = {{ $totalPenduduk }};
  const data = {
    kepala: {{ $kepalaKeluarga }},
    laki: {{ $laki }},
    perempuan: {{ $perempuan }},
    disabilitas: {{ $disabilitas }}
  };

  const options = {
    series: [data.laki, data.perempuan, data.disabilitas, data.kepala],
    colors: ["#22c55e", "#60a5fa", "#f97316", "#a78bfa"],
    chart: { height: 420, type: "donut" },
    labels: ["Laki-laki", "Perempuan", "Disabilitas", "Kepala Keluarga"],
    stroke: { colors: ["#ffffff"] },
    dataLabels: {
      enabled: true,
      formatter: function(val) { return val.toFixed(1) + "%"; },
      style: { fontSize: "13px" }
    },
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
              formatter: () => totalPenduduk
            }
          }
        }
      }
    }
  };

  if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), options);
    chart.render();
  }

  // Toggle filter (sama seperti Data Pendidikan)
  function toggleFilterPenduduk() {
    document.getElementById('filterContentPenduduk').classList.toggle('active');
  }
</script>
@endsection
