<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\MailController;

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

Route::post('/Auth', [AuthController::class, 'cekLogin']);
Route::get('/Logout', [AuthController::class, 'Logout']);

Route::get('/', [AuthController::class, 'index']);

// murid
Route::get('/Home', [HomeController::class, 'index']);
Route::get('/HomeMurid', [MuridController::class, 'home_page']);
Route::get('/HomeMurid/{kode}', [MuridController::class, 'home_page']);

// admin
Route::get('/DataAdmin', [AdminController::class, 'index']);
Route::get('/DataMurid', [MuridController::class, 'index']);
Route::get('/DataBuku', [BukuController::class, 'index']);
Route::get('/DataPeminjam', [PeminjamController::class, 'index']);

// Buku
Route::get('/AddBuku', [BukuController::class, 'create']);
Route::post('/CreateBuku', [BukuController::class, 'store']);
Route::get('/EditBuku/{id}', [BukuController::class, 'edit']);
Route::post('/UpdateBuku/{id}', [BukuController::class, 'update']);
Route::get('/DeleteBuku/{id}', [BukuController::class, 'destroy']);

// peminjam
Route::get('/AddPeminjam', [PeminjamController::class, 'create']);
Route::post('/CreatePeminjam', [PeminjamController::class, 'store']);
Route::get('/EditPeminjam/{id}', [PeminjamController::class, 'edit']);
Route::post('/UpdatePeminjam/{id}', [PeminjamController::class, 'update']);
Route::get('/DeletePeminjam/{id}', [PeminjamController::class, 'destroy']);
Route::get('/UpdateStatus/{id}', [PeminjamController::class, 'update_status']);
Route::get('/UpdateStatus/{id}/{status}', [PeminjamController::class, 'update_status']);

//murid
Route::get('/AddMurid', [MuridController::class, 'create']);
Route::post('/AddMurid', [MuridController::class, 'store']);
Route::post('/UpdateMurid/{id}', [MuridController::class, 'update']);
Route::get('/EditMurid/{id}', [MuridController::class, 'edit']);
Route::get('/DeleteMurid/{id}', [MuridController::class, 'destroy']);
Route::get('/DetilPinjam', [MuridController::class, 'detil_pinjaman']);