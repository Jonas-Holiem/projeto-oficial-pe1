<div>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Hot Delivery</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Corpo */
body {
    font-family: Arial, sans-serif;
    background-color: #272727;
    color: #333;
}

/* Container com largura máxima */
.container {
    width: 80%;
    margin: 0 auto;
}

/* Cabeçalho */
header {
    background-color: #333;
    color: white;
    margin:0;
    height: 120px;
}

header .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

header .logo {
    width: 125px;
}

header nav ul {
    list-style: none;
    display: flex;
}

header nav ul li {
    margin-left: 20px;
}

header nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

/* Links */
a {
    color: #4CAF50; /* Verde para links */
    text-decoration: none;
}

a:hover {
    color: #FF5733; /* Vermelho para links ao passar o mouse */
}

        /* Títulos e textos */
        h1, h2 {
            color: #fff; /* Verde para títulos */
            font-weight: bold;
            margin-top:50px;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            margin-top: 70px;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            margin-top: 10px;
            margin-bottom: 20px;
            color:white;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
        }

        ul li {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2em;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

       

        /* Rodapé */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 5px 0;
            margin-top: 40px;
        }

        footer p {
            font-size: 1em;
        }

    </style>
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

    <!-- Conteúdo principal -->
    <div class="container">
        <h1>{{ $companyName }}</h1>
        <p>{{ $description }}</p>

        <section>
            <h2>Missão</h2>
            <p>{{ $mission }}</p>
        </section>

        <section>
            <h2>Visão</h2>
            <p>{{ $vision }}</p>
        </section>

        <section>
            <h2>Valores</h2>
            <ul>
                @foreach ($values as $value)
                    <li>{{ $value }}</li>
                @endforeach
            </ul>
        </section>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 Hot Delivery | Todos os direitos reservados.</p>
    </footer>
</body>
</html>

</div>
