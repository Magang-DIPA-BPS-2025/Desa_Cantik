@extends('layouts.landing.app')

@section('content')
<title>Desa Cantik - Agenda</title>

<style>
  body {
    font-family: 'Segoe UI', Arial, sans-serif;
    margin: 0;
    background: linear-gradient(120deg, #f0f9ff, #f9fbe7);
    color: #333;
  }

  .agenda-container {
    display: flex;
    gap: 30px;
    align-items: flex-start;
    padding: 40px 60px;
    max-width: 1400px;
    margin: auto;
  }

  .agenda-list {
    flex: 3;
  }

  .agenda-list h2 {
    margin-bottom: 30px;
    font-size: 32px;
    font-weight: 700;
    border-left: 8px solid #4CAF50;
    padding-left: 14px;
    color: #1d1d1d;
  }

  .agenda-card {
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .agenda-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
  }

  .agenda-card .thumb {
    width: 100%;
    height: 220px;
    border-radius: 14px;
    object-fit: cover;
    margin-bottom: 18px;
    transition: transform 0.3s;
  }
  .agenda-card:hover .thumb {
    transform: scale(1.07);
  }

  .agenda-card h3 {
    margin: 0 0 14px 0;
    font-size: 22px;
    color: #111;
  }

  .agenda-meta {
    font-size: 15px;
    color: #666;
    margin-bottom: 14px;
  }

  .agenda-card p {
    font-size: 15px;
    line-height: 1.6;
    color: #444;
  }

  .agenda-card button {
    background: #4CAF50;
    color: white;
    padding: 12px 22px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 15px;
    transition: background 0.3s;
  }
  .agenda-card button:hover {
    background: #388e3c;
  }

  /* Sidebar */
  .sidebar {
    flex: 1.2;
    display: flex;
    flex-direction: column;
    gap: 30px;
  }

  .search-box input {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #bbb;
    border-radius: 10px;
    font-size: 15px;
    transition: border 0.3s;
  }
  .search-box input:focus {
    border-color: #4CAF50;
    outline: none;
  }

  .kategori,
  .agenda-terbaru {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  }

  .kategori h3,
  .agenda-terbaru h3 {
    margin-bottom: 18px;
    font-size: 20px;
    font-weight: 600;
    color: #222;
  }

  .kategori button {
    display: block;
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    border: none;
    border-radius: 10px;
    background: #e8f5e9;
    color: #333;
    font-weight: 500;
    cursor: pointer;
    text-align: left;
    transition: background 0.3s;
  }
  .kategori button:hover {
    background: #c8e6c9;
  }

  .agenda-item {
    display: flex;
    gap: 14px;
    margin-bottom: 18px;
    align-items: center;
    transition: background 0.2s;
    padding: 8px;
    border-radius: 10px;
  }
  .agenda-item:hover {
    background: #f0f9f0;
  }

  .agenda-date {
    background: #4CAF50;
    color: white;
    padding: 12px;
    border-radius: 12px;
    text-align: center;
    width: 65px;
    flex-shrink: 0;
  }
  .agenda-date .day {
    font-size: 18px;
    font-weight: bold;
  }
  .agenda-date .month {
    font-size: 13px;
  }

  .agenda-info h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
  }
  .agenda-info p {
    margin: 3px 0 0;
    font-size: 14px;
    color: #555;
  }

  @media (max-width: 992px) {
    .agenda-container {
      flex-direction: column;
      padding: 20px;
    }
    .sidebar {
      margin-top: 25px;
    }
  }
</style>

<div class="agenda-container">
  <!-- Kiri -->
  <div class="agenda-list">
    <h2>Agenda Kegiatan</h2>

    @forelse($agendas as $agenda)
    <div class="agenda-card">
      <img class="thumb" src="{{ $agenda->foto ? asset('storage/'.$agenda->foto) : asset('img/example-image.jpg') }}" alt="{{ $agenda->nama_kegiatan }}">
      <h3><a href="{{ route('agenda.show', $agenda->id) }}" style="text-decoration:none;color:inherit;">{{ $agenda->nama_kegiatan }}</a></h3>
      <div class="agenda-meta">📅 {{ $agenda->waktu_pelaksanaan ? \Carbon\Carbon::parse($agenda->waktu_pelaksanaan)->isoFormat('DD MMM YYYY') : '' }} @if($agenda->kategori) | 📍 {{ $agenda->kategori }} @endif</div>
      <p>{{ Str::limit($agenda->deskripsi, 160) }}</p>
      <a href="{{ route('agenda.show', $agenda->id) }}"><button>Selengkapnya →</button></a>
    </div>
    @empty
      <p>Tidak ada data agenda.</p>
    @endforelse

    <div class="pagination" style="margin-top:20px;">
  {{ $agendas->appends(['kategori' => request('kategori')])->links() }}
</div>

  </div>

  <!-- Kanan -->
  <div class="sidebar">
    <div class="search-box">
      <h3>Cari Agenda</h3>
      <input type="text" placeholder="Cari Agenda...">
    </div>

    <div class="kategori">
      <h3>Kategori Agenda</h3>
      <a href="{{ route('agenda') }}" style="text-decoration:none;">
        <button @if(empty($kategoriSelected)) style="background:#4CAF50;color:#fff;" @endif>Semua</button>
      </a>
      @foreach(($kategoriList ?? collect()) as $kat)
      <a href="{{ route('agenda', ['kategori' => $kat]) }}" style="text-decoration:none;">
        <button @if(($kategoriSelected ?? '') === $kat) style="background:#4CAF50;color:#fff;" @endif>{{ $kat }}</button>
      </a>
      @endforeach
    </div>

    <div class="agenda-terbaru">
      <h3>Agenda Terbaru</h3>

      @foreach(($latest_agendas ?? []) as $a)
      <a href="{{ route('agenda.show', $a->id) }}" style="text-decoration:none;color:inherit;">
      <div class="agenda-item">
        <div class="agenda-date">
          @php $dt = $a->waktu_pelaksanaan ? \Carbon\Carbon::parse($a->waktu_pelaksanaan) : null; @endphp
          <div class="day">{{ $dt?->format('d') ?? '--' }}</div>
          <div class="month">{{ $dt?->format('M') ?? '' }}</div>
        </div>
        <div class="agenda-info">
          <h4>{{ $a->nama_kegiatan }}</h4>
          <p>📍 {{ $a->kategori }}</p>
        </div>
      </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
@endsection
