<?php

use Illuminate\Support\Facades\Route;
use App\Models\Impressora;
use App\Models\Leitura ;
use Illuminate\Http\Request;

Route::get('/impressoras', function () {
    return Impressora::all();
});

Route::post('/leitura', function (Request $request) {
    try {
        Leitura::create([
            'impressora_id' => $request->impressora_id,
            'contador' => $request->contador,
        ]);

        return response()->json(['status' => 'ok']);

    } catch (\Exception $e) {
        return response()->json([
            'erro' => $e->getMessage()
        ], 500);
    }
});