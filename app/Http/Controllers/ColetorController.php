<?php

namespace App\Http\Controllers;

class ColetorController extends Controller
{
    public function status()
    {
        $logPath = base_path('script/coletor.log');
        $log = [];
        $lastRun = null;
        $lastStatus = 'Nenhuma execução registrada';

        $resolvedPath = realpath($logPath);
        $allowedDir   = realpath(base_path('script'));

        if ($resolvedPath && str_starts_with($resolvedPath, $allowedDir) && file_exists($resolvedPath)) {
            $lines = array_filter(
                explode(PHP_EOL, file_get_contents($resolvedPath)),
                fn($l) => trim($l) !== ''
            );
            $log = array_slice($lines, -50);

            if (!empty($log)) {
                $lastLine = end($log);
                if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $lastLine, $matches)) {
                    $lastRun = $matches[0];
                }
                $lastStatus = match(true) {
                    stripos($lastLine, 'ERROR') !== false,
                    stripos($lastLine, 'Falha') !== false  => 'Falha na última execução',
                    stripos($lastLine, 'sucesso') !== false,
                    stripos($lastLine, 'INFO') !== false   => 'Última execução concluída com sucesso',
                    default                                => 'Última execução registrada',
                };
            }
        }

        return view('coletor_status', compact('log', 'lastRun', 'lastStatus', 'logPath'));
    }
}
