<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Inventario::all();
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
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|integer',
            'cantidad' => 'required|integer',
            'unidad_medida_id'=>'required|integer',
            'metodo'=>'required|string',
            'marca'=>'required|string',
            'lote'=>'required|string',
            'fech_adquisicion'=>'required|date',
            'fech_expiracion'=>'required|date',
            'observaciones'=>'required|string'
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
            // Verificar si otro registro tiene la misma descripción (excepto el actual)
            $existing =Inventario::where('nombre', $request->input('nombre'))->first();
            if ($existing) {
                return response()->json([
                    'message' => 'Ya existe otro registro con la misma descripción',
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }
            $data = Inventario::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'categoria_id' => $request->input('categoria_id'),
                'cantidad' => $request->input('cantidad'),
                'unidad_medida_id' => $request->input('metodo'),
                'metodo' => $request->input('metodo'),
                'marca' => $request->input('marca'),
                'lote' => $request->input('lote'),
                'fech_adquisicion' => $request->input('fech_adquisicion'),
                'fech_expiracion' => $request->input('fech_expiracion'),
                'observaciones' => $request->input('observaciones')
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
            $data = Inventario::find($id);
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
            $data = Inventario::find($id);

            if (is_null($data)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validatedData = $request->validate([
                'nombre' => 'required|string',
                'descripcion' => 'required|string',
                'categoria_id' => 'required|integer',
                'cantidad' => 'required|integer',
                'unidad_medida_id'=>'required|integer',
                'metodo'=>'required|string',
                'marca'=>'required|string',
                'lote'=>'required|string',
                'fech_adquisicion'=>'required|date',
                'fech_expiracion'=>'required|date',
                'observaciones'=>'required|string'
            ]);

            // Verificar si otro registro tiene la misma descripción (excepto el actual)
            $existingTipoMuestra = Inventario::where('nombre', $validatedData['nombre'])
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
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'categoria_id' => $request->input('categoria_id'),
                'cantidad' => $request->input('cantidad'),
                'unidad_medida_id' => $request->input('metodo'),
                'metodo' => $request->input('metodo'),
                'marca' => $request->input('marca'),
                'lote' => $request->input('lote'),
                'fech_adquisicion' => $request->input('fech_adquisicion'),
                'fech_expiracion' => $request->input('fech_expiracion'),
                'observaciones' => $request->input('observaciones')
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
            $data = Inventario::find($id);
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
