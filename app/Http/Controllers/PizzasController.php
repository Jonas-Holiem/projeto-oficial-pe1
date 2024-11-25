<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PizzasController extends Controller
{
    public function index()
    {
        // Definindo o cardápio em um array para cada categoria
        $pizzas = [
            "pizzas" => [
                ["nome" => "Pizza Margherita", "preco" => "R$ 39,90", "descricao" => "Molho de tomate, mozzarella e manjericão.", "imagem" => asset('images/pizza_margherita.png')],
                ["nome" => "Pizza Calabresa", "preco" => "R$ 44,90", "descricao" => "Molho de tomate, calabresa e cebolas.", "imagem" => asset('images/pizza_calabresa.png')],
                ["nome" => "Pizza Quatro Queijos", "preco" => "R$ 49,90", "descricao" => "Queijo mozzarella, gorgonzola, parmesão e provolone.", "imagem" => asset('images/pizza_quatro_queijos.png')]
            ]
        ];

        // Retorna a view com os dados do cardápio
        return view('pizzas', compact('pizzas'));
    }
}

