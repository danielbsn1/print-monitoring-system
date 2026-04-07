<?php

use Illuminate\Support\Facades\Route;
use App\Models\Impressora;
use App\Models\Leitura ;
use Illuminate\Http\Request;

Route::get('/impressoras', function () {
    return Impressora::all();
});

Route::get('/leituras', function () {
    return Leitura::with('impressora')->get()->map(function ($leitura) {
        $leitura->diferenca = $leitura->contador_anterior ? $leitura->contador - $leitura->contador_anterior : 0;
        return $leitura;
    });
});

Route::post('/leitura', function (Request $request) {
    $request->validate([
        'impressora_id' => 'required|integer|exists:impressoras,id',
        'contador' => 'required|integer|min:0',
    ]);

    try {
        $ultimaLeitura = Leitura::where('impressora_id', $request->impressora_id)
            ->latest('id')
            ->first();

        $contadorAnterior = $ultimaLeitura ? $ultimaLeitura->contador : null;

        $leitura = Leitura::create([
            'impressora_id' => $request->impressora_id,
            'contador' => $request->contador,
            'contador_anterior' => $contadorAnterior,
            'data_leitura' => now(),
        ]);

        return response()->json([
            'status' => 'ok',
            'leitura' => $leitura,
            'contador_anterior' => $contadorAnterior,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => $e->getMessage()
        ], 500);
    }
});