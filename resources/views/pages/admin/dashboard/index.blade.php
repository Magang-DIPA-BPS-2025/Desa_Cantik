@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/weathericons/css/weather-icons-wind.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Admin Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                </div>
            </div>

            {{-- Hero Header --}}
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 hero-card">
                        <div class="card-body text-center">
                            <h2 class="mb-2 font-weight-bold">SISTEM INFORMASI DESA CANTIK</h2>
                            <p class="mb-0 text-muted">
                                Meningkatkan literasi statistik, standardisasi data, pemanfaatan data, dan agen statistik di
                                tingkat desa/kelurahan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Statistic Cards --}}
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 stat-soft">
                        <div class="card-icon bg-warning"><i class="fas fa-users"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Total Penduduk</h4></div>
                            <div class="card-body">{{ $totalPenduduk ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 stat-soft">
                        <div class="card-icon bg-primary"><i class="fas fa-exclamation-circle"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Pengaduan</h4></div>
                            <div class="card-body">{{ $totalPengaduan ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 stat-soft">
                        <div class="card-icon bg-success"><i class="fas fa-file-alt"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Surat</h4></div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 stat-soft">
                        <div class="card-icon bg-info"><i class="fas fa-newspaper"></i></div>
                        <div class="card-wrap">
                            <div class="card-header"><h4>Berita</h4></div>
                            <div class="card-body">{{ $totalBerita ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chart & Calendar --}}
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header"><h4>Statistik Penduduk</h4></div>
                        <div class="card-body">
                            <canvas id="populationChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header"><h4>Kalender</h4></div>
                        <div class="card-body">
                            <div id="miniCalendar" class="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Useful Widget: Latest Pengaduan --}}
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header"><h4>Pengaduan Terbaru</h4></div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
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
                                                    <span class="badge badge-{{ ($item->status ?? 'baru') === 'selesai' ? 'success' : 'warning' }}">
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
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header"><h4>Tautan Cepat</h4></div>
                        <div class="card-body">
                            <div class="buttons">
                                <a href="{{ route('pengaduan.index') }}" class="btn btn-primary btn-icon icon-left mb-2"><i class="fas fa-exclamation-circle"></i> Kelola Pengaduan</a>
                                <a href="#" class="btn btn-success btn-icon icon-left mb-2"><i class="fas fa-file-alt"></i> Kelola Surat</a>
                                <a href="{{ route('berita.index') }}" class="btn btn-info btn-icon icon-left mb-2"><i class="fas fa-newspaper"></i> Kelola Berita</a>
                                <a href="#" class="btn btn-warning btn-icon icon-left mb-2"><i class="fas fa-users"></i> Kelola Pengguna</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script>
            // Soft styling for hero and stats
            (function(){
                var style = document.createElement('style');
                style.innerHTML = `.hero-card{background:#d6e4bd;border-radius:14px}.stat-soft .card-icon{box-shadow:0 10px 20px rgba(0,0,0,.07)}`;
                document.head.appendChild(style);
            })();

            // Bar chart Statistik Penduduk
            var popCtx = document.getElementById('populationChart').getContext('2d');
            new Chart(popCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(($labelsPenduduk ?? ['RT1','RT2','RT3'])) !!},
                    datasets: [{
                        label: 'Jumlah',
                        data: {!! json_encode(($dataPenduduk ?? [0,0,0])) !!},
                        backgroundColor: ['#f6c23e','#1cc88a','#36b9cc'],
                        borderWidth: 0,
                        borderRadius: 8,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{ ticks: { beginAtZero: true }, gridLines: { color: '#f2f2f2' } }],
                        xAxes: [{ gridLines: { display: false } }]
                    },
                    legend: { display: false }
                }
            });

            // Mini Calendar
            (function renderCalendar(){
                var container = document.getElementById('miniCalendar');
                if(!container) return;
                var today = new Date();
                var y = today.getFullYear(), m = today.getMonth();
                var first = new Date(y, m, 1);
                var last = new Date(y, m + 1, 0);
                var weeks = ['Su','Mo','Tu','We','Th','Fr','Sa'];
                var html = '<div class="d-flex justify-content-between align-items-center mb-2">'+
                           '<h6 class="mb-0">'+ first.toLocaleString('default',{month:'long'}) +' '+ y +'</h6>'+
                           '</div>';
                html += '<table class="table table-bordered mb-0 small"><thead><tr>' + weeks.map(w=>'<th class="text-center">'+w+'</th>').join('') + '</tr></thead><tbody>';
                var day = 1; var started = false;
                for(var r=0;r<6;r++){
                    html += '<tr>';
                    for(var c=0;c<7;c++){
                        var cell = '';
                        if(!started && c === first.getDay()) started = true;
                        if(started && day <= last.getDate()) { cell = day++; }
                        html += '<td class="text-center">'+ (cell||'') +'</td>';
                    }
                    html += '</tr>';
                    if(day>last.getDate()) break;
                }
                html += '</tbody></table>';
                container.innerHTML = html;
            })();
        </script>
    @endpush
@endsection
