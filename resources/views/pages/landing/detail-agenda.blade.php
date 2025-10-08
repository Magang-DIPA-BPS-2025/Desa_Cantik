@extends('layouts.landing.app')
@section('content')


<!-- Main Container -->
<section id="main-container" class="main-container py-5">
    <div class="container">
        <div class="row">

            <!-- Konten Detail -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="post-content post-single">
                    <div class="post-media post-image mb-4">
                    </div>

                    <div class="post-body">
                        <!-- Meta Info -->
                        <div class="entry-header mb-3">
                            <div class="post-meta d-flex flex-wrap gap-3 mb-2">
                                <span class="post-author"><i class="far fa-user"></i> {{ $data->author }}</span>
                                <span class="post-cat"><i class="far fa-folder-open"></i> {{ strtoupper($jenis) }}</span>
                                <?php
                                setlocale(LC_ALL, 'IND');
                                $tgl_publish = strftime('%d %b - ', strtotime($data->tgl_kegiatan));
                                $tgl_selesai = strftime('%d %b %Y ', strtotime($data->tgl_selesai));
                                $jam_mulai = strftime('%H:%M ', strtotime($data->jam_mulai));
                                $jam_selesai = strftime('%H:%M ', strtotime($data->jam_selesai));
                                ?>
                                <span class="post-meta-date"><i class="far fa-calendar"></i> {{ $tgl_publish }} {{ $tgl_selesai }}</span>
                                <span class="post-comment"><i class="far fa-clock"></i> {{ $jam_mulai }} - {{ $jam_selesai }} WITA</span>
                            </div>
                            <h2 class="entry-title">{{ $data->nama_kegiatan }}</h2>
                        </div>

                        <img loading="lazy"
     src="{{ $data->foto ? asset('storage/'.$data->foto) : ($data->thumbnail ? asset('upload/'.$jenis.'/'.$data->thumbnail) : asset('img/example-image.jpg')) }}"
     class="img-fluid w-100 rounded shadow-sm"
     alt="{{ $data->nama_kegiatan }}"
     title="{{ $data->nama_kegiatan }}">

                        <!-- Konten Deskripsi -->
                        <div class="entry-content mb-4">
                            {!! nl2br(e($data->deskripsi_kegiatan)) !!}
                        </div>
        </div><!-- row end -->
    </div><!-- container end -->
</section>
@endsection
