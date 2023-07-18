<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>CosmoShop - ecommerce</title>
</head>
<body>
    <nav class="navbar navbar-light navbar-expand-md bg-light pl-5 pr-5 mb-5">
        <div class="container">
            <a href="#" class="navbar-brand">CosmoShop</a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <a href="{{ route('home')}}" class="nav-link">Home</a>
                    <a href="{{ route('categoria')}}" class="nav-link">Categorias</a>
                    <a href="{{ route('cadastrar')}}" class="nav-link">Cadastrar</a>
                </div>
            </div>
        </div>
        <a href="{{ route('ver_carrinho') }}" class="btn btn-sm ml-5"><i class="fa fa-shopping-cart"></i></a>
    </nav>

    <div class="container">
        <div class="row">
            <!-- área que os outros arquivos irão adicionar conteudo -->
            @yield("conteudo")
        </div>
    </div>
</body>
</html>
