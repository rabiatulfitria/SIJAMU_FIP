<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\timjamuController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/TimPenjaminanMutu', [timjamuController::class, 'index'])->name('TimJAMU');
Route::get('/TimPenjaminanMutu/tambahTimJAMU', [timjamuController::class, 'create'])->name('tambahTimJAMU');
Route::post('/TimPenjaminanMutu', [timjamuController::class, 'store']);
