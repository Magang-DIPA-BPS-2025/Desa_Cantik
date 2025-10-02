{{-- resources/views/pages/landing/profildesa/APBDDesa.blade.php --}}
@extends('layouts.landing.app')

@section('content')
<style>
.apb-desa {
    background: #fff;
    padding: 60px 20px;
}
.apb-container {
    display: flex;
    justify-content: space-between;
    gap: 40px;
    max-width: 1400px;
    margin: auto;
    flex-wrap: wrap;
}
.apb-info {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}
.apb-info h2 {
    color: #d32f2f;
    font-size: 38px;
    font-weight: 700;
}
.apb-right {
    flex: 1.2;
    min-width: 400px;
}
.apb-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}
.apb-card {
    border-radius: 12px;
    padding: 22px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.apb-card h3 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}
.apb-card p {
    font-size: 20px;
    font-weight: 700;
    margin: 0;
}
.apb-card i {
    font-size: 26px;
    margin-bottom: 6px;
}
/* Warna khusus */
.bg-green { background: #2e7d32; }
.bg-red { background: #d32f2f; }
.bg-blue { background: #1565c0; }

/* Card untuk grafik & progress */
.card-box {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 30px;
    margin-top: 40px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
.card-box h3 {
    font-size: 20px;
    font-weight: bold;
    color: #2e7d32;
    margin-bottom: 18px;
}
canvas { max-height: 280px; width: 100% !important; }

/* Progress bar */
.progress-card {
    background: #f9f9f9;
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 6px;
}
.progress-bar-bg {
    background: #e5e7eb;
    border-radius: 8px;
    height: 22px;
    overflow: hidden;
}
.progress-bar-fill {
    height: 22px;
    text-align: center;
    font-size: 12px;
    line-height: 22px;
    color: #fff;
    font-weight: bold;
    background: #2e7d32;
}
</style>

<div class="apb-desa">
    <div class="apb-container">
        {{-- Judul di kiri --}}
        <div class="apb-info">
            <h2>APB Desa Kersik Tahun {{ $apbd['tahun'] }}</h2>
        </div>

        {{-- Ringkasan di kanan --}}
        <div class="apb-right">
            <div class="apb-grid">
                <div class="apb-card bg-green">
                    <i class="fas fa-wallet"></i>
                    <h3>Pendapatan</h3>
                    <p>Rp{{ number_format($apbd['pendapatan'],0,',','.') }}</p>
                </div>
                <div class="apb-card bg-red">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Belanja</h3>
                    <p>Rp{{ number_format($apbd['belanja'],0,',','.') }}</p>
                </div>
            </div>

            <div class="apb-grid" style="margin-top:25px;">
                <div class="apb-card bg-green">
                    <i class="fas fa-arrow-down"></i>
                    <h3>Penerimaan</h3>
                    <p>Rp{{ number_format($pembiayaan[0]['jumlah'],0,',','.') }}</p>
                </div>
                <div class="apb-card bg-red">
                    <i class="fas fa-arrow-up"></i>
                    <h3>Pengeluaran</h3>
                    <p>Rp{{ number_format($pembiayaan[1]['jumlah'],0,',','.') }}</p>
                </div>
            </div>

            <div class="apb-card bg-blue" style="margin-top:20px;">
                <i class="fas fa-balance-scale"></i>
                <h3>Surplus/Defisit</h3>
                <p>Rp{{ number_format($apbd['surplus_defisit'],0,',','.') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Bagian Chart & Progress --}}
<div class="container mx-auto px-6 mt-10">

    {{-- Pendapatan --}}
    <div class="card-box">
        <h3>Pendapatan Desa</h3>
        <canvas id="chartPendapatan"></canvas>
        @foreach($pendapatan as $item)
            @php $persen = $apbd['pendapatan'] > 0 ? ($item['jumlah'] / $apbd['pendapatan']) * 100 : 0; @endphp
            <div class="progress-card">
                <div class="progress-label">
                    <span>{{ $item['sumber'] }}</span>
                    <span>Rp{{ number_format($item['jumlah'],0,',','.') }}</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $persen }}%">
                        {{ number_format($persen,2) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Belanja --}}
    <div class="card-box">
        <h3>Belanja Desa</h3>
        <canvas id="chartBelanja"></canvas>
        @foreach($belanja as $item)
            @php $persen = $apbd['belanja'] > 0 ? ($item['jumlah'] / $apbd['belanja']) * 100 : 0; @endphp
            <div class="progress-card">
                <div class="progress-label">
                    <span>{{ $item['bidang'] }}</span>
                    <span>Rp{{ number_format($item['jumlah'],0,',','.') }}</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $persen }}%">
                        {{ number_format($persen,2) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pembiayaan --}}
    <div class="card-box">
        <h3>Pembiayaan Desa</h3>
        <canvas id="chartPembiayaan"></canvas>
        @php $totalPembiayaan = array_sum(array_column($pembiayaan, 'jumlah')); @endphp
        @foreach($pembiayaan as $item)
            @php $persen = $totalPembiayaan > 0 ? ($item['jumlah'] / $totalPembiayaan) * 100 : 0; @endphp
            <div class="progress-card">
                <div class="progress-label">
                    <span>{{ $item['jenis'] }}</span>
                    <span>Rp{{ number_format($item['jumlah'],0,',','.') }}</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $persen }}%">
                        {{ number_format($persen,2) }}%
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
new Chart(document.getElementById('chartPendapatan'), {
    type: 'bar',
    data: {
        labels: @json(array_column($pendapatan, 'sumber')),
        datasets: [{
            label: 'Pendapatan',
            data: @json(array_column($pendapatan, 'jumlah')),
            backgroundColor: '#2e7d32'
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
});

new Chart(document.getElementById('chartBelanja'), {
    type: 'bar',
    data: {
        labels: @json(array_column($belanja, 'bidang')),
        datasets: [{
            label: 'Belanja',
            data: @json(array_column($belanja, 'jumlah')),
            backgroundColor: '#d32f2f'
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
});

new Chart(document.getElementById('chartPembiayaan'), {
    type: 'bar',
    data: {
        labels: @json(array_column($pembiayaan, 'jenis')),
        datasets: [{
            label: 'Pembiayaan',
            data: @json(array_column($pembiayaan, 'jumlah')),
            backgroundColor: '#d32f2f'
        }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
});
</script>
@endsection
