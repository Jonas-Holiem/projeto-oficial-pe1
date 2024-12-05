<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChatBot extends Component
{
    public $messages = [];
    public $userMessage;

    public function sendMessage()
    {
        if (empty($this->userMessage)) return;

        // Adiciona a mensagem do usuário ao histórico
        $this->messages[] = ['sender' => 'user', 'text' => $this->userMessage];

        // Palavras-chave para categorias e perguntas específicas
        $categoryKeywords = [
            'pizza' => ['pizza', 'pizzas'],
            'hamburguer' => ['hambúrguer', 'lanche', 'hamburgueres', 'hamburguer'],
            'sushi' => ['sushi', 'sushis'],
            'bebida' => ['bebida', 'bebidas', 'refrigerante', 'suco', 'cerveja', 'beber', 'água', 'agua']
        ];

        $specialKeywords = [
            'vegano' => ['vegano', 'vegetariano', 'lanche vegano', 'comida vegana', 'lanche vegetariano', 'vegana']
        ];

        $attendantKeywords = [
            'falar com atendente',
            'entrar em contato',
            'como falo com alguém',
            'ajuda',
            'atendente',
            'suporte'
        ];

        $menuKeywords = ['cardápio', 'comer', 'menu', 'o que tem para comer', 'produto', 'o que tem no menu', 'comida', 'alimento', 'cardapio', 'prato'];
        $paymentKeywords = ['forma de pagamento', 'pagamento', 'como pagar', 'formas de pagamento', 'aceita cartão', 'aceita vale refeição'];

        // Palavras-chave para perguntas de recomendação
        $recommendationKeywords = ['recomendaria', 'recomenda', 'devo escolher', 'recomendação', 'recomeda'];

        // Palavras-chave para perguntas de "mais pedidos"
        $popularKeywords = ['mais pedidos hoje em dia', 'mais pedido', 'mais pedida', 'mais comprado','mais comprada'];

        // Verifica se a mensagem contém palavras-chave de "mais pedidos"
        foreach ($popularKeywords as $keyword) {
            if (stripos($this->userMessage, $keyword) !== false) {
                // Faz a consulta ao GPT-4 sobre o item mais pedido
                try {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    ])->withoutVerifying()->post('https://api.openai.com/v1/chat/completions', [
                        'model' => 'gpt-4',
                        'messages' => array_merge(
                            [['role' => 'system', 'content' => 'Você é um chatbot especializado em tirar dúvidas sobre delivery e tendências de comida.']],
                            array_map(fn($msg) => [
                                'role' => $msg['sender'] === 'user' ? 'user' : 'assistant',
                                'content' => $msg['text'],
                            ], $this->messages)
                        ),
                    ]);

                    if ($response->successful() && isset($response->json()['choices'][0]['message']['content'])) {
                        $aiResponse = $response->json()['choices'][0]['message']['content'];
                        $this->messages[] = ['sender' => 'bot', 'text' => $aiResponse];
                    } else {
                        $errorMessage = $response->json('error.message', 'Erro desconhecido ao obter resposta da IA.');
                        $this->messages[] = ['sender' => 'bot', 'text' => "Desculpe, ocorreu um problema: $errorMessage"];
                    }
                } catch (\Exception $e) {
                    $this->messages[] = ['sender' => 'bot', 'text' => 'Desculpe, ocorreu um erro ao se conectar à API.'];
                }

                $this->userMessage = '';
                return;
            }
        }

        // Verifica se a mensagem contém palavras-chave de recomendação
        foreach ($recommendationKeywords as $keyword) {
            if (stripos($this->userMessage, $keyword) !== false) {
                // Faz a consulta ao GPT-4 para uma recomendação personalizada
                try {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    ])->withoutVerifying()->post('https://api.openai.com/v1/chat/completions', [
                        'model' => 'gpt-4',
                        'messages' => array_merge(
                            [['role' => 'system', 'content' => 'Você é um chatbot especializado em tirar dúvidas sobre delivery e fazer recomendações de cardápio.']],
                            array_map(fn($msg) => [
                                'role' => $msg['sender'] === 'user' ? 'user' : 'assistant',
                                'content' => $msg['text'],
                            ], $this->messages)
                        ),
                    ]);

                    if ($response->successful() && isset($response->json()['choices'][0]['message']['content'])) {
                        $aiResponse = $response->json()['choices'][0]['message']['content'];
                        $this->messages[] = ['sender' => 'bot', 'text' => $aiResponse];
                    } else {
                        $errorMessage = $response->json('error.message', 'Erro desconhecido ao obter resposta da IA.');
                        $this->messages[] = ['sender' => 'bot', 'text' => "Desculpe, ocorreu um problema: $errorMessage"];
                    }
                } catch (\Exception $e) {
                    $this->messages[] = ['sender' => 'bot', 'text' => 'Desculpe, ocorreu um erro ao se conectar à API.'];
                }

                $this->userMessage = '';
                return;
            }
        }

        // Verifica perguntas sobre o cardápio ou comida
        foreach ($menuKeywords as $keyword) {
            if (stripos($this->userMessage, $keyword) !== false) {
                $products = Product::all();
                $menuResponse = "Aqui está o nosso cardápio:\n";

                if ($products->isEmpty()) {
                    $menuResponse = "Desculpe, no momento nosso cardápio está vazio.";
                } else {
                    foreach ($products as $product) {
                        $menuResponse .= "{$product->name} - {$product->description} - R$ {$product->price}\n";
                    }
                }

                $this->messages[] = ['sender' => 'bot', 'text' => $menuResponse];
                $this->userMessage = '';
                return;
            }
        }

        // Verifica perguntas sobre lanches veganos ou vegetarianos
        foreach ($specialKeywords['vegano'] as $keyword) {
            if (stripos($this->userMessage, $keyword) !== false) {
                $veganItem = Product::where('name', 'Hamburguer Vegano')->first();
                if ($veganItem) {
                    $menuResponse = "Sim, temos opções veganas! Aqui está o nosso item disponível:\n";
                    $menuResponse .= "{$veganItem->name} - {$veganItem->description} - R$ {$veganItem->price}";
                } else {
                    $menuResponse = "Desculpe, no momento não temos itens veganos ou vegetarianos disponíveis.";
                }

                $this->messages[] = ['sender' => 'bot', 'text' => $menuResponse];
                $this->userMessage = '';
                return;
            }
        }

        // Verifica perguntas sobre formas de pagamento
        foreach ($paymentKeywords as $keyword) {
            if (stripos($this->userMessage, $keyword) !== false) {
                try {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    ])->withoutVerifying()->post('https://api.openai.com/v1/chat/completions', [
                        'model' => 'gpt-4',
                        'messages' => array_merge(
                            [['role' => 'system', 'content' => 'Você é um chatbot especializado em tirar dúvidas sobre delivery.']],
                            array_map(fn($msg) => [
                                'role' => $msg['sender'] === 'user' ? 'user' : 'assistant',
                                'content' => $msg['text'],
                            ], $this->messages)
                        ),
                    ]);

                    if ($response->successful() && isset($response->json()['choices'][0]['message']['content'])) {
                        $aiResponse = $response->json()['choices'][0]['message']['content'];

                        $aiResponse .= "\n\n**No caso da Hot Delivery**, aceitamos dinheiro, cartão de débito/crédito ou Vale Refeição.";

                        $this->messages[] = ['sender' => 'bot', 'text' => $aiResponse];
                        $this->userMessage = '';
                        return;
                    } else {
                        $errorMessage = $response->json('error.message', 'Erro desconhecido ao obter resposta da IA.');
                        $this->messages[] = ['sender' => 'bot', 'text' => "Desculpe, ocorreu um problema: $errorMessage"];
                    }
                } catch (\Exception $e) {
                    $this->messages[] = ['sender' => 'bot', 'text' => 'Desculpe, ocorreu um erro ao se conectar à API.'];
                }

                return;
            }
        }

        // Verifica perguntas sobre falar com um atendente
        foreach ($attendantKeywords as $keyword) {
            if (stripos($this->userMessage, $keyword) !== false) {
                $attendantResponse = "Para falar com um atendente, aqui estão algumas opções gerais:\n";
                $attendantResponse .= "1. Chat ao vivo: Acesse nosso site e veja se há um chat disponível.\n";
                $attendantResponse .= "2. Telefone: Ligue para a linha de atendimento ao cliente.\n";
                $attendantResponse .= "3. Redes sociais: Você pode nos enviar uma mensagem privada nas redes sociais.\n";
                $attendantResponse .= "\n**No caso da Hot Delivery**, temos uma página de Contato com todas as informações de contato que você precisa. Visite nossa página para mais detalhes.";

                $this->messages[] = ['sender' => 'bot', 'text' => $attendantResponse];
                $this->userMessage = '';
                return;
            }
        }

        // Verifica a categoria mencionada pelo usuário
        $category = null;
        foreach ($categoryKeywords as $key => $keywords) {
            foreach ($keywords as $keyword) {
                if (stripos($this->userMessage, $keyword) !== false) {
                    $category = $key;
                    break 2;
                }
            }
        }

        if ($category) {
            $products = Product::where('category', $category)->get();
            $menuResponse = "Aqui estão as opções de $category:\n";

            if ($products->isEmpty()) {
                $menuResponse = "Desculpe, não há itens de $category no cardápio no momento.";
            } else {
                foreach ($products as $product) {
                    $menuResponse .= "{$product->name} - {$product->description} - R$ {$product->price}\n";
                }
            }

            $this->messages[] = ['sender' => 'bot', 'text' => $menuResponse];
        } else {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                ])->withoutVerifying()->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4',
                    'messages' => array_merge(
                        [['role' => 'system', 'content' => 'Você é um chatbot especializado em tirar dúvidas sobre delivery.']],
                        array_map(fn($msg) => [
                            'role' => $msg['sender'] === 'user' ? 'user' : 'assistant',
                            'content' => $msg['text'],
                        ], $this->messages)
                    ),
                ]);

                if ($response->successful() && isset($response->json()['choices'][0]['message']['content'])) {
                    $aiResponse = $response->json()['choices'][0]['message']['content'];

                    $this->messages[] = ['sender' => 'bot', 'text' => $aiResponse];
                } else {
                    $errorMessage = $response->json('error.message', 'Erro desconhecido ao obter resposta da IA.');
                    $this->messages[] = ['sender' => 'bot', 'text' => "Desculpe, ocorreu um problema: $errorMessage"];
                }
            } catch (\Exception $e) {
                $this->messages[] = ['sender' => 'bot', 'text' => 'Desculpe, ocorreu um erro ao se conectar à API.'];
            }
        }

        $this->userMessage = '';
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }
}
