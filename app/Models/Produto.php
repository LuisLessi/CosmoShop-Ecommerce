<?php
namespace App\Models;

use App\Models\RModel;


class Produto extends RModel
{
   protected $table = "produtos";

   protected $fillable = ['nome', 'foto', 'descricao', 'categoria_id', 'valor'];

   public function serialize()
   {
       return serialize([
           'id' => $this->id,
           // Add other attributes that you want to serialize here
           // For example: 'nome' => $this->nome,
           //              'foto' => $this->foto,
           //              'descricao' => $this->descricao,
           //              'categoria_id' => $this->categoria_id,
           //              'valor' => $this->valor,
       ]);
   }
}
