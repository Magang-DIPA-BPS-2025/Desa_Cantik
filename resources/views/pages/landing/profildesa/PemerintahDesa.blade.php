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

/* PERBAIKAN: Tambahkan jarak khusus antara TUPOKSI dan STRUKTUR */
.tupoksi-section {
    margin-bottom: 5rem; /* Jarak yang lebih besar antara TUPOKSI dan STRUKTUR */
}

.struktur-section {
    margin-bottom: 4rem; /* Jarak antara STRUKTUR dan KALENDER */
}

.kalender-section {
    margin-top: 3rem; /* Jarak tambahan untuk kalender */
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

/* PERBAIKAN: Card untuk perangkat desa - HILANGKAN EFEK HIJAU SAAT DIKLIK */
.card {
    border-radius: 14px;
    transition: all 0.3s ease;
    border: none;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    height: 100%;
    cursor: pointer; /* Tambahkan pointer untuk gambar yang bisa diklik */
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
    cursor: pointer; /* Pointer untuk gambar yang bisa diklik */
}

/* PERBAIKAN: Hilangkan efek hijau saat hover */
.card:hover img.rounded-circle {
    border-color: #e5e7eb; /* Tetap warna abu-abu, bukan hijau */
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

/* PERBAIKAN: Styling untuk input group dan icon dengan jarak yang tepat */
.input-group {
    border-radius: 10px;
    display: flex;
    align-items: center;
}

.form-select {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    font-family: 'Open Sans', sans-serif;
    padding: 8px 12px;
}

.form-select:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.15);
}

.input-group-text {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-right: none;
    padding: 8px 12px;
}

/* PERBAIKAN: Jarak yang tepat untuk icon di input group */
.input-group .input-group-text i {
    margin-right: 8px; /* Jarak antara icon dan teks */
    color: #16a34a;
}

