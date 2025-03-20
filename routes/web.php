<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\PenagihanController;
use App\Http\Controllers\ProfileController;
use App\Models\Penagihan;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.index');

    /* Penagihan route section */
    Route::get('/penagihan', [PenagihanController::class, 'index'])->name('penagihan.index');
    Route::get('/penagihan/create', [PenagihanController::class, 'create'])->name('penagihan.create');
    Route::post('/penagihan/create', [PenagihanController::class, 'store'])->name('penagihan.store');
    Route::get('/penagihan/take', [PenagihanController::class, 'take'])->name('penagihan.take');
    Route::get('/penagihan/preview', [PenagihanController::class, 'preview'])->name('penagihan.take.preview');
    Route::get('/penagihan/detail/{uuid}', [PenagihanController::class, 'detail'])->name('penagihan.detail');
    // routes/web.php
    Route::get('/penagihan/{uuid}/edit', [PenagihanController::class, 'edit'])->name('penagihan.edit');
    Route::put('/penagihan/{uuid}', [PenagihanController::class, 'update'])->name('penagihan.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
