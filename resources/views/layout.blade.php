<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>CosmoShop - ecommerce</title>
    <style>
        @media (min-width: 992px) {
            .navbar-nav {
                flex-direction: row;
                gap: 1rem;
            }
        }
    </style>
    @yield("scriptjs")
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md bg-light pl-5 pr-5 mb-5">
        <div class="container">
            <a href="{{ route('home')}}" class="navbar-brand">CosmoShop</a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('home')}}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categoria')}}" class="nav-link">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cadastrar')}}" class="nav-link">Cadastrar</a>
                    </li>
                </ul>
            </div>

            <a href="{{ route('ver_carrinho') }}" class="btn btn-sm"><i class="fa fa-shopping-cart fa-2x"></i></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <!-- área que os outros arquivos irão adicionar conteúdo -->
            @yield("conteudo")
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
