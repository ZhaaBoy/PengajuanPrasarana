<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::middleware('can:manage-users')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    });

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');

    Route::middleware('role:guru')->group(function () {
        Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
        Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
        Route::get('/pengajuan/{id}/cetak', [PengajuanController::class, 'cetak'])->name('pengajuan.cetak');
    });

    // === ADMINISTRASI & KEPALA SEKOLAH ===
    Route::middleware('role:kepala_sekolah,administrasi')->group(function () {
        Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');
        Route::get('/pengajuan/{id}/review', [PengajuanController::class, 'review'])->name('pengajuan.review');
        Route::post('/pengajuan/{id}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
        Route::post('/pengajuan/{id}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
    });
});
