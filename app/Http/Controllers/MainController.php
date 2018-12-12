<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class MainController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $contraseña =  $request->contraseña;
        $contraseña = bcrypt($contraseña);
        $usuario->contrasena = $contraseña;
        $usuario->modelo = $request->modelo;
        $usuario->marca = $request->marca;
        $usuario->descripcion = $request->descripcion;
        $usuario->placa = $request->placa;

        $usuario->save();
        return response()->json(['success'=>1]);
    }

    public function login(Request $request)
    {
        $contraseña =  $request->contraseña;
        $user = User::where('correo',$request->correo)->first();
        if($user){
            $user = User::where('correo',$request->correo) ->where('estado',1)->first();
            if($user){
                if ($user && Hash::check($contraseña, $user->contrasena)) {
                    return response()->json(['success'=>1]);
                }
                return response()->json(['success'=>3]); 
    
            }else{
                return response()->json(['success'=>2]); 
            }
        }else{
            return response()->json(['success'=>0]); 
        }
        
    }

    public function aceptar(Request $request)
    {
        $usuario = User::where('correo',$request->correo)->first();
        if($usuario){
            $usuario->estado = 1;
        }
        $usuario->save();
        return response()->json(['success'=>1]);
    }

    public function rechazar(Request $request)
    {
        $usuario = User::where('correo',$request->correo)->first();
        if($usuario){
            $usuario->estado = 0;
        }
        $usuario->save();
        return response()->json(['success'=>1]);
    }
    
}
