<?php

namespace App\Services;

use App\Models\Endereco;
use App\Models\Usuario;
use Log;

class ClienteService
{
   public function salvarUsuario(Usuario $usuario, Endereco $endereco){
    try {
        //Buscando um usuario com o login que deve ser salvo
        $dbUsuario = Usuario::where("login", $usuario->login)->first();
        if ($dbUsuario) {
            return ['status' => 'err', 'message' => 'Usuario já cadastrado, insira outro CPF'];
        }

        \DB::beginTransaction();//Iniciar Transação
        $usuario->save(); // Salvar o usuário
        $endereco->usuario_id = $usuario->id; // Relaciona a tabela usuario com endereço pelo id
        $endereco->save(); // Salvar o endereco
        \DB::commit();//Confirmar Transação

        return ['status' => 'ok', 'message' => 'Usuario cadastrado com sucesso!'];
    } catch (\Exception $e) {
        // Tratar exceções, se necessário
        Log::error("ERRO", ['file' => 'ClienteService.salvarUsuario',
         'message' => $e->getMessage()]);

        \DB::rollback(); //Cancela a transação se ocorre um erro
        return ['status' => 'err', 'message' => 'Não foi possível cadastrar o usuário'];
    }

   }
}
