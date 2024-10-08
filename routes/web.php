<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('visit')->group(function () {
Route::get('/', 'FrontEndController@beranda');
Route::get('/info-harga', 'FrontEndController@info_harga');
Route::get('/info-stok', 'FrontEndController@info_stok');
Route::get('/info-harga/search', 'FrontEndController@info_harga_search');
Route::get('/info-stok', 'FrontEndController@info_stok');
Route::get('/info-stok/search', 'FrontEndController@info_stok_search');
Route::get('/grafik', 'FrontEndController@grafik');
Route::get('/artikel', 'FrontEndController@artikel');
Route::get('/artikel/{id}', 'FrontEndController@detailArtikel');
Route::get('/grafik/harga', 'FrontEndController@grafik_harga');
Route::get('/grafik/stok', 'FrontEndController@grafik_stok');
Route::get('/grafik/harga/search', 'FrontEndController@grafik_harga_search');
Route::get('/grafik/stok/search', 'FrontEndController@grafik_stok_search');
Route::get('/login', 'FrontEndController@login')->name('login');
Route::get('/kenaikan', 'FrontEndController@kenaikan');
Route::post('/login', 'LoginController@login');
// });

Route::group(['middleware' => ['auth', 'role:superadmin|admin']], function () {
    Route::get('/home', 'HomeController@index');

    Route::get('/informasi/kategori', 'KategoriController@index');
    Route::get('/informasi/kategori/add', 'KategoriController@create');
    Route::post('/informasi/kategori/add', 'KategoriController@store');
    Route::get('/informasi/kategori/edit/{id}', 'KategoriController@edit');
    Route::post('/informasi/kategori/edit/{id}', 'KategoriController@update');
    Route::get('/informasi/kategori/delete/{id}', 'KategoriController@delete');

    Route::get('/informasi/berita', 'BeritaController@index');
    Route::get('/informasi/berita/add', 'BeritaController@create');
    Route::post('/informasi/berita/add', 'BeritaController@store');
    Route::get('/informasi/berita/edit/{id}', 'BeritaController@edit');
    Route::post('/informasi/berita/edit/{id}', 'BeritaController@update');
    Route::get('/informasi/berita/delete/{id}', 'BeritaController@delete');

    Route::get('/data/user', 'UserController@index');
    Route::get('/data/user/add', 'UserController@create');
    Route::post('/data/user/add', 'UserController@store');
    Route::get('/data/user/edit/{id}', 'UserController@edit');
    Route::get('/data/user/reset/{id}', 'UserController@reset');
    Route::post('/data/user/edit/{id}', 'UserController@update');
    Route::get('/data/user/delete/{id}', 'UserController@delete');

    Route::get('/data/satuan', 'SatuanController@index');
    Route::get('/data/satuan/add', 'SatuanController@create');
    Route::post('/data/satuan/add', 'SatuanController@store');
    Route::get('/data/satuan/edit/{id}', 'SatuanController@edit');
    Route::post('/data/satuan/edit/{id}', 'SatuanController@update');
    Route::get('/data/satuan/delete/{id}', 'SatuanController@delete');

    Route::get('/data/kelompok', 'KelompokController@index');
    Route::get('/data/kelompok/add', 'KelompokController@create');
    Route::post('/data/kelompok/add', 'KelompokController@store');
    Route::get('/data/kelompok/edit/{id}', 'KelompokController@edit');
    Route::post('/data/kelompok/edit/{id}', 'KelompokController@update');
    Route::get('/data/kelompok/delete/{id}', 'KelompokController@delete');

    Route::post('/data/pasar/petugas', 'PasarController@petugas');
    Route::get('/data/pasar/{id}/hapus-petugas', 'PasarController@hapusPetugas');

    Route::get('/data/nomoraduan', 'AduanController@index');
    Route::post('/data/nomoraduan', 'AduanController@update');

    Route::get('/data/hargaacuan', 'HargaAcuanController@index');
    Route::get('/data/hargaacuan/add', 'HargaAcuanController@create');
    Route::post('/data/hargaacuan/add', 'HargaAcuanController@store');
    Route::get('/data/hargaacuan/bapok/{id}', 'HargaAcuanController@hargaacuan');
    Route::post('/data/hargaacuan/bapok/{id}', 'HargaAcuanController@storeHargaAcuan');
    Route::get('/data/hargaacuan/delete/{id}', 'HargaAcuanController@delete');

    Route::get('/data/pasar', 'PasarController@index');
    Route::get('/data/pasar/add', 'PasarController@create');
    Route::post('/data/pasar/add', 'PasarController@store');
    Route::get('/data/pasar/bapok/{id}', 'PasarController@bapok');
    Route::get('/data/pasar/generateharga', 'PasarController@generateHarga');
    Route::post('/data/pasar/bapok/{id}', 'PasarController@updateBapok');
    Route::get('/data/pasar/edit/{id}', 'PasarController@edit');
    Route::post('/data/pasar/edit/{id}', 'PasarController@update');
    Route::get('/data/pasar/delete/{id}', 'PasarController@delete');
    Route::get('/data/pasar/lokasi/{id}', 'PasarController@lokasi');
    Route::get('/data/pasar/harga/{id}', 'PasarController@harga');
    Route::post('/data/pasar/harga/{id}/tahunbulan', 'PasarController@bulanTahun');
    Route::get('/data/pasar/harga/{id}/delete/{bulan_id}', 'PasarController@deleteBulanTahun');
    Route::get('/data/pasar/harga/{id}/acuan/{bulan_id}', 'PasarController@acuan');
    Route::post('/data/pasar/harga/{id}/acuan/{bulan_id}', 'PasarController@storeAcuan');

    Route::post('/data/pasar/lokasi/{id}', 'PasarController@updateLokasi');

    Route::get('/home/ews', 'EWSController@ews');

    Route::get('/home/wa-notifikasi', 'NotifikasiController@kirimNotif');
    Route::get('/data/notifikasi/kirim/{id}', 'NotifikasiController@sendNotif');
    Route::get('/data/notifikasi', 'NotifikasiController@index');
    Route::get('/data/notifikasi/add', 'NotifikasiController@create');
    Route::post('/data/notifikasi/add', 'NotifikasiController@store');
    Route::get('/data/notifikasi/edit/{id}', 'NotifikasiController@edit');
    Route::post('/data/notifikasi/edit/{id}', 'NotifikasiController@update');
    Route::get('/data/notifikasi/delete/{id}', 'NotifikasiController@delete');

    Route::get('/data/bahan', 'BahanController@index');
    Route::get('/data/bahan/add', 'BahanController@create');
    Route::post('/data/bahan/add', 'BahanController@store');
    Route::get('/data/bahan/edit/{id}', 'BahanController@edit');
    Route::post('/data/bahan/edit/{id}', 'BahanController@update');
    Route::get('/data/bahan/delete/{id}', 'BahanController@delete');

    Route::get('/data/gantipassword', 'GantiPassController@index');
    Route::post('/data/gantipassword', 'GantiPassController@change');


    Route::get('/input/harga', 'HargaController@index');
    Route::post('/input/harga/update', 'HargaController@updateService');
    Route::get('/input/harga/fulldate/{id}', 'HargaController@fullDate');
    Route::get('/input/harga/{id}', 'HargaController@pasar');
    Route::get('/input/harga/bahan/sekarang', 'HargaController@storeHargaBahan');

    Route::get('/input/stok', 'StokController@index');
    Route::get('/input/stok/month/{id}', 'StokController@month');
    Route::post('/input/stok/update', 'StokController@updateService');
    Route::get('/input/stok/{id}', 'StokController@pasar');

    Route::get('/informasi/slider', 'SliderController@index');
    Route::get('/informasi/slider/add', 'SliderController@create');
    Route::post('/informasi/slider/add', 'SliderController@store');
    Route::get('/informasi/slider/edit/{id}', 'SliderController@edit');
    Route::post('/informasi/slider/edit/{id}', 'SliderController@update');
    Route::get('/informasi/slider/delete/{id}', 'SliderController@delete');


    Route::get('/report/harga/rata-rata/harian', 'ReportController@harian');
    Route::get('/report/harga/rata-rata/harian/search', 'ReportController@searchHarian');
    Route::get('/report/harga/rata-rata/bulanan', 'ReportController@bulanan');
    Route::get('/report/harga/rata-rata/bulanan/search', 'ReportController@searchBulanan');
    Route::get('/report/stok/bulanan', 'ReportController@stok');
    Route::get('/report/stok/grafik', 'ReportController@grafik_stok');
    Route::get('/report/stok/grafik/search', 'ReportController@search_grafik_stok');
});

Route::get('/logout', 'LoginController@logout');
