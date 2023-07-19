<?php
namespace App\Models;

use App\Models\RModel;

class Endereco extends RModel
{
    protected $table = "enderecos";

    protected $fillable = ['logradouro', 'numero', 'complemento', 'cidade', 'cep', 'estado'];
}
