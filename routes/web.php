<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImpressoraController;
use App\Http\Controllers\ColetorController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [ImpressoraController::class, 'index']);
    Route::resource('impressoras', ImpressoraController::class);
    Route::get('/status', [ColetorController::class, 'status']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
