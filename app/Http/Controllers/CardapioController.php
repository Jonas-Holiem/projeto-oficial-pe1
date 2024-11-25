<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public function index()
    {
        // Definindo o cardápio em um array para cada categoria
        $cardapio = [
            "pizzas" => [
                ["nome" => "Pizza Margherita", "preco" => "R$ 39,90", "descricao" => "Molho de tomate, mozzarella e manjericão.", "imagem" => asset('images/pizza_margherita.png')],
                ["nome" => "Pizza Calabresa", "preco" => "R$ 44,90", "descricao" => "Molho de tomate, calabresa e cebolas.", "imagem" => asset('images/pizza_calabresa.png')],
                ["nome" => "Pizza Quatro Queijos", "preco" => "R$ 49,90", "descricao" => "Queijo mozzarella, gorgonzola, parmesão e provolone.", "imagem" => asset('images/pizza_quatro_queijos.png')]
            ],
            "hamburgueres" => [
                ["nome" => "Hambúrguer Clássico", "preco" => "R$ 24,90", "descricao" => "Carne bovina, queijo, alface e tomate.", "imagem" => asset('images/hamburguer_classico.png')],
                ["nome" => "Chicken Duplo", "preco" => "R$ 32,90", "descricao" => "2 peitos de frango empanados, queijo derretido, alface, maionese.", "imagem" => asset('images/chicken_duplo.png')],
                ["nome" => "Hambúrguer Vegano", "preco" => "R$ 28,90", "descricao" => "Hambúrguer de grão de bico, alface e molho vegano.", "imagem" => asset('images/hamburguer_vegano.png')]
            ],
            "sushis" => [
                ["nome" => "Sashimi Salmão", "preco" => "R$ 12,90", "descricao" => "Salmão fresco com arroz e alga nori. (6 unidades)", "imagem" => asset('images/sashimi_salmao.png')],
                ["nome" => "Barca média", "preco" => "R$ 45,90", "descricao" => "Sushi com arroz, sashimi salmão com arroz, fatias de salmão. (31 unidades)", "imagem" => asset('images/barca_media.png')],
                ["nome" => "Temaki de Salmão", "preco" => "R$ 22,90", "descricao" => "Temaki de salmão, arroz e alga. (2 unidades)", "imagem" => asset('images/temaki_de_salmao.png')]
            ],
            "bebidas" => [
                ["nome" => "Coca-Cola - Lata (350ml)", "preco" => "R$ 5,90", "descricao" => "Coca-Cola - Lata (350ml).", "imagem" => asset('images/coca-cola.png')],
                ["nome" => "Fanta Laranja - Lata (350ml)", "preco" => "R$ 5,90", "descricao" => "Fanta Laranja - Lata (350ml).", "imagem" => asset('images/fanta_laranja.png')],
                ["nome" => "Fanta Uva - Lata (350ml)", "preco" => "R$ 5,90", "descricao" => "Fanta Uva - Lata (350ml).", "imagem" => asset('images/fanta_uva_1.png')],
                ["nome" => "Soda - Lata (350ml)", "preco" => "R$ 5,90", "descricao" => "Soda - Lata (350ml).", "imagem" => asset('images/soda_1.png')],
                ["nome" => "Suco Natural de Laranja (350ml)", "preco" => "R$ 6,90", "descricao" => "Suco natural de laranja (350ml).", "imagem" => asset('images/suco_laranja.png')],
                ["nome" => "Suco Natural de Abacaxi (350ml)", "preco" => "R$ 6,90", "descricao" => "Suco natural de abacaxi (350ml).", "imagem" => asset('images/suco_abacaxi.png')],
                ["nome" => "Água Mineral", "preco" => "R$ 2,90", "descricao" => "Água mineral com ou sem gás.", "imagem" => asset('images/agua.png')]
            ]
        ];

        // Retorna a view com os dados do cardápio
        return view('cardapio', compact('cardapio'));
    }
}

