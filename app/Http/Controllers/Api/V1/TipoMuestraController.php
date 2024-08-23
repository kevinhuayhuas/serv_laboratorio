<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoMuestra;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TipoMuestraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {;
            $data = TipoMuestra::all();
            return response()->json($data,Response::HTTP_OK);
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
            'descripcion' => 'required|string|max:255',
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
            $existingTipoMuestra = TipoMuestra::where('descripcion', $request->input('descripcion'))->first();
            if ($existingTipoMuestra) {
                return response()->json([
                    'message' => "Ya existe un registro con esta descripción",
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            $tipoMuestra = TipoMuestra::create([
                'descripcion' => $request->input('descripcion')
            ]);
            return response()->json(['message' => "Se registro con exito",'data'=>$tipoMuestra,'status' => true],Response::HTTP_CREATED);
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
    public function show( $id)
    {
        try {
            $tipoMuestra = TipoMuestra::find($id);

            if (is_null($tipoMuestra)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($tipoMuestra, Response::HTTP_OK);
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
    public function update(Request $request, $id)
    {
        try {
            $tipoMuestra = TipoMuestra::find($id);

            if (is_null($tipoMuestra)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validatedData = $request->validate([
                'descripcion' => 'sometimes|required|string|max:255'
            ]);

            // Verificar si otro registro tiene la misma descripción (excepto el actual)
            $existingTipoMuestra = TipoMuestra::where('descripcion', $validatedData['descripcion'])
                ->where('id', '!=', $id) // Excluir el registro actual
                ->first();

            if ($existingTipoMuestra) {
                return response()->json([
                    'message' => 'Ya existe otro registro con la misma descripción',
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            // Actualizar el registro
            $tipoMuestra->update([
                'descripcion' => $validatedData['descripcion'] ?? $tipoMuestra->descripcion,
            ]);

            return response()->json([
                'message' => "Se actualizó con éxito",
                'data' => $tipoMuestra,
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
           $tipoMuestra = TipoMuestra::find($id);
           if (is_null($tipoMuestra)) {
               return response()->json(['message' => 'Registro no encontrado','status' => false], Response::HTTP_NOT_FOUND);
           }
           $tipoMuestra->delete();
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
