<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;
class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria = Categoria::first(); //Já tem que existir uma categoria cadastrada para pegar o id.

        Produto::create([
            'nome' => 'Smartphone',
            'preco' => 1999.99,
            'descricao' => "Smartphone com 4gb de ram, 250 de armazenamento",
            'categoria_id' => $categoria->id
        ]);
        
    }
}
