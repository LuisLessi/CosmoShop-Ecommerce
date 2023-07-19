@extends("layout")
@section("scriptjs")
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function() {
        $("#cpf").mask("000.000.000-00")
    })

    $(function() {
        $("#numero").mask("0000")
    })

    $(function() {
        $("#cep").mask("88888-888")
    })

    $(function() {
        $('#estado').mask('AA', {
            placeholder: ''
        });
    });
</script>
@endsection
@section("conteudo")
<div class="col-12">
    <div class="col-12">
        <h2 class="mb-4">Cadastrar</h2>
    </div>
    <form action="{{ route('cadastrar_cliente') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    Nome: <input type="text" name="nome" class="form-control" require/>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    Email: <input type="email" name="email" class="form-control" />
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    CPF: <input type="text" name="login" id="cpf" class="form-control" require/>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    Senha: <input type="password" name="senha" class="form-control" require/>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    Endereço: <input type="text" name="logradouro" class="form-control" />
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    Nº: <input type="text" name="numero" id="numero" class="form-control" />
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    complemento: <input type="text" name="complemento" class="form-control" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    Cidade: <input type="text" name="cidade" class="form-control" />
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    Cep: <input type="text" name="cep" id="cep" class="form-control"/>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    Estado: <input type="text" name="estado" id="estado" class="form-control" />
                </div>
            </div>
            <br>
        </div>

        <input type="submit" value="Cadastrar" class="btn btn-success btn-sm mt-5">
    </form>
</div>
@endsection