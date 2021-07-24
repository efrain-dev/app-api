<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|max:255', 'email' => 'required|email|max:255|unique:users','password' => 'required|max:8']);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'=> $token,
            'token_type'=> 'Bearer'
        ]);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message'=>'Credenciales invalidas'
            ], 401);
        }
        $user = User::where('email',$request->email)->firstOrFail();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'user'=>$user,
            'access_token'=> $token,
            'token_type'=> 'Bearer'
        ]);
    }
    public function infoUser(Request $request){
       return $request->user();
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'message'=>'Cierre de session con exito',
        ]);
    }
}
