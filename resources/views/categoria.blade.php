@extends("layout")
@section("conteudo")
<div class="col-2">
    @if(isset($categorias) && count($categorias) > 0)
    <div class="list-group">
        <a href="{{ route('categoria') }}" class="list-group-item list-group-item-action @if(0 == $idCategoria) active @endif">
            Todas
        </a>

        @foreach($categorias as $cat)
        <a href="{{ route('categoria_por_id', ['idcategoria' => $cat->id])}}" 
        class="list-group-item list-group-item-action 
        @if($cat->id == $idCategoria) active @endif">
            {{ $cat->categoria }}
        </a>
        @endforeach

    </div>
    @endif
</div>

<div class="col-10">
    @include("_produtos")
</div>

@endsection

