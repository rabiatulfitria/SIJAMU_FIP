<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\timjamuController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// route untuk halaman menu Tim Penjaminan Mutu CRUD
Route::get('/TimPenjaminanMutu', [timjamuController::class, 'index'])->name('TimJAMU');
Route::get('/TimPenjaminanMutu/tambahTimJAMU', [timjamuController::class, 'create'])->name('tambahTimJAMU');
Route::put('/TimPenjaminanMutu/{id}/editTimJAMU', [timjamuController::class, 'edit'])->name('editTimJAMU');
Route::delete('/TimPenjaminanMutu/{id}', [timjamuController::class, 'timjamuController@destroy'])->name('hapusTimJAMU');
Route::post('/TimPenjaminanMutu', [timjamuController::class, 'store'])->name('jamutims.store');

// contoh route untuk halaman menu Penetapan CRUD
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// route untuk halaman menu Pelaksanaan CRUD
// route untuk halaman menu Evaluasi CRUD
// route untuk halaman menu Pengendalian CRUD
// route untuk halaman menu Peningkatan CRUD

