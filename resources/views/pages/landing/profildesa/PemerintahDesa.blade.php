@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Pemerintah Desa</title>

<div class="container py-5">

  <!-- =======================
       TUPOKSI PEMERINTAH DESA (DINAMIS)
  ========================== -->
  <h3 class="mb-4 text-dark fw-bold text-start">Tugas Pokok dan Fungsi Pemerintah Desa</h3>

  <div class="row justify-content-center gx-4 gy-5">
    @foreach($pemerintahDesas as $pd)
      <div class="col-12 col-sm-6 col-lg-4 mb-5 mt-3">
        <div class="card shadow-sm h-100 border-0 text-center p-4">
          <div class="p-3">
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
          <div class="card-body d-flex flex-column justify-content-center text-center">
            <h5 class="fw-bold text-success mb-1">{{ $pd->nama }}</h5>
            <p class="text-muted mb-2">{{ $pd->jabatan }}</p>
            <small class="text-secondary d-block">{{ $pd->tupoksi ?? '-' }}</small>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- =======================
       STRUKTUR DESA (STATIS, RESPONSIF)
  ========================== -->
  <div class="my-5">
  <h3 class="fw-bold text-dark text-start mb-4">Struktur Pemerintahan Desa</h3>
  <div class="table-responsive"> <!-- Sama container dengan kalender -->
    <img src="{{ asset('/landing/images/banner/desa.png') }}"
         alt="Struktur Pemerintahan Desa"
         class="img-fluid struktur-img-fullwidth">
  </div>
</div>

<!-- =======================
       KALENDER AGENDA KEGIATAN (DINAMIS)
  ========================== -->
<div class="mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-success text-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="mb-0 fw-bold">
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
                                                                    @if($index < 3) {{-- Maksimal 3 dot --}}
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
                        <span class="legend-item me-3">
                            <span class="legend-color today-legend"></span>
                            <small>Hari Ini</small>
                        </span>
                        <span class="legend-item me-3">
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
                <h5 class="modal-title" id="eventModalTitle">
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

<style>
.calendar-table {
    border: none;
    background: white;
}

.calendar-header th {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    font-weight: 600;
    font-size: 0.9rem;
}

.calendar-day {
    border: 1px solid #e9ecef;
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
    border: 2px solid #ffc107;
}

.calendar-day.has-event {
    background: linear-gradient(135deg, #e8f5e8, #d4edda);
    border-left: 4px solid #28a745;
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
    color: #495057;
}

.today-badge {
    background: #ffc107;
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
    background: #28a745;
    border-radius: 50%;
    display: inline-block;
}

.event-dot-more {
    width: 8px;
    height: 8px;
    background: #6c757d;
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
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    display: inline-block;
}

.today-legend {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    border: 2px solid #ffc107;
}

.event-legend {
    background: linear-gradient(135deg, #e8f5e8, #d4edda);
    border-left: 4px solid #28a745;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
}

.day-label {
    font-weight: 600;
    font-size: 0.85rem;
}

/* Event List Styles */
.event-list-item {
    border-left: 4px solid #28a745;
    background: #f8f9fa;
    margin-bottom: 10px;
    border-radius: 8px;
    padding: 15px;
    transition: all 0.3s ease;
}

.event-list-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.event-date {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 5px;
}

.event-title {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.event-description {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0;
}

.no-events {
    text-align: center;
    padding: 40px 20px;
    color: #6c757d;
}

.no-events i {
    font-size: 3rem;
    margin-bottom: 15px;
    color: #dee2e6;
}

@media (max-width: 768px) {
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
        padding: 10px;
    }
}
</style>

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
                <h6 class="text-success">${formattedDate}</h6>
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
                <h6 class="text-muted mt-3">Tidak Ada Kegiatan</h6>
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

{{-- =======================
     STYLE TAMBAHAN
======================= --}}
<style>
  .struktur-img-responsive {
      width: 100%;          /* Memenuhi lebar container */
      max-width: 1000px;    /* Tidak melebar melebihi max */
      height: auto;         /* Pertahankan rasio asli */
      display: block;
      margin: 0 auto;       /* Centering horizontal */
  }

  .struktur-img-fullwidth {
    width: 100%;   /* Penuhi lebar container table-responsive */
    height: auto;  /* Pertahankan rasio asli */
    display: block;
}

  @media (max-width: 768px) {
      .struktur-img-responsive {
          width: 100%;      /* Pastikan lebar penuh di mobile */
          max-width: 100%;  /* Tidak ada batasan */
          height: auto;
      }
  }
</style>
@endsection
