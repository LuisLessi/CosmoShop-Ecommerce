<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;


class ClienteController extends Controller
{
    public function cadastrar(Request $request)
    {
        $data = [];

        return view("cadastrar", $data);
    }

    public function cadastrarCliente(Request $request)
    {
        $value = $request->all();
        $usuario = new Usuario();
        $usuario->fill($value);

        $senha = $request->input("senha", "");
        $senhaCriptografada = Hash::make($senha); // Criptografar a senha

        $usuario->senha = $senhaCriptografada; // Atribuir a senha criptografada ao usuário

        $endereco = new Endereco($value);

       
        try {
            \DB::beginTransaction();//Iniciar Transação
            $usuario->save(); // Salvar o usuário
            $endereco->usuario_id = $usuario->id; // Relaciona a tabela usuario com endereço pelo id
            $endereco->save(); // Salvar o endereco
            \DB::commit();//Confirmar Transação
        } catch (\Exception $e) {
            // Tratar exceções, se necessário
            \DB::rollback(); //Cancela a transação se ocorre um erro
        }

        return redirect()->route("cadastrar");
    }
}
