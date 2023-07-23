<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Usuario;
use App\Services\VendaService;
use Illuminate\Http\Request;

use Auth;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'produtos' => Produto::all()
        ];

        return view("home", $data);
    }

    public function categoria($idCategoria = 0, Request $request)
    {
        $data = [];

        if ($idCategoria != 0) {
            $data['produtos'] = Produto::where("categoria_id", $idCategoria)->limit(4)->get();
            $data['categoriaSelecionada'] = Categoria::find($idCategoria);
        } else {
            $data['produtos'] = Produto::limit(4)->get();
        }

        $data['categorias'] = Categoria::all();
        $data['idCategoria'] = $idCategoria;

        return view('categoria', $data);
    }

    public function adicionarCarrinho($idProduto = 0, Request $request)
    {
        //Buscar o produto pelo o ID
        $prod = Produto::find($idProduto);

        if ($prod) {
            //Encontrou o produto

            $carrinho = session('cart', []);

            array_push($carrinho, $prod);
            session(['cart' => $carrinho]);
            $message = "Produto adicionado ao carrinho";
            $status = "ok";

            $request->session()->flash($status, $message);
        } else {
            $message = "Erro ao adicionar produto no carrinho";
            $status = "erro";

            $request->session()->flash($status, $message);
        }

        return redirect()->back();
    }

    public function verCarrinho(Request $request)
    {
        $carrinho = session('cart', []);
        $data = ['cart' => $carrinho];
        return view("carrinho", $data);
    }

    public function removerItemCarrinho($idProduto, Request $request)
    {
        $carrinho = session('cart', []);

        // Encontrar o índice do item no carrinho
        $indice = -1;
        foreach ($carrinho as $index => $produto) {
            if ($produto->id == $idProduto) {
                $indice = $index;
                break;
            }
        }

        // Remover o item do carrinho se encontrado
        if ($indice !== -1) {
            unset($carrinho[$indice]);
            session(['cart' => $carrinho]);
        }

        return redirect()->route('ver_carrinho');
    }

    public function finalizarCarrinho(Request $request)
    {
        $carrinho = session('cart', []);
        $vendaService = new VendaService();
        $result = $vendaService->finalizarVenda($carrinho, auth::user());

        if ($result["status"] == "ok") {
            $request->session()->forget("cart");
        }

        $request->session()->flash($result["status"], $result["message"]);

        return redirect()->route('ver_carrinho');
    }

    public function comprasHistorico(Request $request)
    {
        $data = [];

        $id_usuario = auth::user()->id;

        $listapedido = Pedido::where("usuario_id", $id_usuario)
            ->orderBy("dt_pedido", "desc")
            ->get();

        $data["lista"] = $listapedido;

        return view("compra/historico", $data);
    }
}
