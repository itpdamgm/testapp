<?php

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

Route::redirect('/', '/login');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

    Route::middleware('check.access:USERS')->group(function() {
        Route::get('users/data',[\App\Http\Controllers\PenggunaController::class,'data'])->name('users.data');
        Route::resource('users', \App\Http\Controllers\PenggunaController::class);
    });

    Route::middleware('check.access:SIGN')->group(function() {
        Route::get('signatures/data',[\App\Http\Controllers\SignatureController::class,'data'])->name('signatures.data');
        Route::resource('signatures', \App\Http\Controllers\SignatureController::class);
    });

    Route::middleware('check.access:TYPE')->group(function() {
        Route::get('types/data',[\App\Http\Controllers\TypeController::class,'data'])->name('types.data');
        Route::resource('types', \App\Http\Controllers\TypeController::class);
    });

    Route::middleware('check.access:POSITION')->group(function() {
        Route::get('positions/data',[\App\Http\Controllers\PositionController::class,'data'])->name('positions.data');
        Route::resource('positions', \App\Http\Controllers\PositionController::class);
    });

    Route::middleware('check.access:COST_TYPE')->group(function() {
        Route::get('cost-types/data',[\App\Http\Controllers\CostTypeController::class,'data'])->name('cost-types.data');
        Route::resource('cost-types', \App\Http\Controllers\CostTypeController::class);
    });

    Route::middleware('check.access:COST')->group(function() {
        Route::get('costs/data',[\App\Http\Controllers\CostController::class,'data'])->name('costs.data');
        Route::resource('costs', \App\Http\Controllers\CostController::class);
    });

    Route::middleware('check.access:SRT_TGS')->group(function() {
        Route::get('surat-tugas/data',[\App\Http\Controllers\SuratTugasController::class,'data'])->name('surat-tugas.data');
        Route::get('surat-tugas/{id}/add-pegawai',[\App\Http\Controllers\SuratTugasController::class,'add_pegawai'])->name('surat-tugas.add-pegawai.index');
        Route::resource('surat-tugas', \App\Http\Controllers\SuratTugasController::class);
    });

    Route::middleware('check.access:SPPD')->group(function() {
        Route::get('sppd/data',[\App\Http\Controllers\SppdController::class,'data'])->name('sppd.data');
        Route::get('sppd/{sppd}/{detail}/print',[\App\Http\Controllers\SppdController::class,'print'])->name('sppd.detail.print');
        Route::resource('sppd', \App\Http\Controllers\SppdController::class);
    });

    Route::middleware('check.access:RAB')->group(function() {
        Route::get('rab/data',[\App\Http\Controllers\RabController::class,'data'])->name('rab.data');
        Route::resource('rab', \App\Http\Controllers\RabController::class);
    });

    Route::middleware('check.access:REAL')->group(function() {
        Route::get('realisasi/data',[\App\Http\Controllers\RabRealisasiController::class,'data'])->name('realisasi.data');
        Route::resource('realisasi', \App\Http\Controllers\RabRealisasiController::class);
    });
});
