<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FrontController;
use \App\Http\Controllers\PenagihanController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [FrontController::class, 'index'])->name('front.index');

Route::get('/penagihan', [PenagihanController::class, 'index'])->name('penagihan.index');
