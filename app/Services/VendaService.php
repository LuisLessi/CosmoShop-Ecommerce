<?php

namespace App\Services;

use App\Models\Usuario;
use App\Models\Pedido;
use App\Models\ItensPedido;

use Exception;
use Log;

class VendaService
{
    public function finalizarVenda($prods = [], Usuario $user)
    {
        try {
            \DB::beginTransaction();
            $dtHoje = new \DateTime();

            foreach ($prods as $p) {
                $pedido = new Pedido();

                $pedido->dt_pedido = $dtHoje->format("Y-m-d H:i:s");
                $pedido->status = "PEN";
                $pedido->usuario_id = $user->id;

                $pedido->save();

                $itens = new ItensPedido();

                $itens->quantidade = 1;
                $itens->valor = $p->valor;
                $itens->dt_item = $dtHoje->format("Y-m-d H:i:s");
                $itens->produto_id = $p->id;
                $itens->pedido_id = $pedido->id;
                $itens->save();
            }

            \DB::commit();
            return ['status' => 'ok', 'message' => 'Compra efetuada com sucesso'];
        } catch (Exception $e) {
            \DB::rollback();
            Log::error("ERRO:VENDA SERVICE", ['message' => $e->getMessage()]);
            Log::error("ERRO:VENDA SERVICE", ['prods' => $prods]);

            return ['status' => 'err', 'message' => 'Compra não pôde ser efetuada'];
        }
    }
}
