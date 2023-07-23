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
        @php $total =0; @endphp
        @foreach($cart as $p)
        <tr>
        <td><img src="{{ asset($p['foto']) }}" alt="" class="img-thumbnail rounded-circle" style="width: 100px;"></td>
            <td style="vertical-align: middle;">{{ $p['nome'] }}</td>
            <td style="vertical-align: middle;">{{ $p['valor'] }}</td>
            <td style="vertical-align: middle;">{{ $p['descricao'] }}</td>
            <td style="vertical-align: middle;">
                <a href="{{ route('remover_item_carrinho', ['idproduto' => $p->id]) }}" class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>
        </tr>
        
        @php $total += $p->valor; @endphp
        @endforeach
    </tbody>
    <tfooter>
        <tr>
            <td colspan="5">
                Total do carrinho: R$
            </td>
        </tr>
    </tfooter>
</table>

<form action="{{ route('finalizar_carrinho')}}" style="text-align: right;" method="post">
    <input type="submit" value="Finalizar compra" class="mb-5 btn btn-lg btn-success">
</form>

@else
<p>Nenhum item no carrinho</p>
@endif
@endsection