@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Data Pendidikan</title>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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

  .search-box {
    width: 100%;
    padding: 8px 12px;
    margin-bottom: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
  }

  .dusun-card {
    background: #f0fdf4;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 12px;
    border: 1px solid #bbf7d0;
    transition: 0.3s;
  }

  .dusun-card:hover {
    background: #dcfce7;
    transform: translateY(-2px);
  }
</style>

<div class="pendidikan-container">
  <div class="row g-4">
    <!-- Chart & Tabel -->
    <div class="col-lg-9">
      <div class="card mb-4">
        <h6>Statistik Pendidikan Penduduk</h6>
        <div id="pendidikan-chart-Agama" style="min-height: 400px;"></div>
      </div>

      <div class="card">
        <h6>Tabel Data Pendidikan</h6>
        <table class="table table-bordered text-center">
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

    <!-- Filter Dusun -->
    <div class="col-lg-3">
      <div class="card">
        <div class="filter-toggle" onclick="toggleFilterPendidikan()">☰ Filter Dusun</div>
        <div class="filter-content" id="filterContentPendidikan">
          <form method="GET" action="{{ route('pendidikan') }}">
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

<!-- Script Chart dan Filter -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Data dari database
    const pendidikanData = @json($pendidikanStats);
    const labels = pendidikanData.map(item => item.pendidikan);
    const data = pendidikanData.map(item => item.jumlah);
    const total = data.reduce((sum, val) => sum + val, 0);
    const percentages = data.map(val => total > 0 ? Math.round((val / total) * 100) : 0);

    // Inisialisasi Chart
    const options = {
      series: [{
        name: "Jumlah",
        data: percentages
      }],
      chart: {
        type: "bar",
        height: 400,
        toolbar: { show: false }
      },
      colors: ["#16a34a", "#2563eb", "#f59e0b", "#dc2626", "#7c3aed", "#ea580c"],
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: "55%",
          borderRadius: 8
        }
      },
      dataLabels: {
        enabled: true,
        formatter: val => val + "%",
        style: {
          colors: ["#111"]
        }
      },
      xaxis: {
        categories: labels
      },
      yaxis: {
        max: 100,
        labels: {
          formatter: val => val + "%"
        }
      },
      legend: { show: false },
      grid: {
        borderColor: "#e2e8f0",
        strokeDashArray: 4
      },
      tooltip: {
        y: {
          formatter: val => val + " Penduduk"
        }
      }
    };

    const chartEl = document.querySelector("#pendidikan-chart-Agama");
    if (chartEl) {
      const chart = new ApexCharts(chartEl, options);
      chart.render();
    }

    // Filter Toggle
    document.querySelector('.filter-toggle').addEventListener('click', function () {
      document.getElementById('filterContentPendidikan').classList.toggle('active');
    });
  });
</script>
@endsection
