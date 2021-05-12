<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $imput = $request->all();
        $imput['password']=Hash::make($request->password);
        User::create($imput);
        return response()->json([
            'res' => true,
            'message'=> 'Usuario Registrado con exitos',
        ],200);
    }

    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $token = $user->createToken('Laravel')->accessToken;

            return response()->json([
                'res' => true,
                'token' => $token,
                'message'=> 'Bienvenido al sistema',
            ],200);
        }
        else {
            return response()->json([
                'res' => false,
                'message'=> 'Email o password incorrecto',
            ],200);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens->each(function($token, $key){
            $token->delete();
        });
        $user->save();
        return response()->json([
            'res' => true,
            'token' => $user->api_token,
            'message'=> 'Sesion cerrada',
        ],200);
    }
}
