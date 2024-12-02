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

    <livewire:chat-bot />


    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Hot Delivery | Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>
