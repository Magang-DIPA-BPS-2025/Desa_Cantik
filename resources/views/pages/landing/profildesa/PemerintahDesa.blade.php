@extends('layouts.landing.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-dark text-center">Pemerintah Desa</h2>

    {{-- Tupoksi Desa --}}
	<div class="mb-5">
		<h4 class="mb-3 text-dark">Tugas Pokok dan Fungsi (Tupoksi)</h4>
		@if($pemerintahDesas->where('tupoksi', '!=', null)->count() > 0)
			<ul class="tupoksi-list">
				@foreach($pemerintahDesas as $pd)
					@if($pd->tupoksi)
						<li>{{ $pd->tupoksi }}</li>
					@endif
				@endforeach
			</ul>
		@else
			<p class="text-muted">Belum ada data Tupoksi Desa.</p>
		@endif
	</div>

	{{-- Struktur Organisasi Desa --}}
	<div class="mb-5">
		<h4 class="mb-4 text-center text-dark">Struktur Organisasi Desa</h4>

		@php
		use Illuminate\Support\Str;
		$strukturImgRel = 'img/struktur-organisasi-desa.jpg';
		$strukturFullPath = public_path($strukturImgRel);
		$kepala = $pemerintahDesas->first(fn($item) => Str::lower(trim($item->jabatan)) === 'kepala desa');
		$sekretaris = $pemerintahDesas->first(fn($item) => Str::lower(trim($item->jabatan)) === 'sekretaris');
		$levelBawah = $pemerintahDesas->filter(fn($item) => Str::contains(Str::lower(trim($item->jabatan)), ['kasi','kaur','kadus']));
		@endphp

		@if(file_exists($strukturFullPath))
			<div class="text-center">
				<img src="{{ asset($strukturImgRel) }}" alt="Struktur Kelembagaan Pemerintahan Desa" class="img-fluid rounded shadow-sm org-image" />
			</div>
		@else
			<div class="org-chart">
				{{-- Fallback: render struktur sederhana dinamis --}}
				@if($kepala)
				<div class="org-node text-center">
					@if($kepala->foto)
					<img src="{{ asset('storage/' . $kepala->foto) }}" class="node-img mb-2">
					@endif
					<div class="node-box card-node">
						<strong>{{ $kepala->jabatan }}</strong><br>
						{{ $kepala->nama }}
					</div>
				</div>
				@endif

				@if($sekretaris)
				<div class="connector-vertical"></div>
				<div class="org-node text-center mt-3">
					@if($sekretaris->foto)
					<img src="{{ asset('storage/' . $sekretaris->foto) }}" class="node-img mb-2">
					@endif
					<div class="node-box card-node">
						<strong>{{ $sekretaris->jabatan }}</strong><br>
						{{ $sekretaris->nama }}
					</div>
				</div>
				@endif

				@if(count($levelBawah) > 0)
				<div class="connector-vertical"></div>
				<div class="org-level d-flex justify-content-center flex-wrap position-relative gap-3">
					@foreach($levelBawah as $pd)
					<div class="org-node text-center">
						@if($pd->foto)
						<img src="{{ asset('storage/' . $pd->foto) }}" class="node-img mb-2">
						@endif
						<div class="node-box card-node">
							<strong>{{ $pd->jabatan }}</strong><br>
							{{ $pd->nama }}
						</div>
					</div>
					@endforeach
				</div>
				@endif
			</div>
		@endif
	</div>
</div>
@endsection

@section('styles')
<style>
/* Tupoksi Desa */
.card {
    border-radius: 10px;
    padding: 15px;
    background-color: #f8f9fa;
}

/* Struktur Organisasi Desa */
.org-chart {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    position: relative;
}

.org-node {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}

.node-box {
    border-radius: 10px;
    padding: 10px 12px;
    min-width: 120px;
    background: #fff;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
    transition: transform 0.2s, box-shadow 0.2s;
    font-size: 14px;
}

/* Hover effect */
.node-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 12px rgba(0,0,0,0.25);
}

.node-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

/* Connector vertikal */
.connector-vertical {
    width: 2px;
    height: 25px;
    background-color: #198754;
    margin: -5px auto;
}

/* Level bawah */
.org-level {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    position: relative;
}

/* Garis horizontal dari Sekretaris ke semua node bawah */
.org-level::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: #198754;
}

/* Garis vertikal setiap node bawah */
.org-level .org-node::before {
    content: '';
    position: absolute;
    top: -20px;
    left: 50%;
    width: 2px;
    height: 20px;
    background: #198754;
    transform: translateX(-50%);
}

/* Responsive */
@media (max-width: 768px) {
    .node-box {
        min-width: 100px;
        padding: 8px 10px;
        font-size: 13px;
    }
    .org-level {
        gap: 10px;
    }
    .node-img {
        width: 40px;
        height: 40px;
    }
}
</style>
@endsection
