<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
       // $users = User::all();
        $users = User::with('roles')->get();
        return response()->json($users, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            //'rol' => 'required|integer|exists:roles,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            // Verifica si el error es debido a que el email ya existe
            if ($errors->has('email')) {
                return response()->json([
                    'error' => 'Correo electrónico ya registrado.',
                    'message' => $errors->get('email'),
                    'status' => false
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            return response()->json([
                'error' => 'Error de validación',
                'message' => $errors->all(),
                'status' => false,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'estado' => true
            ]);

            $role = $request->input('rol');
            $user->assignRole($role);

            return response()->json(['message' => "Se registro con exito",'data'=>$user,'status' => true],Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return response()->json([
                'error' => 'Error de la base de datos',
                'message' => $exception->getMessage(),
                'estado' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'estado' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        //$user = User::find($id);
        $user = User::with('roles')->find($id);

        if (is_null($user)) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json(['message' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8'
        ]);

        $user->update([
            'name' => $validatedData['name'] ?? $user->name,
            'email' => $validatedData['email'] ?? $user->email,
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
        ]);

        $user->syncRoles([$request['rol']]); // Quitar los roles actuales y asignar el nuevo

        return response()->json(['message' => "Se actualizo con exito",'data'=>$user,'status' => true],Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json(['message' => 'Usuario no encontrado','status' => false], Response::HTTP_NOT_FOUND);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado','status' => true], Response::HTTP_NO_CONTENT);
    }
}
