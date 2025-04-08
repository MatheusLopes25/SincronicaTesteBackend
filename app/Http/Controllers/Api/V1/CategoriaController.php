<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        

        $pagina = $request->get('pagina', 1);
        $porPagina = $request->get('por_pagina', 10);
        

        // Calcular o offset
        $offset = ($pagina - 1) * $porPagina;


        $categorias = Categoria::all()->skip($offset)->take($porPagina);

        $total = Categoria::count();

        return response()->json([
            'categorias' => $categorias,
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
         $data = $request->only(['nome']);

         try{
             // Validação com validate
            $request->validate([
                 'nome' => 'required|string|max:255',
             ],[
                 'nome.required' => 'O nome da categoria é obrigatório.'
             ]);
 
         // Verificação manual da categoria
         $categoria = Categoria::create($data);
 
         return response()->json($categoria, 201);
 
         }catch(ValidationException $e){
             return response()->json(['erros' => $e->errors()], 422);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   

        $categoria = Categoria::find($id);
        if(!$categoria){
            return response()->json([
                'erro' => 'Categoria não encontrada.'
            ], 404);
        }
        return $categoria;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$categoriaID)
    {
        $categoria = Categoria::find($categoriaID);

        if (!$categoria) {
            return response()->json([
                'erro' => 'Categoria não encontrada.'
            ], 404);
        }


       

        try{
             // Pega os dados somente dos campos descritos;
            $data = $request->only(['nome']);
            // Validação com validate
           $request->validate([
                'nome' => 'required|string|max:255',
            ],[
                'nome.required' => 'O nome do categoria é obrigatório.',
                'nome.string' => 'O nome da categoria deve ser um texto.',
            ]);

            $categoria->update($data);
            return $categoria;
        }catch(ValidationException $e){
            return response()->json(['erros' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categoriaID)
    {
        $categoria = Categoria::find($categoriaID);

        if (!$categoria) {
            return response()->json(['error' => 'Categoria não encontrada.'], 404);
        }
        
        $categoria->delete();
        return response()->noContent(); // Retorna status 204
    }
}
