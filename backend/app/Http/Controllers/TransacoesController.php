<?php

namespace App\Http\Controllers;

use App\Models\Transacoes;
use Illuminate\Http\Request;

class TransacoesController extends Controller
{
    // ✗ php artisan make:controller TransacoesController
    // php artisan make:model Transacoes  (colocar o use SoftDeletes;)
    public function cadastrar(Request $request)
    {

        $transacoes = new Transacoes();
        $transacoes->id_usuario = auth()->id() ?? 0;
        $transacoes->valor = $request->valor;
        $transacoes->nome = $request->nome;
        $transacoes->tipo = $request->tipo;
        $transacoes->save();

        return response('', 201);
    }

    public function balanco()
    {
        $id = auth()->id();
        $transacoesCredito = Transacoes::where('id_usuario', $id)->where('tipo', 'credito')->sum('valor');
        $transacoesDebito = Transacoes::where('id_usuario', $id)->where('tipo', 'debito')->sum('valor');
        //$transacoesDebito = Transacoes::where('id_usuario', $id)->where('tipo', 'debito')->sum('valor');

        $resposta = [
            'debito' => $transacoesDebito,
            'credito' => $transacoesCredito,
            'balanco' => $transacoesCredito - $transacoesDebito
        ];

        return response($resposta, 200);
    }

    public function todas()
    {
        $transacoes = Transacoes::where('id_usuario', auth()->id())->orderBy('id', 'desc')->get();


        return response($transacoes, 200);
    }
}