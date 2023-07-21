<?php
namespace App\Models;


use App\Models\RModel;
use Illuminate\Contracts\Auth\Authenticatable;

class Usuario extends RModel implements Authenticatable
{
    protected $table = "usuarios";

    protected $fillable = ['email', 'login', 'nome', 'senha'];

    public function getAuthIdentifierName(){
        return 'login';
    }

    public function getAuthIdentifier(){
        return $this->login;
    }

    public function getAuthPassword(){
        return $this->senha;
    }

    public function getRememberToken(){

    }

    public function setRememberToken($value){

    }

    public function getRememberTokenName(){

    }
}
