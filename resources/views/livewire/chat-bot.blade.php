<div>
    <!-- Botão para abrir o chat -->
    <button id="chat-toggle" class="fixed bottom-4 left-10 p-2 rounded-full shadow-lg hover:bg-blue-600 transition" style="background: none; border: none; width: 50px; height: 50px;">
        <img src="{{ asset('images/icone_duvidas_1.png') }}" alt="Chat Icon" class="w-6 h-6" />
    </button>

    <!-- Container do chat -->
    <div id="chat-container" class="fixed bottom-16 left-10 w-full max-w-lg hidden bg-white shadow-lg rounded-lg p-4">
        <div class="w-full mx-auto p-4 border rounded shadow-md bg-white">
            <!-- Área de mensagens com barra de rolagem -->
            <div class="chat-messages h-96 overflow-y-auto bg-gray-100 p-4 rounded">
                @foreach($messages as $message)
                    <div class="{{ $message['sender'] === 'user' ? 'text-right' : 'text-left' }}">
                        <div class="inline-block p-2 my-1 {{ $message['sender'] === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-300' }} rounded">
                            {{ $message['text'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Formulário de entrada -->
            <form wire:submit.prevent="sendMessage" class="mt-4 flex items-center gap-2">
                <input wire:model="userMessage" type="text" class="flex-grow border p-2 rounded-lg shadow-md focus:outline-none focus:ring focus:ring-blue-300" placeholder="Digite sua dúvida..." />
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-blue-600 transition">
                    Enviar
                </button>
            </form>
        </div>
    </div>

    <script>
        // Lógica para alternar a visibilidade do chat
        const chatToggle = document.getElementById('chat-toggle');
        const chatContainer = document.getElementById('chat-container');

        chatToggle.addEventListener('click', () => {
            chatContainer.classList.toggle('hidden');
        });
    </script>

    <style>
        /* Animação de abertura e fechamento do chat */
        #chat-container {
            transition: transform 0.3s ease, opacity 0.3s ease;
            transform: translateY(10px);
            opacity: 0;
            width:400px;
        }

        #chat-container:not(.hidden) {
            transform: translateY(0);
            opacity: 1;
        }

        /* Estilo para o botão de chat */
        #chat-toggle {
            cursor: pointer;
            background-color: rgba(255, 255, 255, 0.8);
            transition: background-color 0.3s ease;
        }

        #chat-toggle:hover {
            background-color: rgba(0, 102, 204, 0.8);
        }

        /* Estilos do container do chat */
        #chat-container {
            width: 700px; /* Largura fixa do chat */
            bottom: 20px;
            left: 10px;
        }

        /* Estilo para as mensagens */
        .text-left .inline-block {
            display: inline-block;
            background-color: #e0e0e0; /* Cor para as mensagens do bot */
            color: #333;
            max-width: 60%;
            padding: 12px;
            border-radius:10px;
            text-align: left;
        }

        .text-right .inline-block {
            display: inline-block;
            background-color: #4CAF50; /* Cor para as mensagens do usuário */
            color: white;
            border-radius:10px;
            padding: 12px;
            max-width: 80%;
            text-align: right;
            justify-content: flex-end;
            white-space: nowrap;
            word-wrap: break-word;
            margin-left:60%;
            
        }

        /* Estilo para o botão de enviar */
        button[type="submit"] {
            font-size: 0.875rem; /* Tamanho de fonte pequeno */
            line-height: 1rem;  /* Altura da linha */
            width: 80px; /* Tamanho do botão */
            padding: 12px; /* Padding ajustado para o botão */
            transition: background-color 0.3s ease;
            border-radius:8px;
        }

        button[type="submit"]:hover {
            background-color: #45a049; /* Cor de hover mais escura */
        }

        /* Estilo para o campo de entrada de texto */
        input[type="text"] {
            font-size: 0.875rem;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #4CAF50; /* Cor de foco para o campo de entrada */
        }

        /* Estilo para a área de mensagens com barra de rolagem */
        .chat-messages {
            max-height: 300px; /* Altura máxima da área de mensagens */
            overflow-y: auto;  /* Barra de rolagem ativada */
            padding: 10px;
            background-color: #272727;
            border-radius: 8px;
        }

        .chat-messages::-webkit-scrollbar {
            width: 8px; /* Largura da barra de rolagem */
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background-color: #888; /* Cor do "polegar" da barra de rolagem */
            border-radius: 4px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background-color: #555; /* Cor do "polegar" quando o usuário passa o mouse */
        }
    </style>
</div>
