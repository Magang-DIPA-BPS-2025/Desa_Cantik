@extends('layouts.landing.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Pemerintah Desa</h2>

    {{-- Tupoksi Desa --}}
    <div class="mb-5">
        <h4 class="text-primary mb-3">Tupoksi Desa</h4>
        @if($pemerintahDesas->where('tupoksi', '!=', null)->count() > 0)
            <div class="row g-3">
                @foreach($pemerintahDesas as $pd)
                    @if($pd->tupoksi)
                        <div class="col-md-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pd->jabatan }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $pd->nama }}</h6>
                                    <p class="card-text">{{ $pd->tupoksi }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-muted">Belum ada data Tupoksi Desa.</p>
        @endif
    </div>

    {{-- Struktur Organisasi Desa --}}
    <div class="mb-5">
        <h4 class="text-success mb-4 text-center">Struktur Organisasi Desa</h4>

        @if(count($pemerintahDesas) > 0)
        <div class="org-chart text-center">

            {{-- Kepala Desa --}}
            @php $kepala = $pemerintahDesas->where('jabatan','Kepala Desa')->first(); @endphp
            @if($kepala)
            <div class="org-node">
                <div class="node-box bg-warning">
                    <strong>{{ $kepala->jabatan }}</strong><br>
                    {{ $kepala->nama }}
                    @if($kepala->tupoksi)
                        <p class="mt-2"><em>{{ $kepala->tupoksi }}</em></p>
                    @endif
                </div>
            </div>
            @endif

            {{-- Sekretaris --}}
            @php $sekretaris = $pemerintahDesas->where('jabatan','Sekretaris')->first(); @endphp
            @if($sekretaris)
            <div class="org-node mt-3">
                <div class="node-box bg-warning">
                    <strong>{{ $sekretaris->jabatan }}</strong><br>
                    {{ $sekretaris->nama }}
                    @if($sekretaris->tupoksi)
                        <p class="mt-2"><em>{{ $sekretaris->tupoksi }}</em></p>
                    @endif
                </div>
            </div>
            @endif

            {{-- Kepala Seksi / Kaur / Kadus --}}
            <div class="org-level d-flex justify-content-center flex-wrap mt-4 gap-3">
                @foreach($pemerintahDesas as $pd)
                    @if(str_contains($pd->jabatan, 'Kasi') || str_contains($pd->jabatan, 'Kaur') || str_contains($pd->jabatan, 'Kadus'))
                        <div class="org-node">
                            <div class="node-box bg-warning">
                                <strong>{{ $pd->jabatan }}</strong><br>
                                {{ $pd->nama }}
                                @if($pd->tupoksi)
                                    <p class="mt-2"><em>{{ $pd->tupoksi }}</em></p>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
        @else
            <p class="text-muted text-center">Belum ada data Struktur Organisasi Desa.</p>
        @endif
    </div>

    {{-- Pilih Bulan & Tahun --}}
    <form method="GET" action="{{ route('pemerintah') }}" class="mb-4 d-flex flex-wrap gap-3 align-items-end">
        <div class="d-flex flex-column">
            <label for="month" class="form-label">Bulan</label>
            <select name="month" id="month" class="form-select">
                @for($m=1; $m<=12; $m++)
                    <option value="{{ $m }}" @if($m == $month) selected @endif>{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                @endfor
            </select>
        </div>

        <div class="d-flex flex-column">
            <label for="year" class="form-label">Tahun</label>
            <select name="year" id="year" class="form-select">
                @for($y = date('Y')-5; $y <= date('Y')+5; $y++)
                    <option value="{{ $y }}" @if($y == $year) selected @endif>{{ $y }}</option>
                @endfor
            </select>
        </div>
    </form>

    {{-- Kalender Interaktif --}}
    @php
        $monthName = \Carbon\Carbon::create($year, $month)->format('F Y');
    @endphp

    <h4 class="mb-3 text-center">{{ $monthName }}</h4>

    <table class="table table-bordered text-center calendar">
        <thead class="table-light">
            <tr>
                <th>Minggu</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
                <th>Sabtu</th>
            </tr>
        </thead>
        <tbody>
            @php
                $firstDay = \Carbon\Carbon::create($year, $month, 1);
                $daysInMonth = $firstDay->daysInMonth;
                $startDayOfWeek = $firstDay->dayOfWeek;
                $day = 1;
            @endphp
            @for($i=0; $i<6; $i++)
                <tr>
                    @for($j=0; $j<7; $j++)
                        @if($i == 0 && $j < $startDayOfWeek)
                            <td></td>
                        @elseif($day <= $daysInMonth)
                            <td class="align-top">
                                <strong>{{ $day }}</strong>
                                @if(isset($events[$day]))
                                    <br>
                                    <button class="btn btn-sm btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#modalDay{{ $day }}">
                                        {{ count($events[$day]) }} Kegiatan
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDay{{ $day }}" tabindex="-1" aria-labelledby="modalDayLabel{{ $day }}" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="modalDayLabel{{ $day }}">Kegiatan Tanggal {{ $day }} {{ $monthName }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                            <ul class="list-group">
                                                @foreach($events[$day] as $event)
                                                    <li class="list-group-item">
                                                        <strong>{{ $event->nama_kegiatan }}</strong><br>
                                                        @if($event->deskripsi) <small>{{ $event->deskripsi }}</small> @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                @endif
                            </td>
                            @php $day++; @endphp
                        @else
                            <td></td>
                        @endif
                    @endfor
                </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<style>
    .calendar table td {
        height: 100px;
        vertical-align: top;
    }

    /* Card Tupoksi & Struktur Organisasi */
    .card {
        border-radius: 10px;
    }
    .card-body {
        padding: 15px;
    }

    /* Responsive dropdown */
    form select {
        min-width: 150px;
    }

    /* Struktur Organisasi Desa - Diagram */
    .org-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .org-level {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 30px;
        position: relative;
    }

    .org-node {
        text-align: center;
        position: relative;
        padding: 10px;
    }

    .node-box {
        border: 2px solid #000;
        padding: 15px 20px;
        min-width: 160px;
        background-color: #fff59d;
        border-radius: 6px;
        box-shadow: 1px 1px 6px rgba(0,0,0,0.2);
        position: relative;
    }

    /* Garis penghubung */
    .org-node::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        border-left: 2px solid #000;
        height: 20px;
    }

    .org-level .org-node::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 50%;
        border-left: 2px solid #000;
        height: 20px;
    }

    .org-level::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 0;
        width: 100%;
        border-top: 2px solid #000;
    }

    .node-box p {
        font-size: 0.85rem;
        color: #333;
    }

    @media (max-width: 768px) {
        .node-box {
            min-width: 140px;
            padding: 10px 12px;
        }
    }
</style>
@endsection
