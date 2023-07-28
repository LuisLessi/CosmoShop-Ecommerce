@extends("layout")
@section("scriptjs")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script>
    $(function() {
            // Add this part to include CSRF token in AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    function carregar() {
        PagSeguroDirectPayment.setSessionId('{{ $sessionID }}')
    }
    $(function() {
        carregar();
        

        $(".ncredito").on('blur', function() {
            PagSeguroDirectPayment.onSenderHashReady(function(response) {
                if (response.status == 'error') {
                    console.log(response.message)
                    return false
                }

                var hash = response.senderHash
                $(".hasheller").val(hash)
            })

            let ncartao = $(this).val()
             $(".bandeira").val("")
            if (ncartao.length > 6) {
                let prefixcartao = ncartao.substr(0, 6)
                PagSeguroDirectPayment.getBrand({
                    cardBin : prefixcartao,
                    success : function(response) {
                        $(".bandeira").val(response.brand.name)
                    },
                    error : function(response) {
                        alert("Numero do cartão inválido")
                    }
                })
            } 
        })

        $(".nparcela").on('blur', function() {
            var bandeira = $(".bandeira").val();
            var totalParcelas = $(this).val();
            if (bandeira == "") {
                alert("Preencha o numero de cartão válido");
                return;
            }

            PagSeguroDirectPayment.getInstallments({
                amount: $(".totalfinal").val(),
                maxInstallmentNoInterest: 2,
                brand: bandeira,
                success: function(response) {
                console.log("Response from getInstallments:", response);
                console.log(response);
                let status = response.error
                if (status) {
                    alert("Não foi encontrado opção de parcelamento")
                    return;
                }

                let installmentsData = response.installments[bandeira];
                let selectedInstallment = installmentsData[totalParcelas - 1]; // Get the selected installment

                let totalpagar = selectedInstallment.totalAmount;
                let valorTotalParcela = selectedInstallment.installmentAmount;

                console.log("totalpagar:", totalpagar);
                console.log("valorTotalParcela:", valorTotalParcela);
                
                $(".totalparcela").val(valorTotalParcela);
                $(".totalpagar").val(totalpagar);
                }
            })
        })
        $(".Pagar").off('click').on("click", function(){
            console.log("Pagar button clicked.");
            var numerocartao = $(".ncredito").val()
            var iniciocartao = numerocartao.substr(0, 6)
            var ncvv = $(".ncvv").val()
            var anoexp = $(".anoexp").val()
            var mesexp = $(".mesexp").val()
            var hasheller = $(".hasheller").val()
            var bandeira = $(".bandeira").val()

            PagSeguroDirectPayment.createCardToken({
                cardNumber : numerocartao,
                brand : bandeira,
                cvv : ncvv,
                expirationMonth : mesexp,
                expirationYear : anoexp,
                success : function(response){
                    console.log("Card token obtained:", response.card.token);
                    var cardToken = response.card.token;
                    $.post('{{ route("finalizar_carrinho")}}', {
                        hasheller : hasheller,
                        cardToken : cardToken,
                        nparcela : $(".nparcela").val(),
                        totalpagar : $(".totalpagar").val(),
                        totalParcelas : $(".totalparcela").val()
                    }, function(result) {
                        alert(result)
                    });
                },
                error : function(err){
                    alert("Não foi possível buscar o token do cartão, verifique todos os campos")
                    console.log(err);
                }
            })
        })
    })
});
</script>
@endsection
@section("conteudo")

<form>
    @php $total =0; @endphp
    @if(isset($cart) && count($cart) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $p)
            <tr>
                <td style="vertical-align: middle;">{{ $p['nome'] }}</td>
                <td style="vertical-align: middle;">{{ $p['valor'] }}</td>
            </tr>

            @php $total += $p->valor; @endphp
            @endforeach
        </tbody>

    </table>
    @endif
    <input type="text" name="hasheller" class="hasheller">
    <input type="text" name="bandeira" class="bandeira">


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
            <input type="text" name="totalfinal" value="{{ $total }}" class="totalfinal form-control" readonly>
        </div>
        <div class="col-4">
            Valor da Parcela:
            <input type="text" name="totalparcela" class="totalparcela form-control" >
        </div>
        <div class="col-4">
            Total à Pagar:
            <input type="text" name="totalpagar" class="totalpagar form-control">
        </div>
        @csrf
        <input type="button" value="Pagar" class="Pagar btn btn-lg btn-success mt-5">
    </div>
</form>
@endsection