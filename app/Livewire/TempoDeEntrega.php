<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TempoDeEntrega extends Component
{
    public $endereco;
    public $tempoEntrega;

    // Método para calcular o tempo de entrega
    public function calcularTempo()
    {
        $enderecoOrigem = 'Rua das Flores, 123, Centro, São Paulo - SP'; // Localização fixa da loja/empresa
        $enderecoDestino = $this->endereco;

        // Sua chave da API do Google Maps (substitua com a sua chave)
        $apiKey = 'AIzaSyA2mZkEyj5-IdEYFl04AB_z85JdeZ18x-A';

        // Requisição à API do Google Maps
        $response = Http::withOptions(['verify' => false])->get("https://maps.googleapis.com/maps/api/directions/json", [
            'origin' => $enderecoOrigem,
            'destination' => $enderecoDestino,
            'traffic_model' => 'best_guess',
            'departure_time' => 'now',
            'key' => $apiKey,
        ]);
        

        if ($response->successful()) {
            $data = $response->json();

            // Verificar se existe resultado
            if (isset($data['routes'][0]['legs'][0]['duration_in_traffic']['text'])) {
                $this->tempoEntrega = $data['routes'][0]['legs'][0]['duration_in_traffic']['text'];
            } else {
                $this->tempoEntrega = 'Não foi possível calcular o tempo de entrega.';
            }
        } else {
            $this->tempoEntrega = 'Erro ao calcular tempo de entrega.';
        }
    }

    public function render()
    {
        return view('livewire.tempo-de-entrega');
    }
}

