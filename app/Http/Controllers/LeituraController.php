<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Impressora;
use App\Models\Leitura;

class LeituraController extends Controller
{
    public function index()
    {
     $stats = Impressora::all();

    foreach ($stats as $imp) {
        $leituras = Leitura::where('impressora_id', $imp->id)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        if ($leituras->count() == 2) {
            $consumo = $leituras[0]->contador - $leituras[1]->contador;
        } else {
            $consumo = 0;
        }

        // adiciona dinamicamente
        $imp->consumo = max(0, $consumo);
    }

    return view('impressoras', compact('stats'));

}

    public function create()
    {
        return view('leitura.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'impressora_id' => $request->impressora_id,
            'contador' => $request->contador,
            'data_leitura' => $request->data_leitura,
        ]);
        return response()->json(['ok' => true]);
        
    }
    public function show($id)
    {
        return view('leitura.show', compact('id'));
    }
    public function edit($id)
    {
        return view('leitura.edit', compact('id'));

}
   public function update(Request $request, $id)
    {
        $request->validate([
            'impressora_id' => 'required|exists:impressoras,id',
            'contador' => 'required|integer',
        ]);
        return redirect()->route('leitura.index')->with('success','Leitura atualizada com sucesso!');
    }
    public function destroy($id)
    {
        return redirect()->route('leitura.index')->with('success','Leitura deletada com sucesso!');
    }

}