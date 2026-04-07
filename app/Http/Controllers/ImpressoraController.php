<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Impressora;
use App\Models\Leitura;

class ImpressoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = Impressora::with(['leituras' => function ($query) {
            $query->latest('id')->take(2);
        }])->get();

        foreach ($stats as $imp) {
            $leituras = $imp->leituras;

            $imp->contador_atual = optional($leituras->get(0))->contador;
            $imp->contador_anterior = optional($leituras->get(1))->contador;
            $imp->consumo = max(0,
                optional($leituras->get(0))->contador -
                optional($leituras->get(1))->contador
            );
        }

        return view('impressora.index', compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'modelo' => 'required',
            'serie' => 'required',
            'ip' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $impressora = Impressora::find($id);
        return view('impressora.show', compact('impressora'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $impressora = Impressora::find($id);
        return view('impressora.edit', compact('impressora'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required',
            'modelo' => 'required',
            'serie' => 'required',
            'ip' => 'required',
        ]);

        $impressora = Impressora::find($id);
        $impressora->update($request->all());
        return redirect()->route('impressora.index')->with('success', 'Impressora atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $impressora = Impressora::find($id);
        $impressora->delete();
        return redirect()->route('impressora.index')->with('success', 'Impressora excluída com sucesso!');
    }
}
