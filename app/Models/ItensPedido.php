<?php
namespace App\Models;

use App\Models\RModel;


class ItensPedido extends RModel
{
    protected $table = "itens_pedidos";

    protected $fillable = ['quantidade', 'valor', 'dt_item', 'pedido_id', 'produto_id'];
}
