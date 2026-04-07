<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImpressoraController;



Route::get('/', [ImpressoraController::class, 'index']);

Route::get('/status', function () {
    $logPath = base_path('script/coletor.log');
    $log = [];
    $lastRun = null;
    $lastStatus = 'Nenhuma execução registrada';

    if (file_exists($logPath)) {
        $contents = file_get_contents($logPath);
        $lines = array_filter(explode(PHP_EOL, $contents), function ($line) {
            return trim($line) !== '';
        });
        $log = array_slice($lines, -50);

        if (!empty($log)) {
            $lastLine = end($log);

            if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $lastLine, $matches)) {
                $lastRun = $matches[0];
            }

            if (stripos($lastLine, 'ERROR') !== false || stripos($lastLine, 'Falha') !== false) {
                $lastStatus = 'Falha na última execução';
            } elseif (stripos($lastLine, 'INFO') !== false || stripos($lastLine, 'sucesso') !== false || stripos($lastLine, 'sucesso') !== false) {
                $lastStatus = 'Última execução concluída com sucesso';
            } else {
                $lastStatus = 'Última execução registrada';
            }
        }
    }

    return view('coletor_status', compact('log', 'lastRun', 'lastStatus', 'logPath'));
});
