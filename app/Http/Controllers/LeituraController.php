<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Impressora;
use App\Models\Leitura;

class LeituraController extends Controller
{
    public function index()
    {
        $stats = Impressora::with(['leituras' => function ($q) {
            $q->latest('id')->take(2);
        }])->get();

        foreach ($stats as $imp) {
            $leituras = $imp->leituras;
            $imp->consumo = max(0,
                optional($leituras->get(0))->contador -
                optional($leituras->get(1))->contador
            );
        }

        return view('impressora.index', compact('stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'impressora_id' => 'required|integer|exists:impressoras,id',
            'contador'      => 'required|integer|min:0',
            'data_leitura'  => 'nullable|date',
        ]);

        $anterior = Leitura::where('impressora_id', $validated['impressora_id'])
            ->latest('id')
            ->value('contador');

        Leitura::create([
            'impressora_id'     => $validated['impressora_id'],
            'contador'          => $validated['contador'],
            'contador_anterior' => $anterior,
            'data_leitura'      => $validated['data_leitura'] ?? now(),
        ]);

        return redirect()->route('impressoras.index')->with('success', 'Leitura registrada com sucesso!');
    }
}
