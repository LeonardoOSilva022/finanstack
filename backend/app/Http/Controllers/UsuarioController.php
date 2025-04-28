<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //
    // Route::post('auth/register', 'AuthController@register');
    public function register(Request $request){
        
        $usuarioExiste = User::where('email', $request->email)->count();
        
        if( $usuarioExiste > 0)
        {
            return response('Email ja cadastrado.', 409);
        } else {
            $usuario = new User ();
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->save();

            return response($usuario, 201);
        }

    }
    // Route::get('auth/{id}',  [UsuarioController::class, 'findOne']);
    public function findOne($id){
        $usuario = User::where('id', $id)->first();

        if($usuario == null){
            return response('Usuario não encontrado', 404);
        }
        else{
            return response($usuario, 200);

        }
    }

}
