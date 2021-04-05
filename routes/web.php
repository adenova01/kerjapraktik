<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'index']);
Route::get('/Home', [HomeController::class, 'index']);
Route::get('/DataAdmin', [AdminController::class, 'index']);
Route::get('/DataMurid', [MuridController::class, 'index']);
Route::get('/DataBuku', [BukuController::class, 'index']);
Route::get('/DataPeminjam', [PeminjamController::class, 'index']);

Route::post('/Auth', [AuthController::class, 'cekLogin']);
Route::get('/Logout', [AuthController::class, 'Logout']);
