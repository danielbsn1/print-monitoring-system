<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index()
    {
        return view('historico.index');
    }
    public function create()
    {
        return view('historico.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'impressora_id' => 'required|exists:impressoras,id',
        ]);
        return redirect()->route('historico.index')->with('success','Histórico criado com sucesso!');
        
    }
    public function show($id)
    {
        return view('historico.show', compact('id'));
    }
    public function edit($id)
    {
        return view('historico.edit', compact('id'));

}
   public function update(Request $request, $id)
    {
        $request->validate([
            'impressora_id' => 'required|exists:impressoras,id',
        ]);
        return redirect()->route('historico.index')->with('success','Histórico atualizado com sucesso!');
    }
    public function destroy($id)
    {
        return redirect()->route('historico.index')->with('success','Histórico deletado com sucesso!');
    }
    
}