<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HamburgueresController extends Controller
{
    public function index()
    {
        // Definindo o cardápio em um array para cada categoria
        $hamburgueres = [
            "hambúrgueres" => [
                ["nome" => "Hambúrguer Clássico", "preco" => "R$ 24,90", "descricao" => "Carne bovina, queijo, alface e tomate.", "imagem" => asset('images/hamburguer_classico.png')],
                ["nome" => "Chicken Duplo", "preco" => "R$ 32,90", "descricao" => "2 peitos de frango empanados, queijo derretido, alface, maionese.", "imagem" => asset('images/chicken_duplo.png')],
                ["nome" => "Hambúrguer Vegano", "preco" => "R$ 28,90", "descricao" => "Hambúrguer de grão de bico, alface e molho vegano.", "imagem" => asset('images/hamburguer_vegano.png')]
            ]
        ];

        // Retorna a view com os dados do cardápio
        return view('hamburgueres', compact('hamburgueres'));
    }
}

