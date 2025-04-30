<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacoes;

class TransacoesController extends Controller
{
    public function cadastrar (Request $request)
    {
        $transacoes = new Transacoes();
        $transacoes->id_usuario = auth()->id() ?? 0;
        $transacoes->valor = $request->valor;
        $transacoes->nome = $request->nome;
        $transacoes->tipo = $request->tipo;
        $transacoes->save();

        return response('',201);
    }

    public function balanco($id)
    {
        $transacoesCredito = Transacoes::where('id_usuario', $id)->where('tipo', 'credito')->sum('valor');
        $transacoesDebito = Transacoes::where('id_usuario', $id)->where('tipo', 'debito')->sum('valor');


        $resposta = 
        [
            'Debito'=> $transacoesDebito,
            'Credito'=> $transacoesCredito,
            'Balanco'=> $transacoesCredito - $transacoesDebito

        ];
        return response( $resposta, 200);
    }
}