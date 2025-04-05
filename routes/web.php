<?php

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\PenagihanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NominatifImportController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogUserActivity; // Pastikan ini sudah dibuat

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', LogUserActivity::class])->name('dashboard');

Route::middleware(['auth', LogUserActivity::class])->group(function () {

    Route::get('/', [FrontController::class, 'index'])->name('front.index');

    /* Penagihan route section */
    Route::prefix('penagihan')->group(function () {
        Route::get('/', [PenagihanController::class, 'index'])->name('penagihan.index');
        Route::get('/create', [PenagihanController::class, 'create'])->name('penagihan.create');
        Route::post('/create', [PenagihanController::class, 'store'])->name('penagihan.store');
        Route::get('/take', [PenagihanController::class, 'take'])->name('penagihan.take');
        Route::get('/preview', [PenagihanController::class, 'preview'])->name('penagihan.take.preview');
        Route::get('/snapshot/{image}', [PenagihanController::class, 'snapshot'])->name('penagihan.snapshot');
        Route::get('/detail/{uuid}', [PenagihanController::class, 'detail'])->name('penagihan.detail');
        Route::delete('/{uuid}', [PenagihanController::class, 'destroy'])->name('penagihan.destroy');
        Route::get('/{uuid}/edit', [PenagihanController::class, 'edit'])->name('penagihan.edit');
        Route::put('/{uuid}', [PenagihanController::class, 'update'])->name('penagihan.update');
    });

    /* Profile routes */
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /* Kredit route section */
    Route::prefix('nominatif')->group(function () {
        Route::get('/', [KreditController::class, 'index'])->name('nominatif.index');
        Route::get('/cabang/{branch_code}', [KreditController::class, 'showByBranch'])->name('nominatif.cabang');
        Route::get('/rekap/kolektibilitas/{branch_code}', [KreditController::class, 'recapByKol'])->name('nominatif.rekap.kol');
        Route::get('/rekap/produk/{branch_code}', [KreditController::class, 'recapByProduk'])->name('nominatif.rekap.produk');
        Route::get('/import', [NominatifImportController::class, 'form'])->name('nominatif.import.form');
        Route::post('/import', [NominatifImportController::class, 'import'])->name('nominatif.import.process');
    });

    /* Notification routes */
    Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::post('/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    });

});

Route::get('/404', [ErrorController::class, 'notFound'])->name('pages.404');

require __DIR__.'/auth.php';
