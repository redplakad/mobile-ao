<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FrontController;
use \App\Http\Controllers\PenagihanController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::get('/penagihan', [PenagihanController::class, 'index'])->name('penagihan.index');
Route::get('/penagihan/create', [PenagihanController::class, 'create'])->name('penagihan.create');
Route::get('/penagihan/create/take1', [PenagihanController::class, 'take'])->name('penagihan.take-1');
