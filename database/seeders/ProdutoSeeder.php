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
        Produto::create([
            'nome' => 'Smart Tv Sansung',
            'preco' => 5000.00,
            'descricao' => "Smart Tv Sansung",
            'categoria_id' => $categoria->id
        ]); 
        Produto::create([
            'nome' => 'Apple notebook MacBook Air',
            'preco' => 8000.00,
            'descricao' => "notebook de 13 polegadas, Processador M1 da Apple com CPU 8‑core e GPU 7‑core, 8 GB RAM, 256 GB",
            'categoria_id' => $categoria->id
        ]);   
        
    }
}
