<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;

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

Route::middleware(['guest'])->group (function () { 
    
    Route::get('/', [AuthController::class, 'index'])->name('login.page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::get('/absensi', [AbsensiController::class, 'showAbsensiPage'])->name('absensi.page');

Route::get('dashboard', [DashboardController::class, 'showDashboardPage'])->name('dashboard.page');

Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.page');

Route::get('history', [HistoryController::class, 'showHistoryPage'])->name('history.page');

Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.page');

Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

Route::resource('user', userController::class);

Route::post('/absensi/masuk', [AbsensiController::class, 'absenMasuk'])->name('absensi.masuk');

Route::post('/absensi/pulang', [AbsensiController::class, 'absenPulang'])->name('absensi.pulang');






route::middleware(['auth'])->group(function () {


 });

