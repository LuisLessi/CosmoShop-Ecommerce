<?php
namespace App\Models;

use App\Models\RModel;

class Pedido extends RModel
{
    protected $table = "pedidos";
    protected $dates = ["datapedido"];
    protected $fillable = ['dt_pedido', 'status', 'usuario_id'];

    public function statusDesc(){
        $desc = "";
        switch($this->status){
           case 'PEN': $desc = "PENDENTE";break;
           case 'APR': $desc = "APROVADO";break;
           case 'CAN': $desc = "CANCELADO";break;
        }
        return $desc;
    }

}
