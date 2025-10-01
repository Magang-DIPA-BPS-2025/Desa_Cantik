<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PemerintahDesaController;
use App\Http\Controllers\ApbdController;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\SejarahDesaController;
use App\Models\Agenda;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//
// ===================== USER ROUTES ===================== //
Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers\User'],
    function () {
        // Redirect root
        Route::redirect('/', '/');

        // Landing pages
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/kontak', 'UserController@kontak')->name('user.kontak');
        Route::get('/eksternal', 'UserController@guru')->name('user.guru');

        // Galeri Desa (static view)
        Route::get('/galeri', [GaleriController::class, 'userIndex'])->name('galeri.user.index');

        // Sejarah Desa (static view)
        Route::get('/sejarah', function () {
            return view('pages.landing.profildesa.SejarahDesa');
        })->name('sejarah');

        // Pemerintah Desa (static view)
        Route::get('/pemerintah', function () {
            return view('pages.landing.profildesa.PemerintahDesa');
        })->name('pemerintah');

        // APBD Desa (static view)
        Route::get('/apbd', [ApbdController::class, 'index'])->name('apbd');

        //Berita Desa (static view)
        Route::get('/berita', function () {
            return view('pages.landing.berita&agenda.BeritaDesa');
        })->name('berita');

        //Agenda Desa (static view)
        Route::get('/agenda', function () {
            return view('pages.landing.berita&agenda.AgendaDesa');
        })->name('agenda');

        //Jumlah Penduduk (static view)
        Route::get('/statistik-penduduk', [DataPendudukController::class, 'statistik'])->name('statistik.penduduk');

        //Data Pendidikan (static view)
        Route::get('/pendidikan', function () {
            return view('pages.landing.datastatistikdesa.DataPendidikan');
        })->name('pendidikan');

        //Data Pekerjaan(static view)
        Route::get('/pekerjaan', function () {
            return view('pages.landing.datastatistikdesa.DataPekerjaan');
        })->name('pekerjaan');

        //Berita Desa (static view)
        Route::get('/agama', function () {
            return view('pages.landing.datastatistikdesa.DataAgama');
        })->name('agama');

        //Surat Pengantar (static view)
        Route::get('/pengantar', function () {
            return view('pages.landing.layananonline.SuratPengantar');
        })->name('pengantar');

        //Status Surat Pengantar (static view)
        Route::get('/status', function () {
            return view('pages.landing.layananonline.StatusPengantar');
        })->name('status');

        //Pengaduan (static view)
        Route::get('/pengaduan', function () {
            return view('pages.landing.layananonline.Pengaduan');
        })->name('pengaduan');

        //Surat Pengaduan (static view)
        Route::get('/statuspengaduan', function () {
            return view('pages.landing.layananonline.StatusPengaduan');
        })->name('statuspengaduan');

        //Penyandang (static view)
        Route::get('/penyandang', function () {
            return view('pages.landing.layananonline.PenyandangDisabilitas');
        })->name('penyandang');

        Route::get('/detail/{jenis}/{id}', 'UserController@detail')->name('user.detail.post');

        // Pegawai
        Route::get('/pegawai', 'UserController@pegawai')->name('user.pegawai');
        Route::get('/pegawai/form', 'UserController@form_pegawai')->name('user.form_pegawai');
        Route::post('/pegawai/daftar', 'UserController@daftar_pegawai')->name('user.daftar_pegawai');
        Route::get('/pegawai/all', 'UserController@getPenugasanAll')->name('user.pegawai.all');
        Route::get('/pegawai/detail', 'UserController@getPenugasanDetail')->name('user.pegawai.detail');
        Route::get('/pegawai/detailLoka', 'UserController@getPenugasanDetailLoka')->name('user.pegawai.detail.loka');
        Route::get('/pegawai/detailEksternal', 'UserController@getPenugasanDetailEksternal')->name('user.pegawai.detail.eksternal');

        // Statistik
        Route::get('/statistik', 'UserController@statistik')->name('user.statistik');
        Route::get('/api/statistics/month/{month}', 'UserController@getMonthStatistics')->name('user.statistik.month');
        Route::get('/api/statistics/activities/{month}', 'UserController@getActivitiesByMonth')->name('user.statistik.month');
        Route::get('/api/statistics/activity/{activityId}/{participantType}', 'UserController@getActivityStatistics')->name('user.statistik.activity');

        // Eksternal
        Route::get('/eksternal/form/{jenis}', 'UserController@form_guru')->name('user.form_guru');
        Route::post('/eksternal/daftar', 'UserController@daftar_guru')->name('user.daftar_guru');

        // Kegiatan
        Route::get('/kegiatan', 'KegiatanController@index')->name('user.kegiatan');
        Route::get('/kegiatan/cari', 'KegiatanController@cari')->name('user.cari');
        Route::get('/kegiatan/registrasi', 'KegiatanController@regist')->name('user.kegiatan_regist');
        Route::post('/kegiatan/store', 'KegiatanController@store')->name('user.kegiatan_store');

        // API response JSON
        Route::get('/kegiatan/getStatus', 'KegiatanController@getStatus')->name('user.kegiatan.getStatus');
        Route::get('/kegiatan/cariPeserta', 'KegiatanController@cariPeserta')->name('user.kegiatan.cariPeserta');
        Route::get('/kegiatan/peserta', 'KegiatanController@getPesertaByKegiatan')->name('user.kegiatan.peserta');
        Route::get('/peserta/detail', 'KegiatanController@getPesertaDetail')->name('user.peserta.detail');
        Route::get('/peserta/cekData', 'KegiatanController@cekDataPeserta')->name('user.peserta.cekData');

        // Cetak (Print)
        Route::get('/print/absensi-peserta', 'KegiatanController@printAbsensiPeserta')->name('print.absensi.peserta');
        Route::get('/print/registrasi-peserta', 'KegiatanController@fprintRegistrasiPeserta')->name('print.registrasi.peserta');
        Route::get('/print/absensi-panitia', 'KegiatanController@printAbsensiPanitia')->name('print.absensi.panitia');
        Route::get('/print/absensi-narasumber', 'KegiatanController@printAbsensiNarasumber')->name('print.absensi.narasumber');
        Route::get('/print/absensi-tp', 'KegiatanController@printAbsensiTp')->name('print.absensi.tp');
        Route::get('/print/absensi-tkp', 'KegiatanController@printAbsensiTkp')->name('print.absensi.tkp');
        Route::get('/print/absensi-stk', 'KegiatanController@printAbsensiStk')->name('print.absensi.stk');
        Route::get('/print/absensi-pgw', 'KegiatanController@printAbsensiPgw')->name('print.absensi.pgw');
    }
);


