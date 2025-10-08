<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;

class UserController extends Controller
{
    /**
     * Halaman utama user (menampilkan berita dan agenda)
     */
    public function index()
    {
        $datas = [
            'berita' => Berita::orderByDesc('id')->take(10)->get(),
            'agenda' => Agenda::orderByDesc('id')->take(10)->get(),
        ];

        return view('pages.landing.index', ['menu' => 'profil'], compact('datas'));
    }

    /**
     * Halaman kontak
     */
    public function kontak()
    {
        return view('pages.landing.kontak', ['menu' => 'kontak']);
    }

    /**
     * Detail Berita / Agenda
     */
    public function detail($jenis, $id)
    {
        if ($jenis === 'berita') {
            $data = Berita::findOrFail($id);
            $latest_post = Berita::latest()->take(5)->get();
            $view = 'pages.landing.detail-berita';
        } elseif ($jenis === 'agenda') {
            $data = Agenda::findOrFail($id);
            $latest_post = Agenda::latest()->take(5)->get();
            $view = 'pages.landing.detail-agenda';
        } else {
            abort(404);
        }

        return view($view, [
            'menu' => 'detail post',
            'data' => $data,
            'jenis' => $jenis,
            'latest_post' => $latest_post
        ]);
    }

    /**
     * Pemanggilan langsung halaman detail-berita tanpa parameter jenis
     * Misal: route('/detail-berita/{id}')
     */
    public function showDetailBerita($id)
    {
        $data = Berita::findOrFail($id);
        $latest_post = Berita::latest()->take(5)->get();

        // Langsung panggil view yang sama
        return view('pages.landing.detail-berita', [
            'menu' => 'detail post',
            'data' => $data,
            'jenis' => 'berita',
            'latest_post' => $latest_post
        ]);
    }
}
