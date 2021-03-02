<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontEndController@beranda');
Route::get('/info-harga', 'FrontEndController@info_harga');
Route::get('/info-stok', 'FrontEndController@info_stok');
Route::get('/grafik', 'FrontEndController@grafik');
Route::get('/login', 'FrontEndController@login');