//
// ===================== ADMIN ROUTES ===================== //
Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers', 'middleware' => 'ValidasiUser'],
    function () {

        Route::redirect('/admin', 'dashboard/');

        Route::prefix('dashboard')->group(function () {

            // Dashboard
            Route::get('/', 'AdminController@index')->name('dashboard');
            Route::get('/jadwalKegiatan', 'AdminController@jadwal')->name('dashboard.jadwal');
            Route::get('/jadwalKegiatan/{nik}', 'AdminController@getJadwalByPegawai')->name('dashboard.jadwal.getByPegawai');

            Route::get('/getByKegiatan', 'AdminController@getByKegiatan')->name('dashboard.jadwal.getByKegiatan')->withoutMiddleware(['ValidasiUser']);
            Route::get('/getByKegiatanUser', 'AdminController@getByKegiatanUser')->name('dashboard.jadwal.getByKegiatanUser')->withoutMiddleware(['ValidasiUser']);

            // Profile
            Route::get('/profile/{id}', 'AdminController@profile')->name('profile.index');
            Route::put('/profile/update', 'AdminController@profile_update')->name('profile.update');

            // Guru
            Route::prefix('guru')->group(function () {
                Route::get('/', 'guruController@index')->name('guru.index');
                Route::get('/create', 'guruController@create')->name('guru.create');
                Route::post('/store', 'guruController@store')->name('guru.store');
                Route::get('/show', 'guruController@showguru')->name('admin.guru.detail');
                Route::get('/edit/{id}', 'guruController@edit')->name('guru.edit');
                Route::put('/update', 'guruController@update')->name('guru.update');
                Route::post('/hapus/{id}', 'guruController@destroy')->name('guru.hapus');
            });

            // Data Penduduk
            Route::prefix('dataPenduduk')->group(function () {
                Route::get('/', 'DataPendudukController@index')->name('dataPenduduk.index');
                Route::get('/create', 'DataPendudukController@create')->name('dataPenduduk.create');
                Route::post('/store', 'DataPendudukController@store')->name('dataPenduduk.store');
                Route::get('/edit/{nik}', 'DataPendudukController@edit')->name('dataPenduduk.edit');
                Route::put('/update', 'DataPendudukController@update')->name('dataPenduduk.update');
                Route::delete('/destroy/{nik}', 'DataPendudukController@destroy')->name('dataPenduduk.destroy');
            });

            // Akun
            Route::prefix('akun')->group(function () {
                Route::get('/', 'AkunController@index')->name('akun.index');
                Route::get('/create', 'AkunController@create')->name('akun.create');
                Route::post('/store', 'AkunController@store')->name('akun.store');
                Route::post('/regis', 'AkunController@regis')->name('akun.regis');
                Route::get('/edit/{id}', 'AkunController@edit')->name('akun.edit');
                Route::put('/update', 'AkunController@update')->name('akun.update');
                Route::post('/hapus/{id}', 'AkunController@destroy')->name('akun.hapus');
            });

            // Jadwal
            Route::prefix('jadwal')->group(function () {
                Route::get('/', 'JadwalController@index')->name('jadwal.index');
                Route::get('/create', 'JadwalController@create')->name('jadwal.create');
                Route::post('/store', 'JadwalController@store')->name('jadwal.store');
                Route::get('/edit/{id}', 'JadwalController@edit')->name('jadwal.edit');
                Route::put('/update', 'JadwalController@update')->name('jadwal.update');
                Route::post('/hapus/{id}', 'JadwalController@destroy')->name('jadwal.hapus');
            });

            // Kegiatan
            Route::prefix('kegiatan')->group(function () {
                Route::get('/', 'kegiatanController@index')->name('kegiatan.index');
                Route::get('/create', 'kegiatanController@create')->name('kegiatan.create');
                Route::post('/store', 'kegiatanController@store')->name('kegiatan.store');
                Route::get('/edit/{id}', 'kegiatanController@edit')->name('kegiatan.edit');
                Route::put('/update', 'kegiatanController@update')->name('kegiatan.update');
                Route::post('/hapus/{id}', 'kegiatanController@destroy')->name('kegiatan.hapus');
            });


            // Kependudukan
            Route::prefix('kependudukan')->group(function () {
                Route::get('/', 'KependudukanController@index')->name('kependudukan.index');
                Route::get('/create', 'KependudukanController@create')->name('kependudukan.create');
                Route::post('/store', 'KependudukanController@store')->name('kependudukan.store');
                Route::get('/edit/{nik}', 'KependudukanController@edit')->name('kependudukan.edit');
                Route::put('/update', 'KependudukanController@update')->name('kependudukan.update');
                Route::post('/hapus/{id}', 'KependudukanController@hapus')->name('kependudukan.hapus');
                Route::get('/cetak/{id}', 'KependudukanController@cetak')->name('kependudukan.cetak');
            });

            // Agenda
            Route::prefix('agenda')->group(function () {
                Route::get('/', 'AgendaController@index')->name('agenda.index');
                Route::get('/create', 'AgendaController@create')->name('agenda.create');
                Route::post('/store', 'AgendaController@store')->name('agenda.store');
                Route::get('/edit/{id}', 'AgendaController@edit')->name('agenda.edit');
                Route::put('/update', 'AgendaController@update')->name('agenda.update');
                Route::post('/hapus/{id}', 'AgendaController@destroy')->name('agenda.hapus');
            });





            // Galeri Desa
            Route::prefix('galeriDesa')->group(function () {
                Route::get('/', 'GaleriController@index')->name('galeriDesa.index');
                Route::get('/create', 'GaleriController@create')->name('galeriDesa.create');
                Route::post('/store', 'GaleriController@store')->name('galeriDesa.store');
                Route::get('/edit/{id}', 'GaleriController@edit')->name('galeriDesa.edit');
                Route::put('/update/{id}', 'GaleriController@update')->name('galeriDesa.update');
                Route::delete('/delete/{id}', 'GaleriController@destroy')->name('galeriDesa.destroy');
            });


            // routes/web.php

            Route::resource('sejarahDesa', SejarahDesaController::class);

            Route::resource('pemerintah-desa', PemerintahDesaController::class);

            Route::resource('AgendaDesa', AgendaController::class);

            Route::resource('berita', BeritaController::class);

            Route::resource('kategori', KategoriController::class);

              Route::resource('pengaduan', PengaduanController::class);
              Route::put('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');



        });
    }
);


//
// ===================== AUTH ROUTES ===================== //
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@login_action')->name('login_action');
    Route::get('/logout', function () {
        Session::flush();
        return redirect()->route('user.index')->with('message', 'sukses logout');
    })->name('logout');
});
