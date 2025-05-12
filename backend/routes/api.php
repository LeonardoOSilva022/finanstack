<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransacoesController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register',  [UsuarioController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function($router){

    Route::group(['prefix'=>'transacoes'], function($router){
        Route::post('', [TransacoesController::class, 'cadastrar']);
        Route::get('balanco/{id}', [TransacoesController::class, 'balanco']);
    });

    Route::prefix('categorias')->group(function(){
        //
    });


    Route::prefix('auth')->group(function(){
        Route::get('{id}',  [UsuarioController::class, 'findOne']);
        Route::post('logout',  [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    });

});