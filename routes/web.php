<?php

use App\Models\Sppd;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AkomodasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisTugasController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\TiketPergiController;
use App\Http\Controllers\UangHarianController;
use App\Http\Controllers\TiketPulangController;
use App\Http\Controllers\CreateSuratTugasController;
use App\Http\Controllers\DokumenSuratTugasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $title = __('Welcome');

    return view('welcome', compact('title'));
})->middleware('guest');

// Export Data Excel
Route::get('/export-sppd/{jenis}', [SppdController::class, 'exportAll'])->name('sppd.export-all');
Route::post('/export-excel/{sppdId}', [SppdController::class, 'exportExcel'])->name('sppd.export');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/user', UserController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/sppd', SppdController::class);
    Route::resource('/jenis', JenisTugasController::class);

    // surat
    Route::resource('/surat', SuratTugasController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::get('/surat/{sppd}/detail', [SuratTugasController::class, 'showDetail'])->name('surat.detail');
    Route::post('/surat/detail', [SuratTugasController::class, 'storeDetail'])->name('surat.detailStore');

    // Dokumen Surat Tugas
    Route::controller(DokumenSuratTugasController::class)->prefix('dokumen-st')
        ->name('dokumen-st.')->group(function () {
            Route::get('/{sppd}', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });

    // Buat Surat Tugas
    Route::controller(CreateSuratTugasController::class)
        ->prefix('surat-tugas')->name('surat-tugas.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    // uang
    Route::resource('/uang', UangHarianController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::get('/uang/{sppd}/detail', [UangHarianController::class, 'showDetail'])->name('uang.detail');
    Route::post('/uang/detail', [UangHarianController::class, 'storeDetail'])->name('uang.detailStore');

    // akomodasi
    Route::resource('/akomodasi', AkomodasiController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::get('/akomodasi/{sppd}/detail', [AkomodasiController::class, 'showDetail'])->name('akomodasi.detail');
    Route::post('/akomodasi/detail', [AkomodasiController::class, 'storeDetail'])->name('akomodasi.detailStore');

    // pergi
    Route::resource('/pergi', TiketPergiController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::get('/pergi/{sppd}/detail', [TiketPergiController::class, 'showDetail'])->name('pergi.detail');
    Route::post('/pergi/detail', [TiketPergiController::class, 'storeDetail'])->name('pergi.detailStore');

    // pulang
    Route::resource('/pulang', TiketPulangController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::get('/pulang/{sppd}/detail', [TiketPulangController::class, 'showDetail'])->name('pulang.detail');
    Route::post('/pulang/detail', [TiketPulangController::class, 'storeDetail'])->name('pulang.detailStore');

    Route::put('/resetpassword/{user}', [UserController::class, 'resetPasswordAdmin'])
        ->name('resetpassword.resetPasswordAdmin');

    Route::get('/tes', function () {
        $data = Sppd::with('pegawais.golongan', 'suratTugas', 'uangHarian', 'akomodasi', 'totalPergi', 'totalPulang')->where('jenis_tugas_id', 1)->get();

        // dd($data->toArray());
        return view('export.sppd', [
            'title' => 'Data SPPD',
            'sppds' => $data,
        ]);
    });
});

require __DIR__ . '/auth.php';
