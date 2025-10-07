@extends('layouts.landing.app')
@section('content')

@push('styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
        color: #333;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(0,0,0,0.5)),
            url('{{ asset("landing/images/slider-main/makassar.jpg") }}') center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 150px 20px;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        box-shadow:  #f9fafb
    }
    .hero-section h1 { font-size: 48px; font-weight: 700; margin-bottom: 15px; }
    .hero-section h2 { font-size: 24px; margin-bottom: 10px; }
    .hero-section h3 {
        display: inline-block;
        background: linear-gradient(45deg, #7CB518, #4CAF50);
        padding: 10px 22px;
        border-radius: 30px;
        font-size: 18px;
        color: #fff;
    }

    /* Info Dusun/RT/RW */
    .info-section {
        background: #f1f8f4;
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 60px 20px;
        flex-wrap: wrap;
    }
    .info-card {
        background: #fff;
        width: 200px;
        padding: 40px 20px;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: 0.3s;
    }
    .info-card:hover { transform: translateY(-8px); }
    .info-card .angka { font-size: 40px; font-weight: 700; margin-bottom: 12px; color: #2e7d32; }

    /* Statistik */
    .statistik {
        background: linear-gradient(135deg, #C0D09D, #A5C37A);
        padding: 70px 20px;
        text-align: center;
        border-radius: 40px;
        margin: 50px auto;
        width: 95%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .statistik h2 { margin-bottom: 30px; font-size: 28px; font-weight: 700; color: #1b5e20; }
    .statistik-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 18px;
        justify-items: center;
    }
    @media (max-width: 1100px) { .statistik-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 680px) { .statistik-grid { grid-template-columns: repeat(2, 1fr); } }
    .statistik .item {
        width: 100%;
        max-width: 190px;
        padding: 20px;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .statistik .item:hover { transform: translateY(-6px); box-shadow: 0 12px 26px rgba(0,0,0,0.12); }
    .statistik img { width: 72px; margin-bottom: 12px; }
    .statistik .angka { font-size: 26px; font-weight: 800; color: #2e7d32; margin: 6px 0; }
    .statistik .label { font-size: 14px; color: #555; }

    /* Profil Desa */
    .profil {
        padding: 70px 20px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 40px;
        max-width: 1100px;
        margin: auto;
    }
    .profil-text { flex: 1; }
    .profil-text h2 { font-size: 32px; margin-bottom: 20px; color: #2e7d32; }
    .profil-text p { line-height: 1.8; }
    .profil-img { flex: 1; text-align: center; }
    .profil-img img { width: 100%; max-width: 450px; border-radius: 20px; }

    /* Chart */
    .chart-section {
        padding: 60px 20px;
        background: #fff;
        text-align: center;
    }
    .chart-section h2 { margin-bottom: 30px; color: #2e7d32; }
    .chart-wrapper {
        max-width: 600px;
        margin: auto;
    }

    /* APB Desa */
    .apb-desa {
        background: #fff;
        padding: 80px 20px;
    }
    .apb-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: auto;
    }
    .apb-img img {
        max-width: 400px;
    }
    .apb-info {
        flex: 1;
        min-width: 300px;
    }
    .apb-info h2 {
        color: #2e7d32;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .apb-info p {
        font-size: 16px;
        margin-bottom: 25px;
    }
    .apb-card {
        background: #f9f9f9;
        border-radius: 12px;
        padding: 18px 25px;
        margin-bottom: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .apb-card span {
        display: block;
        font-size: 14px;
        color: #ffffffff;
    }
    .apb-card h3 {
        font-size: 22px;
        font-weight: 700;
        margin-top: 8px;
        color: #ffffffff;

    }
    .apb-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 25px;
        background: transparent;
        border: 2px solid #333;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        color: #333;
        transition: 0.3s;
    }
    .apb-btn:hover {
        background: #333;
        color: #fff;
    }

    /* Warna khusus APB Desa */
.apb-card.pendapatan {
    background: linear-gradient(135deg, #4CAF50, #81C784);
    color: white;
}

.apb-card.belanja {
    background: linear-gradient(135deg, #E53935, #EF5350);
    color: white;
}

</style>
@endpush

{{-- Hero Section --}}
<div class="hero-section">
    <h2>Selamat Datang di Website Resmi</h2>
    <h1>Desa Cantik Kelurahan Maccini Sombala</h1>
    <h3>Badan Pusat Statistik Kota Makassar</h3>
</div>

{{-- Info Dusun/RT/RW --}}
<div class="info-section">
    <div class="info-card">
        <p class="angka">7</p>
        <p>Dusun</p>
    </div>
    <div class="info-card">
        <p class="angka">23</p>
        <p>RT</p>
    </div>
    <div class="info-card">
        <p class="angka">12</p>
        <p>RW</p>
    </div>
</div>

{{-- Statistik --}}
<div class="statistik">
    <h2>Statistik Penduduk Kelurahan Maccini Sombala Tahun 2025</h2>
    <div class="statistik-grid">
        <div class="item">
            <img src="{{ asset('landing/images/icon-image/kepalaKeluarga.png') }}" alt="Kepala Keluarga">
            <p class="angka">2.463</p>
            <p class="label">Kepala Keluarga</p>
        </div>
        <div class="item">
            <img src="{{ asset('landing/images/icon-image/male.png') }}" alt="Laki-laki">
            <p class="angka">4.952</p>
            <p class="label">Laki-laki</p>
        </div>
        <div class="item">
            <img src="{{ asset('landing/images/icon-image/women.png') }}" alt="Perempuan">
            <p class="angka">4.716</p>
            <p class="label">Perempuan</p>
        </div>
        <div class="item">
            <img src="{{ asset('landing/images/icon-image/disabi.png') }}" alt="Disabilitas">
            <p class="angka">4</p>
            <p class="label">Disabilitas</p>
        </div>
        <div class="item">
            <img src="{{ asset('landing/images/icon-image/family.png') }}" alt="Jumlah Penduduk">
            <p class="angka">9.668</p>
            <p class="label">Jumlah Penduduk</p>
        </div>
    </div>
</div>

{{-- Profil Singkat --}}
<div class="profil">
    <div class="profil-text">
        <h2>Tentang Kelurahan</h2>
        <p>
            Kelurahan Maccini Sombala merupakan salah satu kelurahan di Kota Makassar 
            yang memiliki potensi besar dalam pembangunan masyarakat. 
            Dengan jumlah penduduk lebih dari <b>9.600 jiwa</b>, 
            wilayah ini terus berkembang dengan berbagai program sosial, pendidikan, 
            serta peningkatan infrastruktur.
        </p>
    </div>
    <div class="profil-img">
        <img src="{{ asset('landing/images/slider-main/kelurahan.jpg') }}" alt="Kelurahan">
    </div>
</div>

{{-- Chart Statistik --}}
<div class="chart-section">
    <h2>Visualisasi Statistik Penduduk</h2>
    <div class="chart-wrapper">
        <canvas id="chartPenduduk" width="400" height="200"></canvas>
    </div>
</div>

{{-- APB Desa --}}
<div class="apb-desa">
    <div class="apb-container">
        <div class="apbdesa-img">
        <img src="{{ asset('landing/images/slider-main/apbd.png') }}" alt="APBD Desa">
    </div>
        <div class="apb-info">
            <h2>APB DESA 2024</h2>
            <p>Akses cepat dan transparan terhadap APB Desa serta proyek pembangunan</p>
            <div class="apb-card pendapatan">
            <span>Pendapatan Desa</span>
            <h3>Rp4.802.205.800,00</h3>
            </div>
            <div class="apb-card belanja">
            <span>Belanja Desa</span>
            <h3>Rp4.888.222.678,00</h3>
            </div>
            <a href="{{ url('/apbd') }}" class="apb-btn">
                <i class="fa fa-file-alt"></i> LIHAT DATA LEBIH LENGKAP
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPenduduk');
    const chartColors = ['#22c55e', '#60a5fa', '#f97316', '#a78bfa', '#ef4444'];
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Kepala Keluarga','Laki-laki', 'Perempuan', 'Disabilitas','Jumlah Penduduk'],
            datasets: [{
                label: 'Jumlah',
                data: [4952,4716,445,232,4353],
                backgroundColor: chartColors,
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 8,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, pointStyle: 'circle', padding: 16 }
                },
                tooltip: {
                    callbacks: {
                        label: (ctx) => `${ctx.label}: ${ctx.parsed}`
                    }
                },
                title: {
                    display: false
                }
            },
            cutout: '65%'
        }
    });
</script>
@endpush

@endsection
