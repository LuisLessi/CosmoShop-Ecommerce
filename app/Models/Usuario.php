<?php
namespace App\Models;

use App\Models\RModel;


class Usuario extends RModel
{
    protected $table = "usuarios";

    protected $fillable = ['email', 'login', 'nome', 'senha'];

}
