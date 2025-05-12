<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function store(Request $request){
        $categorias = new Categorias();
        $categorias->nome = $request -> nome;
        $categorias->created_by = auth()->id();
        $categorias->save();

        return response($categorias, 200);
    }

    public function edit (Request $request, $id){
        $categorias = Categorias::where('created_by', auth()->id())
        ->where('id', $id->first());

        if($categorias == null)
            return response('categoria não encontrada', 404);

        $categorias->nome = $request->nome;
        $categorias->update_by = auth()->id();
        $categorias->update_at = now();
        $categorias->save();

        return response($categorias, 200);
    }
    
}
