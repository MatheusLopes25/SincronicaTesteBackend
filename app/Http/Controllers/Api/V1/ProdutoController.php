<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Validation\Validator;
class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $pagina = $request->get('pagina', 1); // padrão: 1
        $porPagina = $request->get('por_pagina', 10);
        

        // Calcular o offset
        $offset = ($pagina - 1) * $porPagina;


        $produtos = Produto::with('categoria')->skip($offset)->take($porPagina)->get();

        $total = Produto::count();

        return response()->json([
            'produtos' => $produtos,
            'pagina' => (int) $pagina,
            'por_pagina' => (int) $porPagina,
            'total' => $total
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

         // Pega os dados somente dos campos descritos;
        $data = $request->only(['nome', 'preco', 'descricao', 'categoria_id']);

        try{
            // Validação com validate
           $request->validate([
                'nome' => 'required|string|max:255',
                'preco' => 'required|decimal:2',
                'descricao' => 'nullable|string',
                'categoria_id' => 'required|integer|exists:categorias,id',
            ],[
                'nome.required' => 'O nome do produto é obrigatório.',
                'preco.required' => 'O preço é obrigatório.',
                'preco.decimal'  => 'O preço deve ser um decimal válido com duas casas decimais. Ex: 9.99',
                'descricao.string' => 'A descrição deve ser um texto válido',
                'categoria_id.required' => 'A categoria é obrigatória.',
                'categoria_id.exists'   => 'A categoria informada não existe.',
            ]);

        // Verificação manual da categoria
        $produto = Produto::create($data);

        return response()->json($produto, 201);

        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['erros' => $e->errors()], 422);
        }
       
    }

    /**
     * Display the specified resource.
     */
    public function show($produtoId)
    {       

        $produto = Produto::find($produtoId);

        if(!$produto){
            return response()->json([
                'erro' => 'Produto não encontrado.'
            ], 404);
        }

        return $produto->load('categoria');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {      

        
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'erro' => 'Produto não encontrado.'
            ], 404);
        }


       

        try{
             // Pega os dados somente dos campos descritos;
            $data = $request->only(['nome', 'preco', 'descricao', 'categoria_id']);
            // Validação com validate
           $request->validate([
                'nome' => 'required|string|max:255',
                'preco' => 'required|decimal:2',
                'descricao' => 'nullable|string',
                'categoria_id' => 'required|integer|exists:categorias,id',
            ],[
                'nome.required' => 'O nome do produto é obrigatório.',
                'nome.string' => 'O nome do produto deve ser um texto.',
                'preco.required' => 'O preço é obrigatório.',
                'preco.decimal'  => 'O preço deve ser um decimal válido com duas casas decimais. Ex: 9.99',
                'descricao.string' => 'A descrição deve ser um texto válido',
                'categoria_id.required' => 'A categoria é obrigatória.',
                'categoria_id.exists'   => 'A categoria informada não existe.',
            ]);

            $produto->update($data);
            return $produto;
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['erros' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($produtoID)
    {   
        $produto = Produto::find($produtoID);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado.'], 404);
        }
        
        $produto->delete();
        return response()->noContent(); // Retorna status 204
    }
}
