<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImpressoraController;

Route:: get('/impressoras', [ImpressoraController::class, 'index'])->name('impressora.index');
Route:: get('/impressoras/create', [ImpressoraController::class, 'create'])->name('impressora.create');
Route:: post('/impressoras', [ImpressoraController::class, 'store'])->name('impressora.store');
Route::get('/impressoras/{impressora}', [ImpressoraController::class, 'show'])->name('impressora.show');
Route::get('/impressoras/{impressora}/edit', [ImpressoraController::class, 'edit'])->name('impressora.edit');
Route::put('/impressoras/{impressora}', [ImpressoraController::class, 'update'])->name('impressora.update');
Route::delete('/impressoras/{impressora}', [ImpressoraController::class, 'destroy'])->name('impressora.destroy');   


?>