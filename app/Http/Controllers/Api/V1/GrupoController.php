<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Grupo;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Grupo::all();
            return response()->json($data);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error' => 'Error de validación',
                'message' => $errors->all(),
                'status' => false,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $data = Grupo::create([
                'descripcion' => $request->input('descripcion')
            ]);
            return response()->json(['message' => "Se registro con exito",'data'=>$data,'status' => true],Response::HTTP_CREATED);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Grupo::find($id);

            if (is_null($data)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = Grupo::find($id);

            if (is_null($data)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validatedData = $request->validate([
                'descripcion' => 'sometimes|required|string|max:255'
            ]);

            // Verificar si otro registro tiene la misma descripción (excepto el actual)
            $existingTipoMuestra = Grupo::where('descripcion', $validatedData['descripcion'])
                ->where('id', '!=', $id) // Excluir el registro actual
                ->first();

            if ($existingTipoMuestra) {
                return response()->json([
                    'message' => 'Ya existe otro registro con la misma descripción',
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            // Actualizar el registro
            $data->update([
                'descripcion' => $validatedData['descripcion'] ?? $data->descripcion,
            ]);

            return response()->json([
                'message' => "Se actualizó con éxito",
                'data' => $data,
                'status' => true
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = Grupo::find($id);
            if (is_null($data)) {
                return response()->json(['message' => 'Registro no encontrado','status' => false], Response::HTTP_NOT_FOUND);
            }
            $data->delete();
            return response()->json(['message' => 'Registro eliminado','status' => true], Response::HTTP_NO_CONTENT);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
