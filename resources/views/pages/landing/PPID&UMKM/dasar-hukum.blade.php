@extends('layouts.landing.app')

@section('content')
<div class="container py-5">
    <h2 class="text-success mb-4">📜 Dasar Hukum PPID</h2>
    
    <div class="card p-4 shadow-sm mb-4"> 
        <h4>Undang-Undang No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</h4>
        <p>
            Pejabat Pengelola Informasi dan Dokumentasi (PPID) diatur dalam Undang-Undang ini untuk memastikan badan publik menyediakan informasi kepada masyarakat secara transparan.
        </p>

        <h5>Pasal-Pasal Penting:</h5>
        <ul>
            <li>Pasal 1: Definisi informasi publik</li>
            <li>Pasal 2: Hak warga negara atas informasi</li>
            <li>Pasal 3: Kewajiban badan publik menyediakan informasi</li>
            <li>Pasal 4: Prosedur permintaan informasi</li>
            <li>... dan seterusnya</li>
        </ul>
    
        <p>Untuk dokumen lengkap, bisa <a href="{{ asset('files/UUD-PPID.pdf') }}" target="_blank">unduh di sini</a>.</p>
    </div>
    
    <a href="{{ route('ppid') }}" class="btn btn-success"> 
        <i class="fas fa-arrow-left"></i> Kembali ke PPID
    </a>
</div>
@endsection