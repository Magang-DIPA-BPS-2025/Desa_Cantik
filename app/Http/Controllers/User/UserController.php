<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Modul;
use App\Models\Tema;
use App\Models\Artikel;
use App\Models\Berita;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = array(
            'berita' => Berita::orderByDesc('id')->skip(0)->take(10)->get(),
            'agenda' => Agenda::orderByDesc('id')->skip(0)->take(10)->get(),
            'tema' => tema::orderByDesc('id')->skip(0)->take(10)->get(),
            'modul' => Modul::orderByDesc('id')->skip(0)->take(10)->get(),
            'artikel' => Artikel::orderByDesc('id')->skip(0)->take(10)->get(),
        );

        // dd($datas);
        // return view('pages.user.index', ['menu' => 'profil']);
        return view('pages.landing.index', ['menu' => 'profil'], compact('datas'));
    }

    public function kontak()
    {
        return view('pages.landing.kontak', ['menu' => 'kontak']);
        // return view('pages.user.kontak', ['menu' => 'kontak']);
    }


    public function detail($jenis, $id)
    {
        // dd($jenis);
        if ($jenis == 'modul') {
            $data = modul::find($id);
            $latest_post = modul::orderByDesc('id')->skip(0)->take(5)->get();
        } else if ($jenis == 'tema') {
            $data = tema::find($id);
            $latest_post = tema::orderByDesc('id')->skip(0)->take(5)->get();
        } else if ($jenis == 'agenda') {
            $data = Agenda::find($id);
            $latest_post = Agenda::orderByDesc('id')->skip(0)->take(5)->get();
            return view('pages.landing.detail-agenda', [
                'menu' => 'detail post',
                'data' => $data,
                'jenis' => $jenis,
                'latest_post' => $latest_post
            ]);
        }

        return view('pages.landing.detail-post', [
            'menu' => 'detail post',
            'data' => $data,
            'jenis' => $jenis,
            'latest_post' => $latest_post
        ]);
        // return view('pages.user.kontak', ['menu' => 'kontak']);
    }

}
