<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\PenagihanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.index');

    /* Penagihan route section */
    Route::get('/penagihan', [PenagihanController::class, 'index'])->name('penagihan.index');
    Route::get('/penagihan/create', [PenagihanController::class, 'create'])->name('penagihan.create');
    Route::get('/penagihan/take', [PenagihanController::class, 'take'])->name('penagihan.take');
    Route::get('/penagihan/preview', [PenagihanController::class, 'preview'])->name('penagihan.preview');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
