@extends('layouts.landing.app')

@section('content')
<section class="bg-white py-12">
    <div class="max-w-5xl mx-auto px-4">

        {{-- Judul utama --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">APB DESA Kersik</h1>
            <p class="text-lg text-gray-600">Tahun Anggaran <span class="text-red-600">{{ $apbd['tahun'] }}</span></p>
        </div>

        {{-- Angka ringkasan (Pendapatan / Belanja / Pembiayaan / Surplus) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            {{-- Pendapatan --}}
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="bg-green-200 p-3 rounded-full">
                        <i class="fas fa-sack-dollar text-green-700 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Pendapatan</p>
                        <h3 class="text-xl font-semibold text-green-700">
                            Rp{{ number_format($apbd['pendapatan'],0,',','.') }}
                        </h3>
                    </div>
                </div>
            </div>
            {{-- Belanja --}}
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="bg-red-200 p-3 rounded-full">
                        <i class="fas fa-money-bill-wave text-red-700 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Belanja</p>
                        <h3 class="text-xl font-semibold text-red-700">
                            Rp{{ number_format($apbd['belanja'],0,',','.') }}
                        </h3>
                    </div>
                </div>
            </div>
            {{-- Pembiayaan --}}
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="bg-blue-200 p-3 rounded-full">
                        <i class="fas fa-hand-holding-usd text-blue-700 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Pembiayaan</p>
                        <h3 class="text-xl font-semibold text-blue-700">
                            Rp{{ number_format($apbd['pembiayaan'],0,',','.') }}
                        </h3>
                    </div>
                </div>
            </div>
            {{-- Surplus / Defisit --}}
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                <div class="flex items-center">
                    <div class="bg-yellow-200 p-3 rounded-full">
                        <i class="fas fa-chart-line text-yellow-800 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Surplus / Defisit</p>
                        <h3 class="text-xl font-semibold text-yellow-800">
                            Rp{{ number_format($apbd['surplus_defisit'],0,',','.') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik utama --}}
        <div class="bg-white rounded-lg shadow p-8 mb-12">
            <canvas id="chartTahun" class="w-full h-72"></canvas>
        </div>

        {{-- Tabel tahun ke tahun --}}
        <div class="bg-white rounded-lg shadow p-8 mb-12">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Perbandingan Tahun</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Tahun</th>
                            <th class="px-4 py-2 text-right">Pendapatan</th>
                            <th class="px-4 py-2 text-right">Belanja</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($tahunData as $t)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $t['tahun'] }}</td>
                                <td class="px-4 py-2 text-right text-green-700">
                                    Rp{{ number_format($t['pendapatan'],0,',','.') }}
                                </td>
                                <td class="px-4 py-2 text-right text-red-700">
                                    Rp{{ number_format($t['belanja'],0,',','.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode(array_column($tahunData, 'tahun')) !!};
    const pend = {!! json_encode(array_column($tahunData, 'pendapatan')) !!};
    const bel = {!! json_encode(array_column($tahunData, 'belanja')) !!};

    new Chart(document.getElementById("chartTahun"), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Pendapatan",
                    data: pend,
                    borderColor: "#16a34a",
                    backgroundColor: "rgba(22,163,74,0.2)",
                    tension: 0.4,
                    fill: true
                },
                {
                    label: "Belanja",
                    data: bel,
                    borderColor: "#dc2626",
                    backgroundColor: "rgba(220,38,38,0.2)",
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } },
            scales: {
                y: { beginAtZero: true, ticks: { callback: v => "Rp" + v.toLocaleString("id-ID") } }
            }
        }
    });
</script>
@endpush
@endsection
