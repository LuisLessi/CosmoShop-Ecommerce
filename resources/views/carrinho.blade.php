@extends("layout")
@section("conteudo")
<h3>Carrinho</h3>

@if(isset($cart) && count($cart) > 0)
<table class="table">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cart as $p)
        <tr>
        <td><img src="{{ asset($p->foto)}}" alt="" class="img-thumbnail rounded-circle" style="width: 100px;"></td>
            <td style="vertical-align: middle;">{{ $p->nome }}</td>
            <td style="vertical-align: middle;">{{ $p->valor }}</td>
            <td style="vertical-align: middle; ">{{ $p->descricao }}</td>
            <td style="vertical-align: middle;">
            <a href="{{ route('remover_item_carrinho', ['idproduto' => $p->id]) }}" class="btn btn-sm btn-danger">
            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Nenhum item no carrinho</p>
@endif
@endsection