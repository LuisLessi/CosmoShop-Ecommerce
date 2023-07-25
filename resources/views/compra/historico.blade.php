@extends("layout")
@section("script.js")
<script>
$(function(){
    $(".infocompra").on('click', function() { // Use uma função regular ao invés de arrow function
       
        // Ao clicar no link com class .infocompra, esta função será executada
        let id = $(this).attr("data-value"); 
        $.post('{{ route("compra_detalhes") }}', { idpedido : id }, (result) => {
            // Função de callback -- retorno do ajax
            $('#conteudopedido').html(result);
        });
    });
});
</script>
@endsection
@section("conteudo")
<title>CosmoShop - ecommerce</title>
<div class="col-12">
    <h2>Minhas Compras</h2>
</div>

<div class="col-12">
    <table class="table table-bordered">
        <tr>
            <th>Data da Compra</th>
            <th>Situação</th>
            <th></th>
        </tr>
        @foreach($lista as $ped)
        <tr>
            <td>{{ \Carbon\Carbon::parse($ped->dt_pedido)->format('d/m/Y H:i') }}</td>
            <td>{{ $ped->statusDesc() }}</td>
            <td class="col-4 text-center">
                <a href="#" class="btn btn-sm btn-info infocompra" data-value="{{$ped->id}}" data-bs-toggle="modal" data-bs-target="#modalcompra">
                    <i class="fas fa-shopping-basket"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<div class="modal fade" id="modalcompra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalhes da Compra</h5>
            </div>
            <div class="modal-body">
               <div id="conteudopedido"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection