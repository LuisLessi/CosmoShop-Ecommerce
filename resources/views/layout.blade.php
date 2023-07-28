<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @yield("scriptjs")
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
                    @if(!auth()->check())
                    <li class="nav-item">
                        <a href="{{ route('logar')}}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cadastrar')}}" class="nav-link">Cadastrar</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('compra_historico')}}" class="nav-link">Histórico</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('logout')}}" class="nav-link">Sair</a>
                    </li>
                    @endif
                    
                </ul>
            </div>

            <a href="{{ route('ver_carrinho') }}" class="btn btn-sm ml-5"><i class="fa fa-shopping-cart fa-2x"></i></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="row">
        
        @if(auth()->check())
            <!-- Se o usuário estiver logado, exiba a mensagem de boas-vindas com o primeiro nome -->
            <div class="col-12">
                <?php $nomeCompleto = auth()->user()->nome; ?>
                <?php $primeiroNome = explode(" ", $nomeCompleto)[0]; ?>
                <h4>Bem-vindo, {{ $primeiroNome }}!</h4>
            </div>
        @endif

            @if($message = Session::get("err"))
            <div class="col-12">
                <div class="alert alert-danger">{{$message}}</div>
            </div>
            @endif

            @if($message = Session::get("ok"))
            <div class="col-12">
                <div class="alert alert-success">{{$message}}</div>
            </div>
            @endif
            <!-- área que os outros arquivos irão adicionar conteúdo -->
            @yield("conteudo")
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>