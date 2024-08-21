<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|       
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', [AuthController::class, 'login']);

ROute::post('/logout', [AuthController::class, 'logout']);

Route::get('dashboard', [DashboardController::class, 'index']);

Route::resource('user', UserController::class);

Route::post('absensi/masuk', [AbsensiController::class, 'absenMasuk']);

Route::get('absensi', [AbsensiController::class, 'index']);

Route::get('absensi/{user_id}', [AbsensiController::class, 'getAbsensiById']);    

Route::post('absensi/pulang', [AbsensiController::class, 'absenPulang']);

Route::get('absensi/rekap', [AbsensiController::class, 'index']);

Route::get('history/{user_id}', [HistoryController::class, 'getAbsensiById']);
 
Route::group(['middleware' => ['jwt:auth']], function () {
    
    

 });



