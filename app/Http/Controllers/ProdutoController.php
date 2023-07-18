<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;

use Illuminate\Http\Request;

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

    public function adicionarCarrinho($idProduto =0, Request $request) {
        //Buscar o produto pelo o ID
        $prod = Produto::find($idProduto);

        if($prod){
            //Encontrou o produto
            
           $carrinho = session('cart', []);
           
           array_push($carrinho, $prod);
           session([ 'cart' => $carrinho ]);
        }

        return redirect()->route("home");
    }

    public function verCarrinho(Request $request){
        $carrinho = session('cart', []);
        dd($carrinho);
    }
}
