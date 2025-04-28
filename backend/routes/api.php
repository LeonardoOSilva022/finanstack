<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register',  [UsuarioController::class, 'register']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::get('{id}',  [UsuarioController::class, 'findOne']);
    Route::post('login',  [AuthController::class, 'login']);
    Route::post('logout',  [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});