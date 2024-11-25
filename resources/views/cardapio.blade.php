<!-- resources/views/cardapio.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio - Hot Delivery</title>
    <link rel="stylesheet" href="{{ asset('css/cardapio.css') }}">
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

    <!-- Seção do Cardápio -->
    <section id="cardapio">
        <div class="container">

            @foreach ($cardapio as $categoria => $itens)
                <div class="categoria">
                    <h2>{{ ucfirst($categoria) }}</h2>
                    <div class="itens">
                        @foreach ($itens as $item)
                            <div class="item">
                                <img src="{{ $item['imagem'] }}" alt="{{ $item['nome'] }}">
                                <h3>{{ $item['nome'] }}</h3>
                                <p>{{ $item['descricao'] }}</p>
                                <p class="preco">{{ $item['preco'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Hot Delivery | Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
