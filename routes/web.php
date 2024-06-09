<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\timjamuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\perangkatController;

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

Route::get('/', function () {
    return view('welcome');
});

// route untuk halaman menu Home atau dashboard
Route::get('/Beranda', [DashboardController::class, 'index'])->name('BerandaSIJAMUFIP');

// route untuk halaman menu Tim Penjaminan Mutu CRUD
Route::get('/TimPenjaminanMutu', [timjamuController::class, 'index'])->name('TimJAMU');
Route::get('/TimPenjaminanMutu/tambahTimJAMU', [timjamuController::class, 'create'])->name('tambahTimJAMU');
Route::get('/TimPenjaminanMutu/editTimJAMU/{id}', [timjamuController::class, 'edit'])->name('editTimJAMU');
Route::post('/TimPenjaminanMutu', [timjamuController::class, 'store'])->name('jamutims.store');
Route::put('/TimPenjaminanMutu/{id}/updateTimJAMU', [timjamuController::class, 'update'])->name('updateTimJAMU');

// route untuk halaman menu Penetapan CRUD -> Perangkat SPMI
Route::get('/Penetapan/PerangkatSPMI', [perangkatController::class, 'index'])->name('penetapan');

// route untuk halaman menu Penetapan CRUD -> Standar Yang Ditetapkan Institusi


// route untuk halaman menu Pelaksanaan CRUD
// route untuk halaman menu Evaluasi CRUD
// route untuk halaman menu Pengendalian CRUD
// route untuk halaman menu Peningkatan CRUD

