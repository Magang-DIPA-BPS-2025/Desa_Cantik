{{-- resources/views/pages/landing/profildesa/APBDDesa.blade.php --}}
@extends('layouts.landing.app')

@section('content')
<style>
.apb-desa { background: #fff; padding: 60px 20px; }
.apb-container { display: flex; justify-content: space-between; gap: 40px; max-width: 1400px; margin: auto; flex-wrap: wrap; }
.apb-info { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; }
.apb-info h2 { color: #2e7d32; font-size: 38px; font-weight: 700; margin-bottom: 20px; text-align: center; }
.apb-right { flex: 1.2; min-width: 400px; }
.apb-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; }
.apb-card { border-radius: 12px; padding: 22px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); color: #fff; display: flex; flex-direction: column; align-items: center; justify-content: center; }
.apb-card h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; }
.apb-card p { font-size: 20px; font-weight: 700; margin: 0; }
.apb-card i { font-size: 26px; margin-bottom: 6px; }
.bg-green { background: #2e7d32; }
.bg-red { background: #d32f2f; }
.bg-blue { background: #1976d2; }
.bg-gray { background: #757575; }
.card-box { background: #fff; border-radius: 12px; padding: 24px; margin-bottom: 30px; margin-top: 40px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); }
.card-box h3 { font-size: 20px; font-weight: bold; color: #2e7d32; margin-bottom: 18px; display:flex; justify-content:space-between; align-items:center; }
canvas { max-height: 280px; width: 100% !important; }
.progress-card { background: #f9f9f9; border-radius: 12px; padding: 18px; margin-bottom: 18px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
.progress-label { display: flex; justify-content: space-between; font-size: 15px; font-weight: 600; margin-bottom: 6px; }
.progress-bar-bg { background: #e5e7eb; border-radius: 8px; height: 22px; overflow: hidden; }
.progress-bar-fill { height: 22px; text-align: center; font-size: 12px; line-height: 22px; color: #fff; font-weight: bold; }
.progress-bar-fill.green { background: #2e7d32; }
.progress-bar-fill.red { background: #d32f2f; }
.progress-bar-fill.blue { background: #1976d2; }

/* Gaya untuk dropdown download yang diperbaiki */
.download-dropdown {
    position: relative;
    display: inline-block;
}

.download-btn {
    background: #16a34a;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background 0.3s;
    white-space: nowrap;
}

.download-btn:hover {
    background: #15803d;
}

.download-btn i {
    font-size: 14px;
    color: #fff;
}

.download-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: #ffffff;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #e0e0e0;
}

.download-content a {
    color: #16a34a;
    padding: 12px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s;
    background: #fff;
}

.download-content a:last-child {
    border-bottom: none;
}

.download-content a:hover {
    background-color: #f8f9fa;
}

.download-content a i {
    color: #16a34a;
    width: 16px;
    text-align: center;
}

.download-dropdown:hover .download-content {
    display: block;
}

.filter-container { background: #f8f9fa; border-radius: 12px; padding: 20px; margin: 20px 0; box-shadow: 0 2px 8px rgba(0,0,0,0.05); max-width: 500px; width: 100%; }
.filter-title { font-size: 16px; font-weight: 600; color: #2e7d32; margin-bottom: 10px; text-align: center; }
.filter-controls { display: flex; gap: 10px; align-items: center; justify-content: center; flex-wrap: wrap; }
.filter-select { padding: 10px 15px; border-radius: 8px; border: 2px solid #e0e0e0; background: white; font-size: 14px; min-width: 120px; transition: border-color 0.3s; }
.filter-select:focus { border-color: #2e7d32; outline: none; }
.filter-btn { background: #2e7d32; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: background 0.3s; }
.filter-btn:hover { background: #1b5e20; }
.filter-btn.reset { background: #757575; }
.filter-btn.reset:hover { background: #5d5d5d; }
.no-data { text-align: center; padding: 40px; color: #757575; font-size: 16px; }
.year-badge { 
    background: #ffffffff; 
    color: #2e7d32; 
    padding: 5px 15px; 
    border-radius: 20px; 
    font-size: 20px; 
    margin-left: 10px; 
    vertical-align: middle;
}
.chart-container {
    position: relative;
    height: 300px;
    margin-bottom: 20px;
}

/* === RESPONSIVE FIX UNTUK TAMPILAN HP / LAYAR KECIL === */
@media (max-width: 768px) {
    .apb-container {
        flex-direction: column;
        align-items: center;
        text-align: left;
    }

    /* Judul di kiri saat HP */
    .apb-info h2 {
        text-align: left;
        font-size: 28px;
        width: 100%;
        display: flex;
        flex-direction: column;   /* bikin tahun turun ke bawah */
        align-items: center;      /* tahun jadi di tengah */
    }

    /* Tahun di bawah dan center */
    .year-badge {
        margin: 8px 0 0 0;        /* jarak dari judul */
        font-size: 18px;
        text-align: center;
    }

    /* Card tetap di tengah */
    .apb-right {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .apb-grid {
        justify-content: center;
    }

    .apb-card {
        width: 90%;
        max-width: 320px;
        margin: auto;
    }

    .card-box {
        width: 100%;
        text-align: center;
    }
    
    /* Responsif untuk dropdown */
    .download-dropdown {
        margin-top: 10px;
    }
    
    .download-content {
        right: auto;
        left: 0;
        min-width: 180px;
    }
    
    .card-box h3 {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}

/* Jika sidebar aktif, pastikan judul tetap kiri */
body.sidebar-active .apb-info h2 {
    text-align: left !important;
}

</style>

<div class="apb-desa">
    <div class="apb-container">
        {{-- Judul dan Filter --}}
        <div class="apb-info">
            <h2>
                APBD Desa Manggalung 
                <span class="year-badge">{{ $apbd->tahun ?? 'N/A' }}</span>
            </h2>
            
            {{-- Filter Section --}}
            <div class="filter-container">
                <div class="filter-title">Pilih Tahun APBD</div>
                <div class="filter-controls">
                    <select id="yearFilter" class="filter-select">
                        <option value="">Semua Tahun</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    @if($selectedYear)
                        <button id="resetFilter" class="filter-btn reset">
                            <i class="fas fa-refresh"></i> Reset
                        </button>
                    @endif
                </div>
                <div style="font-size: 12px; color: #666; text-align: center; margin-top: 8px;">
                    <i class="fas fa-info-circle"></i> Pilih tahun untuk melihat data APBD tahun tersebut
                </div>
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="apb-right">
            @if($apbd)
                <div class="apb-grid">
                    <div class="apb-card bg-green">
                        <i class="fas fa-wallet"></i>
                        <h3 style="color:white;">Total Pendapatan</h3>
                        <p>Rp{{ number_format($apbd->total_pendapatan ?? 0,0,',','.') }}</p>
                    </div>
                    <div class="apb-card bg-red">
                        <i class="fas fa-shopping-cart"></i>
                        <h3 style="color:white;">Total Belanja</h3>
                        <p>Rp{{ number_format($apbd->total_belanja ?? 0,0,',','.') }}</p>
                    </div>
                </div>

                <div class="apb-grid" style="margin-top:25px;">
                    <div class="apb-card bg-green">
                        <i class="fas fa-arrow-down"></i>
                        <h3 style="color:white;">Penerimaan</h3>
                        <p>Rp{{ number_format($apbd->penerimaan ?? 0,0,',','.') }}</p>
                    </div>

                    <div class="apb-card bg-red">
                        <i class="fas fa-arrow-up"></i>
                        <h3 style="color:white;">Pengeluaran</h3>
                        <p>Rp{{ number_format($apbd->pengeluaran ?? 0,0,',','.') }}</p>
                    </div>
                </div>

                <div class="apb-card bg-blue" style="margin-top:20px;">
                    <i class="fas fa-balance-scale"></i>
                    <h3 style="color:white;">Surplus/Defisit</h3>
                    <p>Rp{{ number_format($apbd->surplus_defisit ?? 0,0,',','.') }}</p>
                </div>

                @if(!empty($apbd->updated_at))
                    @php
                        $updated = \Carbon\Carbon::parse($apbd->updated_at)->setTimezone('Asia/Makassar')->format('d-m-Y H:i');
                    @endphp
                    <div class="apb-card bg-gray" style="margin-top:20px; text-align:center;">
                        <i class="fas fa-clock"></i>
                        <p style="margin-top:5px; font-size:16px; font-weight:600; color:#fff;">
                            Data diperbarui: {{ $updated }}
                        </p>
                    </div>
                @endif
            @else
                <div class="no-data">
                    <i class="fas fa-exclamation-circle" style="font-size: 48px; margin-bottom: 15px;"></i>
                    <p>Data APBD tidak tersedia untuk tahun yang dipilih.</p>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Bagian Chart & Progress --}}
@if($apbd)
<div class="container mx-auto px-6 mt-10">
    {{-- Pendapatan --}}
    <div class="card-box">
        <h3>
            Pendapatan Desa Tahun {{ $apbd->tahun }}
            <div class="download-dropdown">
                <button class="download-btn">
                    <i class="fas fa-download" style="color:white;"></i> Download Data
                </button>
                <div class="download-content">
                    <a href="#" onclick="downloadChart('chartPendapatan','Pendapatan_Desa_{{ $apbd->tahun }}.png')">
                        <i class="fas fa-chart-bar"></i> Download Grafik
                    </a>
                    <a href="#" onclick="downloadExcel('pendapatan', {{ $apbd->tahun }})">
                        <i class="fas fa-file-excel"></i> Download Excel</a>
                </div>
            </div>
        </h3>
        <div class="chart-container">
            <canvas id="chartPendapatan"></canvas>
        </div>

        @php
            $pendapatanData = [
                ['sumber' => 'PAD', 'jumlah' => $apbd->pendapatan_pad],
                ['sumber' => 'Transfer', 'jumlah' => $apbd->pendapatan_transfer],
                ['sumber' => 'Lainnya', 'jumlah' => $apbd->pendapatan_lain]
            ];
        @endphp
        @foreach($pendapatanData as $item)
            @php $persen = $apbd->total_pendapatan > 0 ? ($item['jumlah'] / $apbd->total_pendapatan) * 100 : 0; @endphp
            <div class="progress-card">
                <div class="progress-label">
                    <span>{{ $item['sumber'] }}</span>
                    <span>Rp{{ number_format($item['jumlah'],0,',','.') }}</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill green" style="width: {{ $persen }}%">
                        {{ number_format($persen,2) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Belanja --}}
    <div class="card-box">
        <h3>
            Belanja Desa Tahun {{ $apbd->tahun }}
            <div class="download-dropdown">
                <button class="download-btn">
                    <i class="fas fa-download" style="color:white;"></i> Download
                </button>
                <div class="download-content">
                    <a href="#" onclick="downloadChart('chartBelanja','Belanja_Desa_{{ $apbd->tahun }}.png')">
                        <i class="fas fa-chart-bar"></i> Download Grafik
                    </a>
                    <a href="#" onclick="downloadExcel('belanja', {{ $apbd->tahun }})">
                        <i class="fas fa-file-excel"></i> Download Excel
                    </a>
                </div>
            </div>
        </h3>
        <div class="chart-container">
            <canvas id="chartBelanja"></canvas>
        </div>
        @php
            $belanjaData = [
                ['bidang' => 'Pemerintahan', 'jumlah' => $apbd->belanja_pemerintahan],
                ['bidang' => 'Pembangunan', 'jumlah' => $apbd->belanja_pembangunan],
                ['bidang' => 'Pembinaan', 'jumlah' => $apbd->belanja_pembinaan],
                ['bidang' => 'Pemberdayaan', 'jumlah' => $apbd->belanja_pemberdayaan],
                ['bidang' => 'Bencana', 'jumlah' => $apbd->belanja_bencana]
            ];
        @endphp
        @foreach($belanjaData as $item)
            @php $persen = $apbd->total_belanja > 0 ? ($item['jumlah'] / $apbd->total_belanja) * 100 : 0; @endphp
            <div class="progress-card">
                <div class="progress-label">
                    <span>{{ $item['bidang'] }}</span>
                    <span>Rp{{ number_format($item['jumlah'],0,',','.') }}</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill red" style="width: {{ $persen }}%">
                        {{ number_format($persen,2) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pembiayaan --}}
    <div class="card-box">
        <h3>
            Pembiayaan Desa Tahun {{ $apbd->tahun }}
            <div class="download-dropdown">
                <button class="download-btn">
                    <i class="fas fa-download" style="color:white;"></i> Download
                </button>
                <div class="download-content">
                    <a href="#" onclick="downloadChart('chartPembiayaan','Pembiayaan_Desa_{{ $apbd->tahun }}.png')">
                        <i class="fas fa-chart-bar"></i> Download Grafik
                    </a>
                    <a href="#" onclick="downloadExcel('pembiayaan', {{ $apbd->tahun }})">
                        <i class="fas fa-file-excel"></i> Download Excel
                    </a>
                </div>
            </div>
        </h3>
        <div class="chart-container">
            <canvas id="chartPembiayaan"></canvas>
        </div>
        @php
            $pembiayaanData = [
                ['jenis' => 'Penerimaan', 'jumlah' => $apbd->pembiayaan_penerimaan],
                ['jenis' => 'Pengeluaran', 'jumlah' => $apbd->pembiayaan_pengeluaran]
            ];
            $totalPembiayaan = $apbd->pembiayaan_penerimaan + $apbd->pembiayaan_pengeluaran;
        @endphp
        @foreach($pembiayaanData as $item)
            @php $persen = $totalPembiayaan > 0 ? ($item['jumlah'] / $totalPembiayaan) * 100 : 0; @endphp
            <div class="progress-card">
                <div class="progress-label">
                    <span>{{ $item['jenis'] }}</span>
                    <span>Rp{{ number_format($item['jumlah'],0,',','.') }}</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill blue" style="width: {{ $persen }}%">
                        {{ number_format($persen,2) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
@if($apbd)
    // Pendapatan Chart - DIUBAH MENJADI DONUT CHART
    const ctxPendapatan = document.getElementById('chartPendapatan').getContext('2d');
    const pendapatanColors = [
        '#2e7d32', // Hijau utama - PAD
        '#4caf50', // Hijau medium - Transfer
        '#81c784'  // Hijau terang - Lainnya
    ];
    
    new Chart(ctxPendapatan, {
        type: 'doughnut',
        data: { 
            labels: @json(array_column($pendapatanData,'sumber')), 
            datasets: [{ 
                data: @json(array_column($pendapatanData,'jumlah')), 
                backgroundColor: pendapatanColors,
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 15
            }] 
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14,
                            weight: '600'
                        },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: { 
                    callbacks: { 
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(2);
                            return `${label}: Rp${value.toLocaleString('id-ID')} (${percentage}%)`;
                        } 
                    } 
                },
                title: {
                    display: true,
                    text: 'Pendapatan Desa Tahun {{ $apbd->tahun }}',
                    font: { size: 16, weight: 'bold' }
                }
            }
        }
    });

    // Belanja Chart - Tetap bar chart
    const ctxBelanja = document.getElementById('chartBelanja').getContext('2d');
    const belanjaColors = [
        '#d32f2f', // Merah utama
        '#f44336', // Merah medium
        '#e57373', // Merah terang
        '#ef5350', // Merah medium 2
        '#ff8a80'  // Merah terang 2
    ];
    
    new Chart(ctxBelanja, {
        type: 'bar',
        data: { 
            labels: @json(array_column($belanjaData,'bidang')), 
            datasets: [{ 
                data: @json(array_column($belanjaData,'jumlah')), 
                backgroundColor: belanjaColors, 
                borderRadius: 10,
                borderWidth: 1,
                borderColor: '#fff'
            }] 
        },
        options: { 
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false }, 
                tooltip: { 
                    callbacks: { 
                        label: function(ctx) {
                            return 'Rp' + ctx.raw.toLocaleString('id-ID');
                        } 
                    } 
                },
                title: {
                    display: true,
                    text: 'Belanja Desa Tahun {{ $apbd->tahun }}',
                    font: { size: 16, weight: 'bold' }
                }
            }, 
            scales: { 
                y: { 
                    beginAtZero: true,
                    ticks: { 
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString('id-ID');
                        } 
                    } 
                } 
            } 
        }
    });

    // Pembiayaan Chart - Tetap donut chart
    const ctxPembiayaan = document.getElementById('chartPembiayaan').getContext('2d');
    new Chart(ctxPembiayaan, {
        type: 'doughnut',
        data: { 
            labels: @json(array_column($pembiayaanData,'jenis')), 
            datasets: [{ 
                data: @json(array_column($pembiayaanData,'jumlah')), 
                backgroundColor: ['#1976d2', '#42a5f5'], // Warna biru yang konsisten
                borderWidth: 2, 
                borderColor: '#fff',
                hoverOffset: 15
            }] 
        },
        options: { 
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%', 
            plugins: { 
                legend: { 
                    position: 'bottom', 
                    labels: { 
                        font: { size: 14 },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    } 
                }, 
                tooltip: { 
                    callbacks: { 
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(2);
                            return `${label}: Rp${value.toLocaleString('id-ID')} (${percentage}%)`;
                        } 
                    } 
                },
                title: {
                    display: true,
                    text: 'Pembiayaan Desa Tahun {{ $apbd->tahun }}',
                    font: { size: 16, weight: 'bold' }
                }
            } 
        }
    });
@endif

// Download chart function
function downloadChart(canvasId, filename) {
    const canvas = document.getElementById(canvasId);
    const link = document.createElement('a');
    link.href = canvas.toDataURL('image/png');
    link.download = filename;
    link.click();
}

// Download Excel function
function downloadExcel(type, tahun) {
    // Membuat data untuk Excel berdasarkan tipe
    let data = [];
    let filename = '';
    
    if (type === 'pendapatan') {
        data = [
            ['Sumber Pendapatan', 'Jumlah (Rp)'],
            ['PAD', {{ $apbd->pendapatan_pad }}],
            ['Transfer', {{ $apbd->pendapatan_transfer }}],
            ['Lainnya', {{ $apbd->pendapatan_lain }}],
            ['Total Pendapatan', {{ $apbd->total_pendapatan }}]
        ];
        filename = `Pendapatan_Desa_${tahun}.xlsx`;
    } else if (type === 'belanja') {
        data = [
            ['Bidang Belanja', 'Jumlah (Rp)'],
            ['Pemerintahan', {{ $apbd->belanja_pemerintahan }}],
            ['Pembangunan', {{ $apbd->belanja_pembangunan }}],
            ['Pembinaan', {{ $apbd->belanja_pembinaan }}],
            ['Pemberdayaan', {{ $apbd->belanja_pemberdayaan }}],
            ['Bencana', {{ $apbd->belanja_bencana }}],
            ['Total Belanja', {{ $apbd->total_belanja }}]
        ];
        filename = `Belanja_Desa_${tahun}.xlsx`;
    } else if (type === 'pembiayaan') {
        data = [
            ['Jenis Pembiayaan', 'Jumlah (Rp)'],
            ['Penerimaan', {{ $apbd->pembiayaan_penerimaan }}],
            ['Pengeluaran', {{ $apbd->pembiayaan_pengeluaran }}],
            ['Total Pembiayaan', {{ $apbd->pembiayaan_penerimaan + $apbd->pembiayaan_pengeluaran }}]
        ];
        filename = `Pembiayaan_Desa_${tahun}.xlsx`;
    }
    
    // Membuat worksheet
    const ws = XLSX.utils.aoa_to_sheet(data);
    
    // Membuat workbook
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Data");
    
    // Download file
    XLSX.writeFile(wb, filename);
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const resetFilterBtn = document.getElementById('resetFilter');
    const yearFilter = document.getElementById('yearFilter');
    
    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', function() {
            window.location.href = "{{ route('apbd') }}";
        });
    }
    
    // Auto-apply filter when year selection changes
    if (yearFilter) {
        yearFilter.addEventListener('change', function() {
            const selectedYear = this.value;
            if (selectedYear) {
                window.location.href = "{{ route('apbd') }}?tahun=" + selectedYear;
            } else {
                window.location.href = "{{ route('apbd') }}";
            }
        });
    }
});
</script>

<!-- Tambahkan library untuk export Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
@endsection