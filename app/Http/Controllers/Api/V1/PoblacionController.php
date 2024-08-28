<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Poblacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PoblacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {;
            $data = Poblacion::all();
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
            'abreviatura' => 'required|string|max:255'
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
            $existingPoblacion= Poblacion::where('descripcion', $request->input('descripcion'))->first();
            if ($existingPoblacion) {
                return response()->json([
                    'message' => "Ya existe un registro con esta descripción",
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            $poblacion = Poblacion::create([
                'descripcion' => $request->input('descripcion'),
                'abreviatura' => $request->input('abreviatura')
            ]);
            return response()->json(['message' => "Se registro con exito",'data'=>$poblacion,'status' => true],Response::HTTP_CREATED);
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
            $poblacion = Poblacion::find($id);

            if (is_null($poblacion)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }
            return response()->json($poblacion, Response::HTTP_OK);
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
            $poblacion = Poblacion::find($id);

            if (is_null($poblacion)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validatedData = $request->validate([
                'descripcion' => 'sometimes|required|string|max:255',
                'abreviatura' => 'sometimes|required|string|max:255'
            ]);

            // Verificar si otro registro tiene la misma descripción (excepto el actual)
            $existingPoblacion= Poblacion::where('descripcion', $validatedData['descripcion'])
                ->where('id', '!=', $id) // Excluir el registro actual
                ->first();

            if ($existingPoblacion) {
                return response()->json([
                    'message' => 'Ya existe otro registro con la misma descripción',
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            // Actualizar el registro
            $poblacion->update([
                'descripcion' => $validatedData['descripcion'] ?? $poblacion->descripcion,
                'abreviatura' => $validatedData['abreviatura'] ?? $poblacion->abreviatura,
            ]);

            return response()->json([
                'message' => "Se actualizó con éxito",
                'data' => $poblacion,
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
    public function destroy($id)
    {
        try{
            $poblacion = Poblacion::find($id);
            if (is_null($poblacion)) {
                return response()->json(['message' => 'Registro no encontrado','status' => false], Response::HTTP_NOT_FOUND);
            }
            $poblacion->delete();
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