/* PERBAIKAN: Modal Styles dengan tombol close yang berfungsi */
.modal-content {
    border-radius: 14px;
    border: none;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.modal-header {
    border-radius: 14px 14px 0 0;
    border-bottom: 1px solid #e5e7eb;
    background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
    color: white;
    position: relative;
    padding: 20px;
}

.modal-header .modal-title {
    font-weight: 600;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
}

/* PERBAIKAN: Jarak untuk icon di modal title */
.modal-header .modal-title i {
    margin-right: 12px; /* Jarak yang lebih besar antara icon dan teks */
}

/* PERBAIKAN: PERUBAHAN UTAMA - Tombol close modal warna hitam */
.modal-header .btn-close {
    filter: none; /* Hapus filter putih */
    opacity: 0.8;
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
    border: none;
    padding: 12px;
    margin: 0;
    position: static;
}

.modal-header .btn-close:hover {
    opacity: 1;
    background-color: rgba(255,255,255,0.3);
    border-radius: 4px;
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    border-top: 1px solid #e5e7eb;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 0 0 14px 14px;
}

/* PERBAIKAN: Tombol tutup di modal footer */
.modal-footer .btn {
    padding: 10px 25px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    transition: all 0.2s ease;
    min-width: 100px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-footer .btn-secondary {
    background: #6c757d;
    color: white;
}

.modal-footer .btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* PERBAIKAN: Jarak untuk icon di tombol footer */
.modal-footer .btn i {
    margin-right: 8px;
}

/* Struktur Image Styles */
.struktur-img-fullwidth {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* PERBAIKAN: Jarak untuk semua icon di kalender */
.calendar-header-icon {
    margin-right: 10px;
}

.calendar-info-icon {
    margin-right: 8px;
}

.event-item-icon {
    margin-right: 10px;
}

/* PERBAIKAN: Styling untuk kalender control yang baru */
.calendar-control {
    background: white;
    border-radius: 10px;
    padding: 8px 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.calendar-control i {
    color: #16a34a;
}

.calendar-control select {
    border: none;
    background: transparent;
    font-weight: 500;
    color: #374151;
    cursor: pointer;
    outline: none;
}

.calendar-control select:focus {
    box-shadow: none;
}

/* PERBAIKAN: Styling untuk modal gambar TUPOKSI */
.image-modal .modal-dialog {
    max-width: 90%;
    max-height: 90vh;
}

.image-modal .modal-content {
    background: transparent;
    border: none;
    box-shadow: none;
}

.image-modal .modal-body {
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0,0,0,0.8);
}

.image-modal .modal-body img {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 8px;
}

/* PERBAIKAN: PERUBAHAN UTAMA - Tombol X warna hitam untuk modal gambar */
.image-modal .btn-close {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.9;
    filter: none; /* Hapus filter putih */
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
    background-size: 1.2em;
    background-position: center;
    background-repeat: no-repeat;
    border: 2px solid rgba(0,0,0,0.1);
}

.image-modal .btn-close:hover {
    opacity: 1;
    background-color: white;
    border-color: rgba(0,0,0,0.2);
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
    
    /* PERBAIKAN: Jarak yang lebih kecil di tablet */
    .tupoksi-section {
        margin-bottom: 4rem;
    }
    
    .struktur-section {
        margin-bottom: 3rem;
    }
    
    .kalender-section {
        margin-top: 2.5rem;
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
    
    /* PERBAIKAN: Jarak icon di mobile */
    .modal-header .modal-title i {
        margin-right: 8px;
    }
    
    .input-group .input-group-text i {
        margin-right: 6px;
    }
    
    /* PERBAIKAN: Jarak yang lebih kecil di mobile */
    .tupoksi-section {
        margin-bottom: 3rem;
    }
    
    .struktur-section {
        margin-bottom: 2.5rem;
    }
    
    .kalender-section {
        margin-top: 2rem;
    }
    
    /* PERBAIKAN: Kalender control di mobile */
    .calendar-control {
        flex-direction: column;
        gap: 8px;
        padding: 10px;
    }
    
    .calendar-control select {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .gallery-title { 
        font-size: 1.8rem; 
    }
    
    .gallery-header p {
        font-size: 1rem;
    }
    
    .container-main {
        padding: 10px;
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
    
    /* PERBAIKAN: Jarak icon di mobile kecil */
    .modal-header .modal-title i {
        margin-right: 6px;
    }
    
    .input-group .input-group-text i {
        margin-right: 4px;
    }
    
    /* PERBAIKAN: Jarak yang lebih kecil di mobile kecil */
    .tupoksi-section {
        margin-bottom: 2.5rem;
    }
    
    .struktur-section {
        margin-bottom: 2rem;
    }
    
    .kalender-section {
        margin-top: 1.5rem;
    }
    
    /* PERBAIKAN: Modal gambar di mobile */
    .image-modal .modal-dialog {
        max-width: 95%;
    }
    
    .image-modal .btn-close {
        width: 35px;
        height: 35px;
        top: 10px;
        right: 10px;
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

    <!-- PERBAIKAN: Tambahkan class tupoksi-section di sini -->
    <div class="pemerintah-section tupoksi-section">
        <div class="perangkat-grid">
            @foreach($pemerintahDesas as $pd)
                <div class="card" onclick="showImageModal('{{ $pd->nama }}', '{{ $pd->foto ? asset('storage/' . $pd->foto) : asset('img/default-user.png') }}')">
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
    <div class="pemerintah-section struktur-section">
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
    <div class="pemerintah-section kalender-section">
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
                            <!-- PERBAIKAN: Jarak icon dengan class khusus -->
                            <i class="fas fa-calendar-alt calendar-header-icon"></i>Kalender Kegiatan Desa
                        </h3>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <!-- PERBAIKAN: Ganti dengan kalender control yang baru -->
                        <form method="GET" class="d-flex justify-content-end">
                            <div class="calendar-control">
                                <i class="fas fa-calendar"></i>
                                <select name="month" onchange="this.form.submit()">
                                    @for($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                                <select name="year" onchange="this.form.submit()">
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
                            <!-- PERBAIKAN: Jarak icon dengan class khusus -->
                            <i class="fas fa-info-circle calendar-info-icon"></i>
                            Klik pada tanggal untuk melihat detail kegiatan
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PERBAIKAN: Modal for Event Details dengan tombol close warna hitam -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-success text-white">
                    <h5 class="modal-title fw-semibold" id="eventModalTitle">
                        <!-- PERBAIKAN: Jarak icon dengan styling CSS -->
                        <i class="fas fa-calendar-day"></i>
                        <span>Detail Kegiatan</span>
                    </h5>
                    <!-- PERBAIKAN: Tombol X warna hitam yang berfungsi dengan onclick -->
                    <button type="button" class="btn-close" onclick="closeEventModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="eventModalBody">
                    <!-- Content will be loaded via JavaScript -->
                </div>
                <div class="modal-footer">
                    <!-- PERBAIKAN: Tombol tutup dengan onclick -->
                    <button type="button" class="btn btn-secondary" onclick="closeEventModal()">
                        <i class="fas fa-times"></i>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- PERBAIKAN: Modal for Image Popup dengan tombol X warna hitam -->
    <div class="modal fade image-modal" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" onclick="closeImageModal()" aria-label="Close"></button>
                <div class="modal-body p-0">
                    <img id="modalImage" src="" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// PERBAIKAN: Inisialisasi modal dengan cara yang benar
let eventModal = null;
let imageModal = null;

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Initializing modals...');
    
    // Inisialisasi modal event
    const eventModalElement = document.getElementById('eventModal');
    if (eventModalElement) {
        eventModal = new bootstrap.Modal(eventModalElement);
        console.log('Event modal initialized successfully');
        
        // PERBAIKAN: Tambahkan event listener untuk tombol close
        const closeButtons = eventModalElement.querySelectorAll('[data-bs-dismiss="modal"], .btn-close, .btn-secondary');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (eventModal) {
                    eventModal.hide();
                }
            });
        });
    } else {
        console.error('Event modal element not found');
    }
    
    // Inisialisasi modal gambar
    const imageModalElement = document.getElementById('imageModal');
    if (imageModalElement) {
        imageModal = new bootstrap.Modal(imageModalElement);
        console.log('Image modal initialized successfully');
        
        // PERBAIKAN: Tambahkan event listener untuk tombol close
        const closeImageButtons = imageModalElement.querySelectorAll('[data-bs-dismiss="modal"], .btn-close');
        closeImageButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (imageModal) {
                    imageModal.hide();
                }
            });
        });
    } else {
        console.error('Image modal element not found');
    }
});

