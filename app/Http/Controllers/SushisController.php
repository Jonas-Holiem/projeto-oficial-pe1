<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SushisController extends Controller
{
    public function index()
    {
        // Definindo o cardápio em um array para cada categoria
        $sushis = [
            "sushis" => [
                ["nome" => "Sashimi Salmão", "preco" => "R$ 12,90", "descricao" => "Salmão fresco com arroz e alga nori. (6 unidades)", "imagem" => asset('images/sashimi_salmao.png')],
                ["nome" => "Barca média", "preco" => "R$ 45,90", "descricao" => "Sushi com arroz, sashimi salmão com arroz, fatias de salmão. (31 unidades)", "imagem" => asset('images/barca_media.png')],
                ["nome" => "Temaki de Salmão", "preco" => "R$ 22,90", "descricao" => "Temaki de salmão, arroz e alga. (2 unidades)", "imagem" => asset('images/temaki_de_salmao.png')]
            ]
        ];

        // Retorna a view com os dados do cardápio
        return view('sushis', compact('sushis'));
    }
}

