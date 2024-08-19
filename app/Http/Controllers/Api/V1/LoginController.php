<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //return response()->json("hola");
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales no válidas'], 401);
        }

        if (!$user->estado) {
            return response()->json(['message' => 'Usuario Desactivado'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        //return response()->json(['token' => $token], 200);
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'roles' => $user->roles, // Asegúrate de que 'roles' está definido en el modelo User
        ]);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Cerró sesión exitosamente'], 200);
    }
}
