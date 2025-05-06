<?php

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
// routes/web.php atau routes/api.php
use App\Http\Controllers\RuanganController;

Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');

Route::get('/home', function () {
    return view('home');
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
