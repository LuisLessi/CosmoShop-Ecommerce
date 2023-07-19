@extends("layout")
@section("scriptjs")
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function() {
        $("#cpf").mask("000.000.000-00")
    })

</script>
@endsection
@section("conteudo")

<div class="col-12">
    <h2 class="mb-4">Login</h2>

  
    <form action="{{ route('logar')}}" method="post">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                Login:
                <input type="text" name="login" id="cpf" class="form-control" placeholder="Digite seu CPF" />
            </div>
            
            <div class="form-group col-md-6">
                Senha:
                <input type="password" name="senha" class="form-control" placeholder="Digite sua senha"/>
            </div>
        </div>
        <input type="submit" value="Logar" class="btn btn-md btn-primary mt-4">
    </form>
</div>
@endsection
