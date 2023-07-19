<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Services\ClienteService;


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

        $clienteService = new ClienteService();
        $result = $clienteService->salvarUsuario($usuario, $endereco);
       
        $message = $result["message"];
        $status = $result["status"];
        
        $request->session()->flash($status, $message);
   

        return redirect()->route("cadastrar");
    }

}
