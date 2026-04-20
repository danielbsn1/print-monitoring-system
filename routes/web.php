<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImpressoraController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::get('/', [ImpressoraController::class, 'index']);
    Route::resource('impressoras', ImpressoraController::class);

    Route::get('/status', function () {
        $logPath = base_path('script/coletor.log');
        $log = [];
        $lastRun = null;
        $lastStatus = 'Nenhuma execução registrada';

        if (file_exists($logPath)) {
            $contents = file_get_contents($logPath);
            $lines = array_filter(explode(PHP_EOL, $contents), fn($l) => trim($l) !== '');
            $log = array_slice($lines, -50);

            if (!empty($log)) {
                $lastLine = end($log);
                if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $lastLine, $matches)) {
                    $lastRun = $matches[0];
                }
                if (stripos($lastLine, 'ERROR') !== false || stripos($lastLine, 'Falha') !== false) {
                    $lastStatus = 'Falha na última execução';
                } elseif (stripos($lastLine, 'sucesso') !== false || stripos($lastLine, 'INFO') !== false) {
                    $lastStatus = 'Última execução concluída com sucesso';
                } else {
                    $lastStatus = 'Última execução registrada';
                }
            }
        }

        return view('coletor_status', compact('log', 'lastRun', 'lastStatus', 'logPath'));
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
