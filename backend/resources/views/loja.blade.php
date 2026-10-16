<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $nomeLoja }}</title>
    </head>
    <body>
        <h1>Bem-vindo à {{ $nomeLoja }}!</h1>

        <h2>Catálogo de produtos</h2>
        @if (count($produtos) > 0)
            <ul>
                @foreach ($produtos as $produto)
                    <li>{{ $produto }}</li>
                @endforeach
            </ul>
        @else
            <p>Nenhum produto disponível.</p>
        @endif
    </body>
</html>
