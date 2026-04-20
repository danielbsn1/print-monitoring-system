<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Impressora;

class ImpressoraController extends Controller
{
    public function index()
    {
        $stats = Impressora::with(['leituras' => function ($query) {
            $query->latest('id')->take(2);
        }])->get();

        foreach ($stats as $imp) {
            $leituras = $imp->leituras;
            $imp->contador_atual    = optional($leituras->get(0))->contador;
            $imp->contador_anterior = optional($leituras->get(1))->contador;
            $imp->consumo = max(0,
                optional($leituras->get(0))->contador -
                optional($leituras->get(1))->contador
            );
        }

        return view('impressora.index', compact('stats'));
    }

    public function create()
    {
        return view('impressora.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'   => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'serie'  => 'required|string|max:100',
            'ip'     => 'required|ip',
        ]);

        Impressora::create($request->only('nome', 'modelo', 'serie', 'ip'));

        return redirect()->route('impressoras.index')->with('success', 'Impressora cadastrada com sucesso!');
    }

    public function show(string $id)
    {
        $impressora = Impressora::with(['leituras' => function ($q) {
            $q->latest('id')->take(30);
        }])->findOrFail($id);

        return view('impressora.show', compact('impressora'));
    }

    public function edit(string $id)
    {
        $impressora = Impressora::findOrFail($id);
        return view('impressora.edit', compact('impressora'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome'   => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'serie'  => 'required|string|max:100',
            'ip'     => 'required|ip',
        ]);

        Impressora::findOrFail((int) $id)->update($request->only('nome', 'modelo', 'serie', 'ip'));

        return redirect()->route('impressoras.index')->with('success', 'Impressora atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        Impressora::findOrFail($id)->delete();
        return redirect()->route('impressoras.index')->with('success', 'Impressora excluída com sucesso!');
    }
}
