@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
<style>
    body { font-family: 'Segoe UI', Arial, sans-serif; }

    /* Hero */
    .hero-card {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: #fff;
        border-radius: 18px;
        padding: 40px 20px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    .hero-card:hover { transform: translateY(-5px); }
    .hero-card h2 { font-weight: 700; font-size: 28px; }
    .hero-card p { font-size: 15px; margin-top: 10px; }

    /* Statistik Cards */
    .stat-card {
        border-radius: 16px;
        text-align: center;
        padding: 25px 15px;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
    .stat-card i { font-size: 3rem; margin-bottom: 10px; display: block; }
    .stat-card h3 { font-size: 2.3rem; font-weight: 700; margin-top: 5px; }
    .stat-card h6 { font-weight: 600; color: #555; }

    /* Chart & Calendar */
    .card-chart, .card-calendar { height: 100%; }
    .card-chart canvas { max-height: 100%; }

    .card { border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,0.05); transition: all 0.3s; }
    .card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.08); }

    /* Table */
    .table td, .table th { vertical-align: middle; }
    .table-hover tbody tr:hover { background-color: rgba(0,123,255,0.05); }
    .badge { font-size: 0.85rem; font-weight: 500; padding: 0.45em 0.7em; border-radius: 12px; }

    /* Mini Calendar */
    .mini-calendar { font-size: 0.70rem; }
    .mini-calendar table { width: 100%; table-layout: fixed; border-collapse: collapse; }
    .mini-calendar th, .mini-calendar td { padding: 6px; text-align: center; vertical-align: middle; }
    .mini-calendar .today {
        background: #2575fc; color: #fff;
        border-radius: 50%; padding: 6px 8px; font-weight: bold; display: inline-block; min-width: 28px;
    }

    /* Tautan Cepat */
    .quick-links .btn {
        font-weight: 500;
        border-radius: 12px;
        padding: 12px 15px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: flex-start;
    }
    .quick-links .btn i { font-size: 1.2rem; }
</style>
@endpush

<div class="main-content">
<section class="section">

    {{-- HEADER --}}
    <div class="section-header mb-3">
        <h1>Admin Dashboard</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        </div>
    </div>

    {{-- HERO --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card hero-card">
                <h2>SISTEM INFORMASI DESA CANTIK</h2>
                <p>Meningkatkan literasi statistik, standardisasi data, pemanfaatan data, dan agen statistik di tingkat desa/kelurahan.</p>
            </div>
        </div>
    </div>

    {{-- STATISTIK CARDS --}}
    <div class="row mb-4">
        @php
            $stats = [
                ['icon'=>'users','label'=>'Total Penduduk','value'=>$totalPenduduk ?? 0,'color'=>'warning'],
                ['icon'=>'exclamation-circle','label'=>'Pengaduan','value'=>$totalPengaduan ?? 0,'color'=>'primary'],
                ['icon'=>'file-alt','label'=>'Surat','value'=>$totalSurat ?? 0,'color'=>'success'],
                ['icon'=>'newspaper','label'=>'Berita','value'=>$totalBerita ?? 0,'color'=>'info'],
            ];
        @endphp
        @foreach($stats as $stat)
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card stat-card shadow-sm">
                <div class="text-{{ $stat['color'] }}"><i class="fas fa-{{ $stat['icon'] }}"></i></div>
                <h6>{{ $stat['label'] }}</h6>
                <h3>{{ $stat['value'] }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CHART & CALENDAR --}}
    <div class="row mb-4">
        <div class="col-lg-7 mb-3">
            <div class="card card-chart shadow-sm">
                <div class="card-header"><h4>Statistik Penduduk</h4></div>
                <div class="card-body" style="height:320px;">
                    <canvas id="populationChart" style="width:100%; height:100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-3">
            <div class="card card-calendar shadow-sm">
                <div class="card-header"><h4>Kalender</h4></div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height:320px;">
                    <div id="miniCalendar" class="mini-calendar w-100"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- PENGADUAN TERBARU & TAUTAN CEPAT --}}
    <div class="row">
        <div class="col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header"><h4>Pengaduan Terbaru</h4></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Pelapor</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($latestPengaduan ?? []) as $item)
                                    <tr>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>
                                        <td>{{ $item->nama ?? '-' }}</td>
                                        <td>{{ $item->judul ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ ($item->status ?? 'baru') === 'selesai' ? 'success' : 'warning' }}">
                                                {{ ucfirst($item->status ?? 'baru') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-3">
            <div class="card shadow-sm">
                <div class="card-header"><h4>Tautan Cepat</h4></div>
                <div class="card-body quick-links d-grid gap-2">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">
                        <i class="fas fa-exclamation-circle"></i> Kelola Pengaduan
                    </a>
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-file-alt"></i> Kelola Surat
                    </a>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-info">
                        <i class="fas fa-newspaper"></i> Kelola Berita
                    </a>
                    <a href="#" class="btn btn-warning">
                        <i class="fas fa-users"></i> Kelola Pengguna
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    <script>
    // === CHART PENUDUK ===
    var ctx = document.getElementById('populationChart').getContext('2d');

    var labelsPenduduk = {!! json_encode($labelsPenduduk ?? ['RT1','RT2','RT3']) !!};
    var dataPenduduk = {!! json_encode($dataPenduduk ?? [0,0,0]) !!};

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsPenduduk,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: dataPenduduk,
                backgroundColor: ['#4e73df','#1cc88a','#36b9cc','#f6c23e','#e74a3b'],
                borderRadius: 8
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: { beginAtZero: true },
                    gridLines: { color: '#f2f2f2' }
                }],
                xAxes: [{ gridLines: { display: false } }]
            },
            legend: { display: false },
            tooltips: {
                backgroundColor: '#fff',
                bodyFontColor: '#333',
                borderColor: '#ddd',
                borderWidth: 1
            }
        }
    });
</script>


    // Mini Calendar
    (function renderCalendar(){
        var container = document.getElementById('miniCalendar');
        var today = new Date();
        var y = today.getFullYear(), m = today.getMonth();
        var first = new Date(y, m, 1);
        var last = new Date(y, m+1, 0);
        var weeks = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
        var html = `<h6 class="text-center mb-2 fw-bold">${first.toLocaleString('id-ID',{month:'long'})} ${y}</h6>`;
        html += '<table class="table table-bordered small mb-0"><thead><tr>';
        weeks.forEach(w=> html+=`<th>${w}</th>`);
        html += '</tr></thead><tbody>';

        var day=1, started=false;
        for(var r=0;r<6;r++){
            html+='<tr>';
            for(var c=0;c<7;c++){
                var cell = '';
                if(!started && c===first.getDay()) started=true;
                if(started && day<=last.getDate()){
                    cell = `<span class="${day===today.getDate()?'today':''}">${day}</span>`;
                    day++;
                }
                html+=`<td class="text-center">${cell}</td>`;
            }
            html+='</tr>';
            if(day>last.getDate()) break;
        }
        html+='</tbody></table>';
        container.innerHTML=html;
    })();
</script>
@endpush
@endsection
