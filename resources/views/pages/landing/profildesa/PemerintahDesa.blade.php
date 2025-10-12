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
      <div class="col-12 col-sm-6 col-lg-4 mb-5 mt-3"> {{-- Tambah margin atas bawah --}}
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
       STRUKTUR DESA (STATIS)
  ========================== -->
  <div class="my-5">
    <h3 class="fw-bold text-dark text-start mb-4">Struktur Pemerintahan Desa</h3>
    <img src="{{ asset('/landing/images/banner/desa.png') }}"
         alt="Struktur Pemerintahan Desa"
         class="img-fluid rounded shadow-sm d-block mx-auto"
         style="max-width:1000px;">
  </div>

  <!-- =======================
       KALENDER AGENDA KEGIATAN (DINAMIS)
  ========================== -->
  <div class="mt-5">
    <h3 class="text-dark fw-bold text-start mb-4">Kalender Kegiatan Desa</h3>

    <form method="GET" class="d-flex justify-content-start align-items-center gap-3 mb-4 flex-wrap">
      <select name="month" class="form-select w-auto" onchange="this.form.submit()">
        @for($m = 1; $m <= 12; $m++)
          <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
          </option>
        @endfor
      </select>

      <select name="year" class="form-select w-auto" onchange="this.form.submit()">
        @for($y = now()->year - 2; $y <= now()->year + 2; $y++)
          <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
        @endfor
      </select>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle shadow-sm">
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
            $day = 1;
            $totalCells = ceil(($daysInMonth + $startDayOfWeek) / 7) * 7;
          @endphp
          @for($cell = 0; $cell < $totalCells; $cell++)
            @if($cell % 7 == 0)
              <tr>
            @endif

            @php
              $isEmpty = $cell < $startDayOfWeek || $day > $daysInMonth;
            @endphp

            @if($isEmpty)
              <td>&nbsp;</td>
            @else
              @php $hasEvent = isset($events[$day]); @endphp
              <td class="p-2 {{ $hasEvent ? 'bg-success bg-opacity-10' : '' }}" style="vertical-align: top;">
                <div class="fw-bold">{{ $day }}</div>
                @if($hasEvent)
                  <ul class="list-unstyled mt-1 mb-0 small text-start ps-1">
                    @foreach($events[$day] as $event)
                      <li class="text-success">• {{ $event->judul_kegiatan }}</li>
                    @endforeach
                  </ul>
                @endif
              </td>
              @php $day++; @endphp
            @endif

            @if($cell % 7 == 6)
              </tr>
            @endif
          @endfor
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
