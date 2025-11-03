@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Pemerintah Desa</title>

<style>
/* TERAPKAN STYLING SAMA PERSIS DENGAN HALAMAN BERITA */

/* Font modern sama seperti halaman berita */
body, .container-main, .gallery-card, .card, .calendar-table, .modal-content, .table {
    font-family: 'Open Sans', sans-serif;
}

h1, h2, h3, h4, h5, h6, .gallery-title, .card-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

body { 
    color: #000; 
    background: #f8fafc; 
}

.container-main { 
    max-width: 1400px; 
    margin: auto; 
    padding: 20px; 
}

/* PERBAIKAN: Header - SAMA PERSIS dengan halaman berita */
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

/* Container utama */
.pemerintah-section {
    margin-top: 2rem;
}

/* Card utama - SAMA PERSIS dengan card berita */
.gallery-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease;
    border: none;
    padding: 30px;
}

.gallery-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* Card untuk perangkat desa */
.card {
    border-radius: 14px;
    transition: all 0.3s ease;
    border: none;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    height: 100%;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

.card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.card img.rounded-circle {
    border: 3px solid #e5e7eb;
    transition: all 0.3s ease;
}

.card:hover img.rounded-circle {
    border-color: #16a34a;
    transform: scale(1.05);
}

/* Grid untuk perangkat desa */
.perangkat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-top: 1rem;
}

