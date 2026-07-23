<?php

use App\Http\Controllers\API\RestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [RestController::class, 'user']);
    Route::post('/gantipassword', [RestController::class, 'gantipassword']);
    Route::post('/komoditi', [RestController::class, 'komoditi']);
    Route::post('/komoditi/update', [RestController::class, 'updateKomoditi']);
});
Route::post('/login', [RestController::class, 'login']);

// Info Harga API - Public endpoints
Route::get('/info-harga/pasar', [RestController::class, 'listPasar']);
Route::get('/info-harga', [RestController::class, 'infoHarga']);

// Pasar API - Public endpoint
Route::get('/pasar', [RestController::class, 'pasar']);
