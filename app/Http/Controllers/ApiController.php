<?php

namespace App\Http\Controllers;

use App\Models\Impressora;
use App\Models\Leitura;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function impressoras(): JsonResponse
    {
        return response()->json(Impressora::all());
    }

    public function leituras(): JsonResponse
    {
        $leituras = Leitura::with('impressora')->get()->map(function (Leitura $leitura) {
            $leitura->diferenca = $leitura->contador_anterior
                ? $leitura->contador - $leitura->contador_anterior
                : 0;
            return $leitura;
        });

        return response()->json($leituras);
    }

    public function storeLeitura(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'impressora_id' => 'required|integer|exists:impressoras,id',
            'contador'      => 'required|integer|min:0',
        ]);

        $impressoraId    = (int) $validated['impressora_id'];
        $contadorNovo    = (int) $validated['contador'];
        $contadorAnterior = Leitura::where('impressora_id', $impressoraId)
            ->latest('id')
            ->value('contador');

        $leitura = Leitura::create([
            'impressora_id'     => $impressoraId,
            'contador'          => $contadorNovo,
            'contador_anterior' => $contadorAnterior,
            'data_leitura'      => now(),
        ]);

        return response()->json([
            'status'           => 'ok',
            'leitura'          => $leitura,
            'contador_anterior' => $contadorAnterior,
        ]);
    }
}
