<?php

use App\Http\Controllers\auth\Login;
use App\Http\Controllers\auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\standarController;
use App\Http\Controllers\timjamuController;
use App\Http\Controllers\evaluasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Info;
use App\Http\Controllers\Panduanpengguna;
use App\Http\Controllers\perangkatController;
use App\Http\Controllers\peningkatanController;
use App\Http\Controllers\pelaksanaan1Controller;
use App\Http\Controllers\pelaksanaan2Controller;
use App\Http\Controllers\pengendalianController;

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

//AUTH
Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [Login::class, 'index'])->name('auth.login');
    Route::post('/login', [Login::class, 'login'])->name('login');
});

Route::get('/logout', [Login::class, 'logout'])->name('logout');

// Grup route dengan middleware 'ceklogin'
Route::middleware(['cekLogin'])->group(function () {
    Route::get('/', function () {
        return view('User.admin.index');
    });

    // route untuk menu Sign Up, Unduh Panduan Pengguna, Info
    Route::get('/Sign Up', [Register::class, 'index'])->name('form-signup');
    Route::get('/PanduanPengguna', [Panduanpengguna::class, 'index'])->name('FilePanduanPangguna');
    Route::get('/Info', [Info::class, 'index'])->name('info');

    // route untuk halaman menu Home atau dashboard
    Route::get('/Beranda', [DashboardController::class, 'index'])->name('BerandaSIJAMUFIP');

    // route untuk halaman menu Tim Penjaminan Mutu CRUD
    Route::get('/TimPenjaminanMutu', [timjamuController::class, 'index'])->name('TimJAMU');
    Route::get('/TimPenjaminanMutu/tambahTimJAMU', [timjamuController::class, 'create'])->name('tambahTimJAMU');
    Route::get('/TimPenjaminanMutu/editTimJAMU/{id}', [timjamuController::class, 'edit'])->name('editTimJAMU');
    Route::post('/TimPenjaminanMutu', [timjamuController::class, 'store'])->name('jamutims.store');
    Route::delete('/TimPenjaminanMutu/{id}', [timjamuController::class, 'destroy'])->name('hapusTimJAMU');
    Route::put('/TimPenjaminanMutu/{id}/updateTimJAMU', [timjamuController::class, 'update'])->name('updateTimJAMU');

    // route untuk halaman menu Penetapan CRUD -> Perangkat SPMI
    Route::get('/Penetapan/DokumenSPMI', [perangkatController::class, 'index'])->name('penetapan.perangkat');
    Route::get('/Penetapan/tambahDokumenPerangkatSPMI',[perangkatController::class, 'create'])->name('tambahDokumenPerangkat');
    Route::get('/Penetapan/editDokumenPerangkatSPMI/{id_dokspmi}', [perangkatController::class, 'edit'])->name('editDokumenPerangkat');
    Route::resource('/tambahDokumenPerangkatSPMI-2', perangkatController::class);
    Route::get('/dokumenPerangkatSPMI({id_penetapan})', [perangkatController::class, 'lihatdokumenperangkat'])->name('dokumenperangkat');
    Route::delete('/Penetapan/PerangkatSPMI{id_dokspmi}', [perangkatController::class, 'destroy'])->name('hapusDokumenPerangkat');
    Route::put('Penetapan/updateDokumenPerangkat/{id_dokspmi}', [perangkatController::class, 'update'])->name('updateDokumenPerangkat');


    // route untuk halaman menu Penetapan CRUD -> Standar Yang Ditetapkan Institusi
    Route::get('/Penetapan/StandarInstitusi', [standarController::class, 'index'])->name('penetapan.standar');
    // Route::get('/Penetapan/unggahDokumenStandarSPMI/{id}', [standarController::class, 'create'])->name('unggahDokumenStandar');
    Route::get('/Penetapan/tambahDokumenStandarSPMI', [standarController::class, 'create'])->name('tambahStandar'); //tambah dokumen standar
    Route::resource('/tambahDokumenStandar-2', standarController::class);

    // Route::post('/StandarYangDitetapkanInstitusi', [standarController::class, 'store'])->name('standar.store');
    Route::get('/Penetapan/editDokumenStandarSPMI/{id}', [standarController::class, 'edit'])->name('editDataStandar');
    // Route::post('/unggahDokumenStandarSPMI', [standarController::class, 'uploadDokumen']);
    Route::get('/dokumenStandarInstitusi{id_penetapan}', [standarController::class, 'lihatdokumenstandar'])->name('dokumenstandar');
    Route::delete('/Penetapan/StandarSPMI{id}', [standarController::class, 'destroy'])->name('hapusDokumenStandar');
    Route::put('Penetapan/updateDokumenStandar/{id}', [standarController::class, 'update'])->name('updateDokumenStandar');
    // Route::get('/Penetapan/StandarInstitusi/folder/{id}', [standarController::class, 'folder'])->name('FolderDokumenStandar');


    // route untuk halaman menu Pelaksanaan CRUD
    Route::get('/Pelaksanaan/Prodi', [pelaksanaan1Controller::class, 'index'])->name('pelaksanaan.prodi');
    Route::get('/tambah-dokumen-pelaksanaan', [pelaksanaan1Controller::class, 'tambahPelaksanaan'])->name('tambahPelaksanaan');
    Route::post('/simpan-dokumen-pelaksanaan', [pelaksanaan1Controller::class, 'simpanPelaksanaan'])->name('simpanPelaksanaan');;
    Route::get('/edit-dokumen-pelaksanaan/{id_plks_prodi}', [pelaksanaan1Controller::class, 'editPelaksanaan'])->name('editPelaksanaan');;
    Route::post('/update-dokumen-pelaksanaan/{id_plks_prodi}', [pelaksanaan1Controller::class, 'updatePelaksanaan'])->name('updatePelaksanaan');;
    Route::delete('/hapus-dokumen-pelaksanaan{id_plks_prodi}', [pelaksanaan1Controller::class, 'deletePelaksanaan'])->name('deletePelaksanaan');;
    Route::get('/Pelaksanaan/Fakultas', [pelaksanaan1Controller::class, 'indexFakultas'])->name('pelaksanaan.fakultas');
    Route::get('/tambah-dokumen-pelaksanaan-fakultas', [pelaksanaan1Controller::class, 'tambahPelaksanaanFakultas'])->name('tambahPelaksanaanFakultas');
    Route::post('/simpan-dokumen-pelaksanaan-fakultas', [pelaksanaan1Controller::class, 'simpanPelaksanaanFakultas'])->name('simpanPelaksanaanFakultas');;
    Route::get('/edit-dokumen-pelaksanaan-fakultas/{id_plks_fklts}', [pelaksanaan1Controller::class, 'editPelaksanaanFakultas'])->name('editPelaksanaanFakultas');;
    Route::post('/update-dokumen-pelaksanaan-fakultas/{id_plks_fklts}', [pelaksanaan1Controller::class, 'updatePelaksanaanFakultas'])->name('updatePelaksanaanFakultas');;
    Route::delete('/hapus-dokumen-pelaksanaan-fakultas/{id_plks_fklts}', [pelaksanaan1Controller::class, 'deletePelaksanaanFakultas'])->name('deletePelaksanaanFakultas');;

    // route untuk halaman menu Evaluasi CRUD
    Route::get('/Evaluasi/AuditMutuInternal',[evaluasiController::class, 'index'])->name('evaluasi');
    Route::get('/Evaluasi/tambahDokumenEvaluasi',[evaluasiController::class, 'create'])->name('tambahDokumenAMI');
    Route::resource('/tambahDokumenEvaluasi-2', evaluasiController::class);
    Route::get('/dokumenEvaluasi({id_evaluasi})', [evaluasiController::class, 'lihatdokumenevaluasi'])->name('dokumenevaluasi');
    Route::delete('/Evaluasi/PerangkatSPMI{id_evaluasi}', [evaluasiController::class, 'destroy'])->name('hapusDokumenEvaluasi');
    Route::get('/Evaluasi/editDokumenPerangkatSPMI/{id_evaluasi}', [evaluasiController::class, 'edit'])->name('editDokumenEvaluasi');
    Route::put('Evaluasi/updateDokumenEvaluasi/{id_evaluasi}', [evaluasiController::class, 'update'])->name('updateDokumenEvaluasi');

    // route untuk halaman menu Pengendalian CRUD
    Route::get('/Pengendalian/Standar/RTM',[pengendalianController::class, 'index'])->name('pengendalian');
    Route::get('/Pengendalian/tambahDokumenPengendalian',[pengendalianController::class, 'create'])->name('tambahDokumenPengendalian');
    Route::resource('/tambahDokumenPengendalian-2', pengendalianController::class);
    Route::get('/dokumenPengendalian({id_pengendalian})', [pengendalianController::class, 'lihatdokumenpengendalian'])->name('dokumenpengendalian');
    Route::delete('/Pengendalian/hapusPengendalian{id_pengendalian}', [pengendalianController::class, 'destroy'])->name('hapusDokumenPengendalian');
    Route::get('/Pengendalian/editDokumenPengendalian/{id_pengendalian}', [pengendalianController::class, 'edit'])->name('editDokumenPengendalian');
    Route::put('Pengendalian/updateDokumenPengendalian/{id_pengendalian}', [pengendalianController::class, 'update'])->name('updateDokumenPengendalian');

    // route untuk halaman menu Peningkatan CRUD
    Route::get('Peningkatan/StandarInstitusi',[peningkatanController::class, 'index'])->name('peningkatan');
    Route::delete('/Peningkatan/hapusPeningkatan{id_peningkatan}', [peningkatanController::class, 'destroy'])->name('hapusDokumenPeningkatan');
    Route::get('/Peningkatan/editDokumenPeningkatan/{id_peningkatan}', [peningkatanController::class, 'edit'])->name('editDokumenPeningkatan');
    Route::put('Peningkatan/updateDokumenPeningkatan/{id_peningkatan}', [peningkatanController::class, 'update'])->name('updateDokumenPeningkatan');
    
});
