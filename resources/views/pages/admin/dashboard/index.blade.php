@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .main-content {
        padding: 20px;
    }

    /* Hero Section */
    .hero-card {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        border-radius: 16px;
        padding: 30px 25px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(106, 17, 203, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .hero-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        transform: rotate(30deg);
    }
    .hero-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(106, 17, 203, 0.4);
    }
    .hero-card h2 {
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 10px;
        position: relative;
    }
    .hero-card p {
        font-size: 16px;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto;
        position: relative;
    }

    /* Statistik Cards */
    .stat-card {
        border-radius: 16px;
        text-align: center;
        padding: 25px 15px;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border: none;
        height: 100%;
    }
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }
    .stat-card i {
        font-size: 2.8rem;
        margin-bottom: 15px;
        display: block;
        opacity: 0.9;
    }
    .stat-card h3 {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 10px 0 5px;
    }
    .stat-card h6 {
        font-weight: 600;
        color: #6c757d;
        font-size: 15px;
    }

    /* Cards Umum */
    .card {
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border: none;
        transition: all 0.3s;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }
    .card-header {
        background: #fff;
        border-bottom: 1px solid #eaeaea;
        padding: 18px 25px;
        border-radius: 16px 16px 0 0 !important;
    }
    .card-header h4 {
        font-weight: 600;
        color: #343a40;
        margin: 0;
        font-size: 1.25rem;
    }

    /* Chart Container Modern */
    .chart-container {
        position: relative;
        height: 320px;
        width: 100%;
        padding: 15px;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 12px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 0 10px;
    }

    .chart-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }

    .chart-legend {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    /* Calendar Modern */
    .calendar-container {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        height: 100%;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eaeaea;
    }

    .calendar-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }

    .calendar-nav {
        display: flex;
        gap: 10px;
    }

    .calendar-nav-btn {
        background: #f8f9fa;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        color: #6c757d;
    }

    .calendar-nav-btn:hover {
        background: #007bff;
        color: white;
        transform: scale(1.1);
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        margin-bottom: 10px;
        text-align: center;
    }

    .weekday {
        font-weight: 600;
        color: #6c757d;
        padding: 8px 0;
        font-size: 0.85rem;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .calendar-day {
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        position: relative;
    }

    .calendar-day:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
    }

    .calendar-day.today {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        color: white;
        box-shadow: 0 4px 10px rgba(37, 117, 252, 0.3);
    }

    .calendar-day.event {
        background: #e8f4ff;
        color: #007bff;
        font-weight: 600;
    }

    .calendar-day.other-month {
        color: #dee2e6;
    }

    .event-dot {
        position: absolute;
        bottom: 4px;
        width: 4px;
        height: 4px;
        background: #007bff;
        border-radius: 50%;
    }

    .calendar-day.today .event-dot {
        background: white;
    }

    /* Table */
    .table {
        margin-bottom: 0;
    }
    .table td, .table th {
        vertical-align: middle;
        padding: 12px 15px;
    }
    .table thead th {
        border-bottom: 1px solid #eaeaea;
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(37, 117, 252, 0.05);
    }
    .badge {
        font-size: 0.8rem;
        font-weight: 500;
        padding: 0.5em 0.8em;
        border-radius: 12px;
    }

    /* Tautan Cepat */
    .quick-links .btn {
        font-weight: 500;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: flex-start;
        transition: all 0.3s;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }
    .quick-links .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.12);
    }
    .quick-links .btn i {
        font-size: 1.3rem;
        width: 24px;
        text-align: center;
    }

    /* Section Header */
    .section-header {
        margin-bottom: 25px;
    }
    .section-header h1 {
        font-weight: 700;
        color: #343a40;
        margin-bottom: 5px;
    }
    .breadcrumb-item.active {
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 15px;
        }

        .hero-card {
            padding: 20px 15px;
        }

        .hero-card h2 {
            font-size: 24px;
        }

        .stat-card {
            padding: 20px 10px;
        }

        .stat-card i {
            font-size: 2.2rem;
        }

        .stat-card h3 {
            font-size: 1.8rem;
        }

        .table td, .table th {
            padding: 8px 10px;
        }

        .chart-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .calendar-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
    }
</style>
@endpush

