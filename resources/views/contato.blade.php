<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Hot Delivery</title>
    <link rel="stylesheet" href="{{ asset('css/contato.css') }}">
    <script src="https://maps.googleapis.com/maps/api/js?key=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&callback=initMap" async defer></script>
</head>
<body>
    <!-- Cabeçalho -->
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

    <!-- Informações de Contato -->
    <section id="informacoes">
        <div class="container">
            <h2>Informações de Contato</h2>

            <div class="cartao">
                <h3><i class="fas fa-envelope"></i> Email</h3>
                <p>hotdelivery.oficial@gmail.com</p>
            </div>

            <div class="cartao">
                <h3><i class="fas fa-phone-alt"></i> Telefone</h3>
                <p>(11) 2539-4786</p>
            </div>

            <div class="cartao">
                <h3><i class="fas fa-map-marker-alt"></i> Endereço</h3>
                <p>Rua Honório Fagundes Prada, 1250, São Paulo, SP</p>
            </div>
        </div>
    </section>

    <!-- Formulário de Contato -->
    <section id="formulario">
        <div class="container">
            <h2>Envie uma Mensagem</h2>

            @if(session('mensagem_sucesso'))
                <p class="sucesso">{{ session('mensagem_sucesso') }}</p>
            @elseif(session('mensagem_erro'))
                <p class="erro">{{ session('mensagem_erro') }}</p>
            @endif

            <form action="{{ route('contato.enviar') }}" method="POST">
                @csrf
                <div class="campo">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="campo">
                    <label for="mensagem">Mensagem:</label>
                    <textarea id="mensagem" name="mensagem" required></textarea>
                </div>

                <button type="submit">Enviar</button>
            </form>
        </div>
    </section>


    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Hot Delivery | Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
