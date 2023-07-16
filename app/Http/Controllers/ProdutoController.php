<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request){
        $data = [
            'produtos' => Produto::all()
        ];
        
        return view("home", $data);
    }

    public function categoria($idcategoria = 0, Request $request)
    {
        $data = [];

        if ($idcategoria != 0) {
            $data['produtos'] = Produto::where("categoria_id", $idcategoria)->limit(4)->get();
            $data['categorias'] = Categoria::where("id", $idcategoria)->get();
        } else {
            $data['produtos'] = Produto::limit(4)->get();
            $data['categorias'] = Categoria::all();
        }

        return view('categoria', $data);
    }
}
