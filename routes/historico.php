<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoricoController;


Route:: get('/historicos', [HistoricoController::class, 'index'])->name('historico.index');
Route:: get('/historicos/create', [HistoricoController::class, 'create'])->name('historico.create');
Route:: post('/historicos', [HistoricoController::class, 'store'])->name('historico.store');
Route::get('/historicos/{historico}', [HistoricoController::class, 'show'])->name('historico.show');
Route::get('/historicos/{historico}/edit', [HistoricoController::class,'edit'])->name('historico.edit');
Route::put('/historicos/{historico}', [HistoricoController::class, 'update'])->name('historico.update');
Route::delete('/historicos/{historico}', [HistoricoController::class, 'destroy'])->name('historico.destroy');
?>