/* Kalender Styles */
.calendar-table {
    border: none;
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

.calendar-header th {
    background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
    color: white;
    border: none;
    font-weight: 600;
    font-size: 0.9rem;
}

.calendar-day {
    border: 1px solid #e5e7eb;
    height: 100px;
    vertical-align: top;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    background: white;
}

.calendar-day:hover {
    background: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.calendar-day.empty-day {
    background: #f8f9fa;
    cursor: default;
}

.calendar-day.empty-day:hover {
    background: #f8f9fa;
    transform: none;
    box-shadow: none;
}

.calendar-day.today {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border: 2px solid #f59e0b;
}

.calendar-day.has-event {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-left: 4px solid #16a34a;
}

.day-content {
    padding: 8px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.day-number {
    font-weight: 600;
    font-size: 1.1rem;
    color: #374151;
}

.today-badge {
    background: #f59e0b;
    color: white;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.event-indicator {
    display: flex;
    justify-content: center;
    margin-top: auto;
}

.event-dots {
    display: flex;
    gap: 3px;
    flex-wrap: wrap;
    justify-content: center;
}

.event-dot {
    width: 8px;
    height: 8px;
    background: #16a34a;
    border-radius: 50%;
    display: inline-block;
}

.event-dot-more {
    width: 8px;
    height: 8px;
    background: #6b7280;
    border-radius: 50%;
    display: inline-block;
    font-size: 0.6rem;
    color: white;
    text-align: center;
    line-height: 8px;
}

.calendar-legend {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-right: 20px;
    margin-bottom: 5px;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    display: inline-block;
}

.today-legend {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border: 2px solid #f59e0b;
}

.event-legend {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-left: 4px solid #16a34a;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%) !important;
}

.day-label {
    font-weight: 600;
    font-size: 0.85rem;
}

/* Event List Styles */
.event-list-item {
    border-left: 4px solid #16a34a;
    background: #f9fafb;
    margin-bottom: 12px;
    border-radius: 8px;
    padding: 15px;
    transition: all 0.3s ease;
}

.event-list-item:hover {
    background: #f3f4f6;
    transform: translateX(5px);
}

.event-date {
    font-size: 0.9rem;
    color: #6b7280;
    margin-bottom: 5px;
    font-weight: 500;
}

.event-title {
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.event-description {
    font-size: 0.9rem;
    color: #6b7280;
    margin-bottom: 0;
    line-height: 1.5;
}

.no-events {
    text-align: center;
    padding: 40px 20px;
    color: #6b7280;
}

.no-events i {
    font-size: 3rem;
    margin-bottom: 15px;
    color: #d1d5db;
}

/* Struktur Image Styles */
.struktur-img-fullwidth {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Form Styles */
.input-group {
    border-radius: 10px;
}

.form-select {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    font-family: 'Open Sans', sans-serif;
}

.form-select:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.15);
}

.input-group-text {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-right: none;
}

/* Modal Styles */
.modal-content {
    border-radius: 14px;
    border: none;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.modal-header {
    border-radius: 14px 14px 0 0;
    border-bottom: 1px solid #e5e7eb;
}

/* PERBAIKAN: Responsive design SAMA PERSIS dengan halaman berita */
@media (max-width: 1200px) {
    .perangkat-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }
}

@media (max-width: 992px) { 
    .perangkat-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .calendar-day {
        height: 90px;
    }
}

@media (max-width: 768px) {
    .gallery-title { 
        font-size: 2.2rem; 
    }
    
    .container-main {
        padding: 15px;
    }
    
    .gallery-card {
        padding: 20px;
    }
    
    .gallery-header {
        margin-top: 0rem;
    }
    
    .calendar-day {
        height: 80px;
        padding: 4px;
    }
    
    .day-number {
        font-size: 0.9rem;
    }
    
    .event-dot {
        width: 6px;
        height: 6px;
    }
    
    .calendar-header th {
        font-size: 0.8rem;
        padding: 8px 4px;
    }
    
    .event-list-item {
        padding: 12px;
    }
    
    .perangkat-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

@media (max-width: 576px) {
    .gallery-title { 
        font-size: 1.8rem; 
    }
    
    .gallery-header p {
        font-size: 1rem;
    }
    
    .gallery-card {
        padding: 15px;
    }
    
    .calendar-day {
        height: 70px;
    }
    
    .card-body {
        padding: 15px;
    }
    
    .legend-item {
        margin-right: 15px;
    }
}
</style>

<div class="container-main">
    <!-- =======================
         TUPOKSI PEMERINTAH DESA (DINAMIS)
    ========================== -->
    <div class="text-start mb-4 mt-2 px-2 gallery-header">
        <h2 class="fw-semibold display-4 mb-2 gallery-title">
            TUGAS POKOK DAN FUNGSI PEMERINTAH DESA
        </h2>
        <p class="text-secondary fs-5 mb-0">
            Mengetahui struktur dan tanggung jawab perangkat desa dalam melayani masyarakat
        </p>
    </div>

    <div class="pemerintah-section">
        <div class="perangkat-grid">
            @foreach($pemerintahDesas as $pd)
                <div class="card">
                    <div class="p-4 text-center">
                        @if($pd->foto)
                            <img src="{{ asset('storage/' . $pd->foto) }}"
                                alt="{{ $pd->nama }}"
                                class="rounded-circle mx-auto d-block"
                                style="width:120px; height:120px; object-fit:cover;">
                        @else
                            <img src="{{ asset('img/default-user.png') }}"
                                alt="Default"
                                class="rounded-circle mx-auto d-block"
                                style="width:120px; height:120px; object-fit:cover;">
                        @endif
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-semibold text-success mb-2">{{ $pd->nama }}</h5>
                        <p class="text-muted mb-3">{{ $pd->jabatan }}</p>
                        <small class="text-secondary">{{ $pd->tupoksi ?? 'Tugas pokok dan fungsi belum ditentukan' }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- =======================
         STRUKTUR DESA (STATIS, RESPONSIF)
    ========================== -->
    <div class="pemerintah-section">
        <div class="text-start mb-4 mt-2 px-2 gallery-header">
            <h2 class="fw-semibold display-4 mb-2 gallery-title">
                STRUKTUR PEMERINTAHAN DESA
            </h2>
            <p class="text-secondary fs-5 mb-0">
                Memahami hierarki dan hubungan kerja dalam pemerintahan desa
            </p>
        </div>
        
        <div class="gallery-card">
            <div class="text-center">
                <img src="{{ asset('/landing/images/banner/desa.png') }}"
                    alt="Struktur Pemerintahan Desa"
                    class="struktur-img-fullwidth">
            </div>
        </div>
    </div>

    <!-- =======================
         KALENDER AGENDA KEGIATAN (DINAMIS)
    ========================== -->
    <div class="pemerintah-section">
        <div class="text-start mb-4 mt-2 px-2 gallery-header">
            <h2 class="fw-semibold display-4 mb-2 gallery-title">
                KALENDER KEGIATAN DESA
            </h2>
            <p class="text-secondary fs-5 mb-0">
                Mengetahui jadwal kegiatan dan agenda desa secara terupdate
            </p>
        </div>

        <div class="gallery-card">
            <div class="card-header bg-gradient-success text-white py-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="mb-0 fw-semibold">
                            <i class="fas fa-calendar-alt me-2"></i>Kalender Kegiatan Desa
                        </h3>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <form method="GET" class="d-flex justify-content-end align-items-center gap-2 flex-wrap">
                            <div class="input-group input-group-sm" style="width: auto;">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-calendar text-success"></i>
                                </span>
                                <select name="month" class="form-select border-start-0" onchange="this.form.submit()" style="min-width: 140px;">
                                    @for($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="input-group input-group-sm" style="width: auto;">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-clock text-success"></i>
                                </span>
                                <select name="year" class="form-select border-start-0" onchange="this.form.submit()" style="min-width: 100px;">
                                    @for($y = date('Y') - 2; $y <= date('Y') + 2; $y++)
                                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 calendar-table">
                        <thead class="calendar-header">
                            <tr>
                                @foreach(['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                                    <th class="text-center py-3">
                                        <div class="day-label">{{ $day }}</div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $day = 1;
                                $totalCells = ceil(($daysInMonth + $startDayOfWeek) / 7) * 7;
                                $currentDate = date('Y-m-d');
                            @endphp
                            
                            @for($week = 0; $week < 6; $week++)
                                @if($day <= $daysInMonth)
                                    <tr class="calendar-week">
                                        @for($dow = 0; $dow < 7; $dow++)
                                            @php
                                                $cellIndex = $week * 7 + $dow;
                                                $isEmpty = $cellIndex < $startDayOfWeek || $day > $daysInMonth;
                                                
                                                if (!$isEmpty) {
                                                    $dateString = sprintf('%04d-%02d-%02d', $year, $month, $day);
                                                    $isToday = $dateString === $currentDate;
                                                    $hasEvent = isset($events[$dateString]);
                                                    $dayEvents = $hasEvent ? $events[$dateString] : [];
                                                }
                                            @endphp

                                            @if($isEmpty)
                                                <td class="calendar-day empty-day">
                                                    <div class="day-content">
                                                        &nbsp;
                                                    </div>
                                                </td>
                                            @else
                                                <td class="calendar-day {{ $isToday ? 'today' : '' }} {{ $hasEvent ? 'has-event' : '' }}"
                                                    onclick="showEvents('{{ $dateString }}', {{ $day }}, {{ $month }}, {{ $year }}, {{ json_encode($dayEvents) }})">
                                                    <div class="day-content">
                                                        <div class="day-number {{ $isToday ? 'today-badge' : '' }}">
                                                            {{ $day }}
                                                        </div>
                                                        @if($hasEvent)
                                                            <div class="event-indicator">
                                                                <div class="event-dots">
                                                                    @foreach($dayEvents as $index => $event)
                                                                        @if($index < 3)
                                                                            <div class="event-dot"></div>
                                                                        @endif
                                                                    @endforeach
                                                                    @if(count($dayEvents) > 3)
                                                                        <div class="event-dot-more">+</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                @php $day++; @endphp
                                            @endif
                                        @endfor
                                    </tr>
                                @endif
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-light py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="calendar-legend">
                            <span class="legend-item">
                                <span class="legend-color today-legend"></span>
                                <small>Hari Ini</small>
                            </span>
                            <span class="legend-item">
                                <span class="legend-color event-legend"></span>
                                <small>Ada Kegiatan</small>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Klik pada tanggal untuk melihat detail kegiatan
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Event Details -->
    <div class="modal fade" id="eventModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-success text-white">
                    <h5 class="modal-title fw-semibold" id="eventModalTitle">
                        <i class="fas fa-calendar-day me-2"></i>Detail Kegiatan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="eventModalBody">
                    <!-- Content will be loaded via JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showEvents(dateString, day, month, year, dayEvents) {
    // Format tanggal untuk ditampilkan
    const date = new Date(dateString);
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = date.toLocaleDateString('id-ID', options);
    
    let eventContent = '';
    
    if (dayEvents && dayEvents.length > 0) {
        eventContent = `
            <div class="text-center mb-4">
                <h6 class="text-success fw-semibold">${formattedDate}</h6>
                <p class="text-muted mb-0">${dayEvents.length} kegiatan ditemukan</p>
            </div>
            <div class="events-list">
        `;
        
        dayEvents.forEach(event => {
            // Gunakan nama_kegiatan dari data event
            const eventName = event.nama_kegiatan || event.judul_kegiatan || 'Kegiatan';
            const eventDescription = event.deskripsi || event.keterangan || '';
            const eventTime = event.waktu || event.jam || 'Sepanjang Hari';
            
            eventContent += `
                <div class="event-list-item">
                    <div class="event-date">
                        <i class="fas fa-clock me-1"></i>
                        ${eventTime}
                    </div>
                    <div class="event-title">
                        <i class="fas fa-calendar-check me-2 text-success"></i>
                        ${eventName}
                    </div>
                    ${eventDescription ? `
                        <div class="event-description">
                            ${eventDescription}
                        </div>
                    ` : ''}
                </div>
            `;
        });
        
        eventContent += '</div>';
    } else {
        eventContent = `
            <div class="no-events">
                <i class="fas fa-calendar-times"></i>
                <h6 class="text-muted mt-3 fw-semibold">Tidak Ada Kegiatan</h6>
                <p class="text-muted">Tidak ada kegiatan yang dijadwalkan pada tanggal ${formattedDate}</p>
            </div>
        `;
    }
    
    document.getElementById('eventModalTitle').innerHTML = `<i class="fas fa-calendar-day me-2"></i>Kegiatan ${formattedDate}`;
    document.getElementById('eventModalBody').innerHTML = eventContent;
    
    const modal = new bootstrap.Modal(document.getElementById('eventModal'));
    modal.show();
}
</script>
@endsection