function showEvents(dateString, day, month, year, dayEvents) {
    console.log('Showing events for:', dateString);
    
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
            const eventLocation = event.lokasi || '';
            
            eventContent += `
                <div class="event-list-item">
                    <div class="event-date">
                        <i class="fas fa-clock event-item-icon text-success"></i>
                        ${eventTime}
                        ${eventLocation ? ` • <i class="fas fa-map-marker-alt event-item-icon text-success"></i>${eventLocation}` : ''}
                    </div>
                    <div class="event-title">
                        <i class="fas fa-calendar-check event-item-icon text-success"></i>
                        ${eventName}
                    </div>
                    ${eventDescription ? `
                        <div class="event-description mt-2">
                            <i class="fas fa-info-circle event-item-icon text-muted"></i>
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
                <i class="fas fa-calendar-times text-muted" style="font-size: 4rem;"></i>
                <h6 class="text-muted mt-3 fw-semibold">Tidak Ada Kegiatan</h6>
                <p class="text-muted">Tidak ada kegiatan yang dijadwalkan pada tanggal ${formattedDate}</p>
            </div>
        `;
    }
    
    // PERBAIKAN: Update modal title dengan jarak icon yang tepat
    document.getElementById('eventModalTitle').innerHTML = `
        <i class="fas fa-calendar-day"></i>
        <span>Kegiatan ${formattedDate}</span>
    `;
    document.getElementById('eventModalBody').innerHTML = eventContent;
    
    // PERBAIKAN: Show modal dengan instance yang sudah diinisialisasi
    if (eventModal) {
        eventModal.show();
    } else {
        // Fallback jika modal belum diinisialisasi
        const modalElement = document.getElementById('eventModal');
        if (modalElement) {
            eventModal = new bootstrap.Modal(modalElement);
            eventModal.show();
        }
    }
}

// PERBAIKAN: Fungsi untuk menampilkan modal gambar
function showImageModal(name, imageSrc) {
    console.log('Showing image modal for:', name);
    
    // Set gambar dan alt text
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalImage').alt = name;
    
    // PERBAIKAN: Show modal dengan instance yang sudah diinisialisasi
    if (imageModal) {
        imageModal.show();
    } else {
        // Fallback jika modal belum diinisialisasi
        const modalElement = document.getElementById('imageModal');
        if (modalElement) {
            imageModal = new bootstrap.Modal(modalElement);
            imageModal.show();
        }
    }
}

// PERBAIKAN: Fungsi untuk menutup modal yang lebih robust
function closeEventModal() {
    console.log('Closing event modal');
    
    if (eventModal) {
        eventModal.hide();
    } else {
        // Fallback manual
        const modalElement = document.getElementById('eventModal');
        if (modalElement) {
            // Tambahkan class untuk hide modal
            modalElement.classList.remove('show');
            modalElement.style.display = 'none';
            modalElement.style.background = 'transparent';
            
            // Hapus backdrop jika ada
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            
            // Hapus class dari body
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '0';
        }
    }
}

// PERBAIKAN: Fungsi untuk menutup modal gambar
function closeImageModal() {
    console.log('Closing image modal');
    
    if (imageModal) {
        imageModal.hide();
    } else {
        // Fallback manual
        const modalElement = document.getElementById('imageModal');
        if (modalElement) {
            // Tambahkan class untuk hide modal
            modalElement.classList.remove('show');
            modalElement.style.display = 'none';
            modalElement.style.background = 'transparent';
            
            // Hapus backdrop jika ada
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            
            // Hapus class dari body
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '0';
        }
    }
}

// PERBAIKAN: Tambahkan event listener untuk escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeEventModal();
        closeImageModal();
    }
});
</script>

<!-- PERBAIKAN: Pastikan Bootstrap JS sudah dimuat -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection 