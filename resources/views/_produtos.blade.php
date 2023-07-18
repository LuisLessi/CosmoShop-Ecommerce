@if(isset($produtos))
<div class="row">
    @foreach ($produtos as $produto)
    <div class="col-3 mb-3 d-flex align-items-stretch">
        <div class="card">
            <img src="{{ asset($produto->foto) }}" alt="" class="card-img-top">
            <div class="card-body">
                <h6 class="card-title">{{ $produto->nome }} - R${{ $produto->valor}}</h6>
                <a href="{{ route('adicionar_carrinho', ['idproduto' => $produto->id]) }}" class="btn btn-sm btn-secondary">Adicionar item</a>
            </div>
        </div>
    </div>
@endforeach
</div>
@endif