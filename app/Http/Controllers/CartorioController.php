<?php

namespace App\Http\Controllers;

use App\Models\Cartorio;
use App\Models\Municipio;
use App\Models\Estado;
use Illuminate\Http\Request;

class CartorioController extends Controller
{
    //Mostra a lista de cartórios cadastrados
    public function index()
    {
        
        $cartorios = Cartorio::all();
        return view('cartorios.index', compact('cartorios'));
    }

    //Retorna a view de cadastro com a lista de estados e municípios 
    public function create()
    {
        $estados = Estado::all();
        $municipios = Municipio::all(); 
        return view('cartorios.create', compact('estados', 'municipios'));
    }

    //Valida e salva um novo cartório no banco de dados 
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:3',
            'cnpj' => 'required|unique:cartorios,cnpj',
            'nome_tabeliao' => 'required',
            'municipio_id' => 'required',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado!',
        ]);

        $dados = $request->all();
        $dados['ativo'] = $request->input('ativo', 0);

        Cartorio::create($dados);

        return redirect()->route('cartorios.index')->with('success', 'Salvo com sucesso!');
    }

     //recupera os dados de um cartório específico para edição 
    public function edit($id)
    {
        $cartorio = Cartorio::findOrFail($id);
        $estados = Estado::all();
        $municipios = Municipio::all();

        return view('cartorios.edit', compact('cartorio', 'estados', 'municipios'));
    }   
   
    //Valida as alterações e atualiza o registro no banco 
    public function update(Request $request, $id)
    {
        $cartorio = Cartorio::findOrFail($id);

        $request->validate([
            'nome' => 'required|min:3',
            'cnpj' => 'required|unique:cartorios,cnpj,' . $id,
            'nome_tabeliao' => 'required',
            'municipio_id' => 'required',
        ], [
            'cnpj.unique' => 'Este CNPJ já pertence a outro cartório!',
        ]);
        
        $dados = $request->all();
        $dados['ativo'] = $request->input('ativo', 0); 
        
        $cartorio->update($dados);
        return redirect()->route('cartorios.index')->with('success', 'Atualizado com sucesso!');
    }

    //Remove um registro do banco de dados 
    public function destroy($id)
    {
        $cartorio = Cartorio::findOrFail($id);
        $cartorio->delete();

        return redirect()->route('cartorios.index')->with('success', 'Excluído com sucesso!');
    }

    public function show($id)
    {
        return redirect()->route('cartorios.edit', $id);
    }
}