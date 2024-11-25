<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - Hot Delivery</title>
    
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    @livewireStyles
</head>

<body>
    <!-- Barra de Navegação -->
    <header>
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo do Delivery" class="logo">
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('cardapio') }}">Cardápio</a></li>
                    <li><a href="{{ route('contato') }}">Contato</a></li>
                    <li><a href="{{ route('sobre-nos') }}">Sobre</a></li>
                </ul>
            </nav>
        </div>
    </header>
    

    <!-- Banner principal -->
    <section id="home" class="banner">
        <div class="banner-text">
            <a href="{{ route('cardapio') }}" class="cta-button">Veja nosso Cardápio</a>
        </div>
    </section>

    @livewire('tempo-de-entrega')


    <!-- Categorias de Produtos -->
    <section id="cardapio" class="cardapio">
        <div class="container">
            <h2>Nosso Cardápio</h2>
            <div class="categories">
                <div class="category">
                    <img src="{{ asset('images/pizza.png') }}" alt="Pizza">
                    <h3>Pizzas</h3>
                    <a href="{{ route('pizzas') }}">Veja mais</a>
                </div>
                <div class="category">
                    <img src="{{ asset('images/hamburguer.png') }}" alt="Hambúrguer">
                    <h3>Hambúrgueres</h3>
                    <a href="{{ route('hamburgueres') }}">Veja mais</a>
                </div>
                <div class="category">
                    <img src="{{ asset('images/sushi.png') }}" alt="Sushi">
                    <h3>Sushis</h3>
                    <a href="{{ route('sushis') }}">Veja mais</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Ícone do Chat -->
    <div id="chat-icon" class="chat-icon" style="position: fixed; bottom: 50px; right: 20px; cursor: pointer;">
        <img src="{{ asset('images/icone_duvidas.png') }}" alt="Chat Icon" />
    </div>
    

    <!-- Caixa do Chat -->
    <div id="chat-box" class="chat-box" style="display: none; position: fixed; bottom: 150px; right: 35px; width: 1000px; height: 400px; background-color: #fff; border: 1px solid #fff; border-radius: 8px; padding: 10px;">
        <div class="chat-header">
            <span>Chat</span>
            <button id="close-chat" class="close-chat"> </button>
        </div>
        <div id="chat-content" class="chat-content" style="height: 100%; overflow-y: auto; background-color: #f1f1f1;"> 
            <!-- Aqui será exibido o conteúdo da conversa -->  
        </div>
        <div class="chat-footer">
            <input type="text" id="userMessage" placeholder="Digite sua dúvida..." style="width: 100%; padding: 10px; margin-bottom: 5px;">
            <button id="sendMessage" onclick="sendMessage()" style="width: 20%; padding: 10px; background-color: #272727; color: white; border: none;margin-bottom: 5px;">Enviar</button>
        </div>
    </div>



    <script>
        // Alterna a visibilidade do chat ao clicar no ícone
        document.getElementById('chat-icon').addEventListener('click', function() {
            const chatBox = document.getElementById('chat-box');
            // Alterna entre 'none' e 'flex'
            if (chatBox.style.display === 'none' || chatBox.style.display === '') {
                chatBox.style.display = 'flex';
                // Envia a mensagem de boas-vindas automaticamente quando o chat é aberto
                sendWelcomeMessage();
            } else {
                resetChat();  // Fechar e resetar o chat quando clicado novamente
            }
        });

        // Função para enviar a mensagem
        async function sendMessage() {
            const userMessage = document.getElementById('userMessage').value;
            if (!userMessage) return; // Não envia mensagem vazia

            // Exibe a mensagem do usuário no chat
            const chatContent = document.getElementById('chat-content');
            chatContent.innerHTML += `<div class="message user-message">${userMessage}</div>`;
            document.getElementById('userMessage').value = ""; // Limpa o campo de input

            // Obter a resposta do chatbot
            const botMessage = await getBotResponse(userMessage);

            // Exibe a resposta do bot no chat
            chatContent.innerHTML += `<div class="message bot-message">${botMessage}</div>`;

            chatContent.scrollTop = chatContent.scrollHeight;  // Rola até a última mensagem

            // Verifica se a resposta do bot é de encerramento e realiza o reset
            if (botMessage.includes("Atendimento encerrado")) {
                resetChat();
            }
        }

        // Função para obter a resposta do chatbot
        async function getBotResponse(userMessage) {
            // Respostas predefinidas
            const predefinedResponses = {
    // Saudação
    "oi": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "Oi": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "OI": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "olá": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "Olá": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "olá, tudo bem?": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "olá tudo bem": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "e aí": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "eaí": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "eai": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "eae": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "Oi, tudo bem?": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "oi": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "Oi": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "ooi": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "Oii": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "oooi": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "eai": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "oiii": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "eaee": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "oie": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "Oie": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "eae": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "e aí?": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "olaa": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "o lá": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "oa": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "bom dia": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "boa tarde": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    "boa noite": "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...",
    
    // Horário de funcionamento
    "qual é o horário de funcionamento?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "qual e o horario de funcionamento?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "qual o horário de funcionamento?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "qual o horario de funcionamento?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "horário de funcionamento?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "qual o horario de funcionamento do delivery?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "qual é o horário de abertura do delivery?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "funcionamento": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "qual o horário de funcionamento?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "qnd funciona?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "funciona até que hrs?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "abre que horas?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "q horas vcs abrem?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "até que horas vcs atendem?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "horario de funcionamento delivery": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    "funcionamento delivery?": "Nosso horário de funcionamento é de segunda a sexta, das 9h às 18h.",
    
    
    // Produtos vendidos
    "quais produtos vocês vendem?": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "quais produtos vocês tem?": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "o que vocês vendem?": "Nós vendemos pizzas, hambúrgueres e sushis, bebidas como acompanhamento. Confira nosso cardápio completo!",
    "quais são os produtos vendidos?": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "quais são os produtos do cardápio?": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "quais pratos vocês oferecem?": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "vocês tem pizzas, hambúrgueres e sushis?": "Sim, temos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "o que vcs vendem?": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "tem sushi?": "Sim, temos sushis no nosso cardápio. Confira agora!",
    "vende pizza?": "Sim, vendemos pizzas deliciosas. Confira nosso cardápio completo!",
    "cardápio": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    "produtos disponíveis?": "Nós vendemos pizzas, hambúrgueres, sushis e bebidas como acompanhamento. Confira nosso cardápio completo!",
    
    // Como fazer um pedido
    "como faço um pedido?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "como posso pedir?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "como faço meu pedido?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "qual o processo para fazer um pedido?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "quais os passos para pedir?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "como pedir algo?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "como pedir?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "como faço?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "quero fazer um pedido": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    "como funciona o pedido?": "Para fazer um pedido, acesse nosso cardápio e escolha o que deseja. Faça seu pedido online!",
    
    // Prazo de entrega
    "qual é o prazo de entrega?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "qual e o prazo de entrega?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora a entrega?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora para entregar?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora para entrega?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora a entrega?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora a entrega": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "qual o tempo de entrega?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora pra entrega?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora pra entregar": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora pra entrega": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo para entregar?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora para entregar?": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora para entregar": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    "quanto tempo demora pra entregar": "O prazo de entrega pode variar de 30 a 60 minutos, dependendo da sua localização.",
    
    // Formas de pagamento
    "quais formas de pagamento vocês aceitam?": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "quais formas de pagamento?": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "quais as formas de pagamento?": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "quais as formas de pagamento": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "como posso pagar?": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "quais são as opções de pagamento?": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "quais as opções de pagamento?": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "quais são as opções de pagamento": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "quais as opções de pagamento": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    "vocês aceitam cartão?": "Sim, aceitamos cartão de crédito e débito.",
    "aceitam dinheiro?": "Sim, aceitamos dinheiro na entrega.",
    "quais são as formas de pagamento?": "Aceitamos cartão de crédito, débito e dinheiro na entrega.",
    
    // Promoções
    "vocês tem promoções?": "Sim! Fique atento às nossas promoções especiais na seção de promoções do nosso site.",
    "tem promoções?": "Sim! Fique atento às nossas promoções especiais na seção de promoções do nosso site.",
    "tem alguma promoção?": "Sim! Fique atento às nossas promoções especiais na seção de promoções do nosso site.",
    "como posso saber das promoções?": "Fique atento às nossas promoções especiais na seção de promoções do nosso site.",
    "onde vejo as promoções?": "Fique atento às nossas promoções especiais na seção de promoções do nosso site.",
    "quais são as promoções de hoje?": "Fique atento às nossas promoções especiais na seção de promoções do nosso site.",
    
    // Contato
    "como posso entrar em contato com vocês?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    "qual é o contato de vocês?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    "tem como eu entrar em contato?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    "como falo com vocês?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    "qual o número para contato?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    "qual o numero para contato?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    "como posso falar com vocês?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    "como falo com vocês?": "Você pode entrar em contato conosco pelo formulário de contato no nosso site ou via telefone.",
    
    // Ajuda
    "preciso de ajuda": "Claro, em que posso te ajudar? Digite sua dúvida e tentarei responder.",
    "me ajuda": "Claro, em que posso te ajudar? Digite sua dúvida e tentarei responder.",
    "ajuda": "Claro, em que posso te ajudar? Digite sua dúvida e tentarei responder.",
    "tem ajuda aí?": "Claro, em que posso te ajudar? Digite sua dúvida e tentarei responder.",
    "pode me ajudar?": "Claro, em que posso te ajudar? Digite sua dúvida e tentarei responder.",
    
    // Respostas gerais
    "o que é isso?": "Isso é um delivery online, onde você pode fazer pedidos de alimentos e bebidas com entrega rápida!",
    "o que é delivery?": "Delivery é um serviço de entrega de produtos, como alimentos e bebidas, diretamente na sua casa.",
    "quem são vocês?": "Somos um serviço de delivery que oferece pizzas, hambúrgueres e sushis. Faça seu pedido agora mesmo!",
    "quem sao voces?": "Somos um serviço de delivery que oferece pizzas, hambúrgueres e sushis. Faça seu pedido agora mesmo!",
    "quem voces são?": "Somos um serviço de delivery que oferece pizzas, hambúrgueres e sushis. Faça seu pedido agora mesmo!",
    "qual o nome do delivery?": "Nosso nome é Hot Delivery! Estamos aqui para levar o melhor até você.",
    
    // Despedida
    "obrigado": "De nada! Fico feliz em ajudar. Qualquer coisa, é só chamar!",
    "valeu": "De nada! Fico feliz em ajudar. Qualquer coisa, é só chamar!",
    "tchau": "Até logo! Fico feliz em ajudar. Volte sempre que precisar!",
    "até mais": "Até logo! Fico feliz em ajudar. Volte sempre que precisar!",
    "não preciso mais de ajuda": "Atendimento encerrado. Obrigado por usar o nosso chat!"
};


            // Convertendo a mensagem do usuário para minúsculas para uma busca mais flexível
            const lowerCaseMessage = userMessage.toLowerCase();

            // Verifica se a mensagem do usuário corresponde a alguma pergunta predefinida
            if (predefinedResponses[lowerCaseMessage]) {
                // Remover a frase "Ajudo em algo mais?" apenas da resposta "Olá. Tudo bem? ..."
                if (predefinedResponses[lowerCaseMessage] === "Olá. Tudo bem? É um prazer ajudá-lo(a), digite a sua dúvida...") {
                    return predefinedResponses[lowerCaseMessage]; // Não adiciona "Ajudo em algo mais?"
                }
                return predefinedResponses[lowerCaseMessage] + "<br>Ajudo em algo mais?";
            } else if (lowerCaseMessage === "não") {
                return "Atendimento encerrado. Obrigado por usar o nosso chat!";
            } else {
                // Se não for uma pergunta predefinida, retorna uma resposta padrão
                return 'Desculpe, não entendi a sua mensagem. Tente outra pergunta!';
            }
        }

        // Função para enviar a mensagem de boas-vindas automaticamente
        function sendWelcomeMessage() {
            const chatContent = document.getElementById('chat-content');
            const botMessage = "Seja bem-vindo(a)...  Tudo bem?  Me chamo Álice, sou a Inteligência Artificial treinada para sanar todas as suas dúvidas à respeito do nosso Delivery.";
            chatContent.innerHTML += `<div class="message bot-message">${botMessage}</div>`;
            chatContent.scrollTop = chatContent.scrollHeight;  // Rola até a última mensagem
        }

        // Função para resetar o chat
        function resetChat() {
            const chatContent = document.getElementById('chat-content');
            chatContent.innerHTML = ''; // Limpa o conteúdo do chat
            document.getElementById('chat-box').style.display = 'none'; // Fecha a caixa de chat
        }
    </script>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Hot Delivery | Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>