<div class="main-content">
<section class="section">

    {{-- HEADER --}}
    <div class="section-header mb-4">
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
        <div class="card stat-card shadow-sm border-0">
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
            <div class="card shadow-sm border-0">
                <div class="card-header border-0">
                    <h4>Statistik Penduduk</h4>
                </div>
                <div class="card-body p-5">
                    <div class="chart-container">
                        <div class="chart-header">
                            <h3 class="chart-title">Distribusi Penduduk per Dusun</h3>
                            <div class="chart-legend">
                                <div class="legend-item">
                                    <div class="legend-color" style="background: linear-gradient(135deg, #4e73df, #1cc88a);"></div>
                                    <span>Jumlah Penduduk</span>
                                </div>
                            </div>
                        </div>
                        <canvas id="populationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-header border-0">
                    <h4>Kalender</h4>
                </div>
                <div class="card-body p-3">
                    <div class="calendar-container">
                        <div class="calendar-header">
                            <h3 class="calendar-title" id="currentMonthYear">November 2023</h3>
                            <div class="calendar-nav">
                                <button class="calendar-nav-btn" id="prevMonth">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="calendar-nav-btn" id="nextMonth">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="calendar-weekdays">
                            <div class="weekday">Min</div>
                            <div class="weekday">Sen</div>
                            <div class="weekday">Sel</div>
                            <div class="weekday">Rab</div>
                            <div class="weekday">Kam</div>
                            <div class="weekday">Jum</div>
                            <div class="weekday">Sab</div>
                        </div>
                        <div class="calendar-days" id="calendarDays">
                            <!-- Calendar days will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PENGADUAN TERBARU & TAUTAN CEPAT --}}
    <div class="row">
        <div class="col-lg-7 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-header border-0">
                    <h4>Pengaduan Terbaru</h4>
                </div>
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
                                        <td colspan="4" class="text-center text-muted py-4">Belum ada data pengaduan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-header border-0">
                    <h4>Tautan Cepat</h4>
                </div>
                <div class="card-body quick-links">
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
document.addEventListener('DOMContentLoaded', function() {

    // === Ambil data dari controller ===
    const kegiatanDates = {!! json_encode($agendaDates ?? []) !!};
    const labelsPenduduk = {!! json_encode($labelsPenduduk ?? ['Sukamaju', 'Mihasa', 'Hannry', 'Antara']) !!};
    const dataPenduduk = {!! json_encode($dataPenduduk ?? [10, 8, 12, 9]) !!};

    // === Chart penduduk yang diperbarui ===
    const ctx = document.getElementById('populationChart').getContext('2d');

    // Gradien untuk chart
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(78, 115, 223, 0.8)');
    gradient.addColorStop(0.7, 'rgba(78, 115, 223, 0.4)');
    gradient.addColorStop(1, 'rgba(78, 115, 223, 0.1)');

    const gradientHover = ctx.createLinearGradient(0, 0, 0, 300);
    gradientHover.addColorStop(0, 'rgba(28, 200, 138, 0.8)');
    gradientHover.addColorStop(0.7, 'rgba(28, 200, 138, 0.4)');
    gradientHover.addColorStop(1, 'rgba(28, 200, 138, 0.1)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labelsPenduduk,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: dataPenduduk,
                backgroundColor: gradient,
                hoverBackgroundColor: gradientHover,
                borderRadius: 12,
                borderWidth: 0,
                barPercentage: 0.6,
                categoryPercentage: 0.7
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return `Jumlah Penduduk: ${context.parsed.y}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12
                        },
                        padding: 10
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        padding: 10
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            }
        }
    });

    // === Kalender Modern ===
    let currentDate = new Date();

    function renderCalendar(date) {
        const calendarDays = document.getElementById('calendarDays');
        const currentMonthYear = document.getElementById('currentMonthYear');

        const year = date.getFullYear();
        const month = date.getMonth();

        // Set month and year title
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                           "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        currentMonthYear.textContent = `${monthNames[month]} ${year}`;

        // Get first and last day of month
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const today = new Date();

        // Clear previous calendar
        calendarDays.innerHTML = '';

        // Add empty cells for days before the first day of month
        for (let i = 0; i < firstDay.getDay(); i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'calendar-day other-month';
            calendarDays.appendChild(emptyDay);
        }

        // Add days of the month
        for (let day = 1; day <= lastDay.getDate(); day++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            dayElement.textContent = day;

            // Check if today
            if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                dayElement.classList.add('today');
            }

            // Check if has event
            const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            if (kegiatanDates.includes(dateString)) {
                dayElement.classList.add('event');
                const eventDot = document.createElement('div');
                eventDot.className = 'event-dot';
                dayElement.appendChild(eventDot);
            }

            calendarDays.appendChild(dayElement);
        }
    }

    // Initialize calendar
    renderCalendar(currentDate);

    // Navigation buttons
    document.getElementById('prevMonth').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    document.getElementById('nextMonth').addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });
});
</script>
@endpush
@endsection
