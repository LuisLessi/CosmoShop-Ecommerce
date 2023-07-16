<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Categoria</h2>

    @if(isset($categorias) && count($categorias) > 0)

    <ul>
        @foreach($categorias as $cat)
        <li>{{ $cat->categoria }}</li>
        @endforeach
    </ul>
    @endif


    @if(isset($produtos) && count($produtos) > 0)

    <ul>
        @foreach($produtos as $prod)
        <li>{{ $prod->nome }}</li>
        @endforeach
    </ul>
    @endif
</body>
</html>