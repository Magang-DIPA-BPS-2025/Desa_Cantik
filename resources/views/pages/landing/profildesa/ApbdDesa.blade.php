{{-- resources/views/pages/landing/profildesa/APBDDesa.blade.php --}}
@extends('layouts.landing.app')

@section('content')
<style>
.apb-desa { background: #fff; padding: 60px 20px; }
.apb-container { display: flex; justify-content: space-between; gap: 40px; max-width: 1400px; margin: auto; flex-wrap: wrap; }
.apb-info { flex: 1; display: flex; align-items: center; justify-content: center; }
.apb-info h2 { color: #d32f2f; font-size: 38px; font-weight: 700; }
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
.download-btn { background:#16a34a; color:#fff; padding:6px 12px; border:none; border-radius:6px; cursor:pointer; font-size:14px; margin-left:10px; }
</style>

<div class="apb-desa">
    <div class="apb-container">
        {{-- Judul --}}
        <div class="apb-info">
            <h2>APB Desa Kersik Tahun {{ $apbd->tahun ?? 'N/A' }}</h2>
        </div>

        {{-- Ringkasan --}}
        <div class="apb-right">
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
        </div>
    </div>
</div>

{{-- Bagian Chart & Progress --}}
<div class="container mx-auto px-6 mt-10">
    {{-- Pendapatan --}}
    <div class="card-box">
        <h3>
            Pendapatan Desa
            <button class="download-btn" onclick="downloadChart('chartPendapatan','Pendapatan_Desa.png')">Download</button>
        </h3>
        <canvas id="chartPendapatan"></canvas>

        @if($apbd)
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
        @endif
    </div>

    {{-- Belanja --}}
    <div class="card-box">
        <h3>
            Belanja Desa
            <button class="download-btn" onclick="downloadChart('chartBelanja','Belanja_Desa.png')">Download</button>
        </h3>
        <canvas id="chartBelanja"></canvas>
        @if($apbd)
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
        @endif
    </div>

    {{-- Pembiayaan --}}
    <div class="card-box">
        <h3>
            Pembiayaan Desa
            <button class="download-btn" onclick="downloadChart('chartPembiayaan','Pembiayaan_Desa.png')">Download</button>
        </h3>
        <canvas id="chartPembiayaan"></canvas>
        @if($apbd)
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
        @endif
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
@if($apbd)
    // Pendapatan Chart
    const ctxPendapatan = document.getElementById('chartPendapatan').getContext('2d');
    const gradientPendapatan1 = ctxPendapatan.createLinearGradient(0, 0, 0, 300);
    gradientPendapatan1.addColorStop(0, '#66bb6a'); gradientPendapatan1.addColorStop(1, '#2e7d32');
    const gradientPendapatan2 = ctxPendapatan.createLinearGradient(0, 0, 0, 300);
    gradientPendapatan2.addColorStop(0, '#81c784'); gradientPendapatan2.addColorStop(1, '#388e3c');
    const gradientPendapatan3 = ctxPendapatan.createLinearGradient(0, 0, 0, 300);
    gradientPendapatan3.addColorStop(0, '#a5d6a7'); gradientPendapatan3.addColorStop(1, '#2e7d32');

    new Chart(ctxPendapatan, {
        type: 'bar',
        data: { labels: @json(array_column($pendapatanData,'sumber')), datasets: [{ data: @json(array_column($pendapatanData,'jumlah')), backgroundColor: [gradientPendapatan1,gradientPendapatan2,gradientPendapatan3], borderRadius:10 }] },
        options: {
            responsive:true,
            plugins:{ legend:{display:false}, tooltip:{ callbacks:{ label: ctx => 'Rp'+ctx.raw.toLocaleString('id-ID') } } },
            scales:{ y:{ ticks:{ callback: value=>'Rp'+value.toLocaleString('id-ID') } } }
        }
    });

    // Belanja Chart
    const ctxBelanja = document.getElementById('chartBelanja').getContext('2d');
    const gradientsBelanja = [['#ef9a9a','#e53935'],['#f48fb1','#ef5350'],['#e57373','#c62828'],['#ffcc80','#ff7043'],['#ce93d8','#8e24aa']].map(g=>{const grad=ctxBelanja.createLinearGradient(0,0,0,300); grad.addColorStop(0,g[0]); grad.addColorStop(1,g[1]); return grad;});
    new Chart(ctxBelanja, {
        type:'bar',
        data:{ labels:@json(array_column($belanjaData,'bidang')), datasets:[{ data:@json(array_column($belanjaData,'jumlah')), backgroundColor:gradientsBelanja, borderRadius:10 }] },
        options:{ responsive:true, plugins:{ legend:{display:false}, tooltip:{ callbacks:{ label: ctx => 'Rp'+ctx.raw.toLocaleString('id-ID') } } }, scales:{ y:{ ticks:{ callback: value=>'Rp'+value.toLocaleString('id-ID') } } } }
    });

    // Pembiayaan Chart
    const ctxPembiayaan = document.getElementById('chartPembiayaan').getContext('2d');
    new Chart(ctxPembiayaan,{
        type:'doughnut',
        data:{ labels:@json(array_column($pembiayaanData,'jenis')), datasets:[{ data:@json(array_column($pembiayaanData,'jumlah')), backgroundColor:['#42a5f5','#1e88e5'], borderWidth:2, borderColor:'#fff' }] },
        options:{ responsive:true, cutout:'65%', plugins:{ legend:{ position:'bottom', labels:{ font:{ size:14 } } }, tooltip:{ callbacks:{ label: ctx => ctx.label + ': Rp' + ctx.raw.toLocaleString('id-ID') } } } }
    });
@endif

// Download chart function
function downloadChart(canvasId, filename){
    const canvas = document.getElementById(canvasId);
    const link = document.createElement('a');
    link.href = canvas.toDataURL('image/png');
    link.download = filename;
    link.click();
}
</script>
@endsection
