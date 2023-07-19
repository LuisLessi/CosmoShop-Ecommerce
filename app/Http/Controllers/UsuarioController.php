<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function logar(Request $request)
    {
        // Check if the form was submitted
        if ($request->isMethod('post')) {
            // Recupere os dados do formulário
            $login = $request->input('login');
            $senha = $request->input('senha');
    
            // Busque o usuário pelo login no banco de dados
            $usuario = Usuario::where('login', $login)->first();
    
            // Verifique se o usuário foi encontrado e se a senha está correta
            if ($usuario && Hash::check($senha, $usuario->senha)) {
                // Autenticação bem-sucedida, redirecione o usuário para home
                return redirect()->route('home', ['id' => $usuario->id]);
            } else {
                // Autenticação falhou, retorne uma mensagem de erro para a view
                $message = "Credenciais inválidas. Verifique seu login e senha.";
                $status = "err";
                $request->session()->flash($status, $message);
    
                // Redirect back to the login page with the error message
                return redirect()->route('logar');
            }
        } else {
            // If it's a GET request, just render the login view without any error message
            return view("logar");
        }
    }
}
