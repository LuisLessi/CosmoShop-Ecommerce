@extends("layout")
@section("scriptjs")
<script type="text/javascript" src=
"https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function carregar() {
    PagSeguroDirectPayment.setSessionId('{{ $sessionID }}')
}
$(function(){
    carregar();

    $(".ncredito").on('blur', function(){
        PagSeguroDirectPayment.onSenderHashReady(function(response){
            if (response.status == 'error') {
                console.log(response.message)
                return false
            }

            var hash = response.senderHash
            $(".hasheller").val(hash)
        })
    })
})
</script>
@endsection
@section("conteudo")

<form>
    <input type="text" name="hasheller" class="hasheller">
    <div class="row">
        <div class="col-4">
            Cartão de Crédito:
            <input type="text" name="ncredito" class="ncredito form-control">
        </div>
        <div class="col-4">
            CVV:
            <input type="text" name="ncvv" class="ncvv form-control">
        </div>
        <div class="col-4">
            Mês de Expiração:
            <input type="text" name="mesexp" class="mesexp form-control">
        </div>
        <div class="col-4">
            Ano de Expiração:
            <input type="text" name="anoexp" class="anoexp form-control">
        </div>
        <div class="col-4">
            Nome do Cartão:
            <input type="text" name="nomecartao" class="nomecartao form-control">
        </div>
        <div class="col-4">
            Parcelas:
            <input type="text" name="nparcela" class="nparcela form-control">
        </div>
        <div class="col-4">
            Valor total:
            <input type="text" name="totalfinal" class="totalfinal form-control">
        </div>
        <div class="col-4">
            Valor da Parcela:
            <input type="text" name="totalparcela" class="totalparcela form-control">
        </div>
        @csrf
        <input type="button" value="Pagar" class="btn btn-lg btn-success mt-5">
    </div>
</form>
@endsection