<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeituraController;

Route:: get('/leituras', [LeituraController::class, 'index'])->name('leitura.index');
Route:: get('/leituras/create', [LeituraController::class, 'create'])->name('leitura.create');
Route:: post('/leituras', [LeituraController::class, 'store'])->name('leitura.store');
Route::get('/leituras/{leitura}', [LeituraController::class, 'show'])->name('leitura.show');
Route::get('/leituras/{leitura}/edit', [LeituraController::class,'edit'])->name('leitura.edit');
Route::put('/leituras/{leitura}', [LeituraController::class, 'update'])->name('leitura.update');
Route::delete('/leituras/{leitura}', [LeituraController::class, 'destroy'])->name('leitura.destroy');
?>