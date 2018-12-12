<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        $usuario->contrasena = $contraseña;
        $usuario->modelo = $request->modelo;
        $usuario->marca = $request->marca;
        $usuario->descripcion = $request->descripcion;
        $usuario->placa = $request->placa;

        $usuario->save();
        return response()->json(1);
    }

    public function login(Request $request)
    {
        $contraseña =  $request->contraseña;
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        $user = User::where('correo',$request->correo)->where('contrasena',
        $contraseña)->where('estado',1)->first();
        if($user){
            return response()->json(1);
        }else{
            return response()->json(0); 
        }
    }

    public function aceptar(Request $request)
    {
        $usuario = User::where('correo',$request->correo)->first();
        if($usuario){
            $usuario->estado = 1;
        }
        $usuario->save();
        return response()->json(1);
    }

    public function rechazar(Request $request)
    {
        $usuario = User::where('correo',$request->correo)->first();
        if($usuario){
            $usuario->estado = 0;
        }
        $usuario->save();
        return response()->json(1);
    }
    
}
