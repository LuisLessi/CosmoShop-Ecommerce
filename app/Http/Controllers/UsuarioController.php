<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function logar(Request $request)
{
    $data = [];

    if ($request->isMethod('post')) {
        // Recupere os dados do formulário
        $login = $request->input('login');
        $senha = $request->input('senha');

        // Busque o usuário pelo login no banco de dados
        $credential = ['login' => $login, 'password' => $senha]; // Change 'senha' to 'password'

        if (Auth::attempt($credential)) {
            return redirect()->route('home');
        } else {
            $message = "Credenciais inválidas. Verifique seu login e senha.";
            $status = "err";
            $request->session()->flash($status, $message);
        }
    }

    return view("logar", $data);
}

}
