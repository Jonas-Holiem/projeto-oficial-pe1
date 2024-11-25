<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sobre Nós - Hot Delivery' }}</title>
    @livewireStyles
    
</head>
<body>
    {{ $slot }}
    @livewireScripts
</body>
</html>
