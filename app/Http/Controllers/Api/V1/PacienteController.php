<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = DB::select("select * from v_pacientes");
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
            'tipoDocIndentidad_id' => 'required|integer',
            'num_doc' => 'required|string',
            'nombres' => 'required|string',
            'ape_pat' => 'required|string',
            'ape_mat' => 'required|string',
            'fecha_nac' => 'required|date',
            'ubigeo_id' => 'required|integer',
            'via_id' => 'required|integer',
            'numero_via' => 'required|string',
            'direccion' => 'required|string',
            'telef_fijo' => 'required|string',
            'telef_movil' => 'required|string',
            'correo' => 'required|string',
            'parentesco_id' => 'required|integer',
            'telefono_parentesco' => 'required|string',
            'nomape_parentesco' => 'required|string',
            'sexo_id' => 'required|integer',
            'estadoCivil_id' => 'required|integer'
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
            $data = Paciente::create([
                'tipoDocIndentidad_id' => $request->input('tipoDocIndentidad_id'),
                'num_doc' => $request->input('num_doc'),
                'nombres' => $request->input('nombres'),
                'ape_pat' => $request->input('ape_pat'),
                'ape_mat' => $request->input('ape_mat'),
                'fecha_nac' => $request->input('fecha_nac'),
                'ubigeo_id' => $request->input('ubigeo_id'),
                'via_id' => $request->input('via_id'),
                'numero_via' => $request->input('numero_via'),
                'direccion' => $request->input('direccion'),
                'telef_fijo' => $request->input('telef_fijo'),
                'telef_movil' => $request->input('telef_movil'),
                'correo' => $request->input('correo'),
                'parentesco_id' => $request->input('parentesco_id'),
                'telefono_parentesco' => $request->input('telefono_parentesco'),
                'nomape_parentesco' => $request->input('nomape_parentesco'),
                'sexo_id' => $request->input('sexo_id'),
                'estadoCivil_id' => $request->input('estadoCivil_id')
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
    public function show($id)
    {
        try {
            $data = Paciente::find($id);
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
    public function update(Request $request,$id)
    {
        try {
            $data = Paciente::find($id);

            if (is_null($data)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validatedData = Validator::make($request->all(), [
                'tipoDocIndentidad_id' => 'required|integer',
                'num_doc' => 'required|string',
                'nombres' => 'required|string',
                'ape_pat' => 'required|string',
                'ape_mat' => 'required|string',
                'fecha_nac' => 'required|date',
                'ubigeo_id' => 'required|integer',
                'via_id' => 'required|integer',
                'numero_via' => 'required|string',
                'direccion' => 'required|string',
                'telef_fijo' => 'required|string',
                'telef_movil' => 'required|string',
                'correo' => 'required|string',
                'parentesco_id' => 'required|integer',
                'telefono_parentesco' => 'required|string',
                'nomape_parentesco' => 'required|string',
                'sexo_id' => 'required|integer',
                'estadoCivil_id' => 'required|integer'
            ]);
            if ($validatedData->fails()) {
                $errors = $validatedData->errors();
                return response()->json([
                    'error' => 'Error de validación',
                    'message' => $errors->all(),
                    'status' => false,
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            // Actualizar el registro
            $data->update([
                'tipoDocIndentidad_id' => $request->input('descripcion'),
                'num_doc' => $request->input('num_doc'),
                'nombres' => $request->input('nombres'),
                'ape_pat' => $request->input('ape_pat'),
                'ape_mat' => $request->input('ape_mat'),
                'fecha_nac' => $request->input('fecha_nac'),
                'ubigeo_id' => $request->input('ubigeo_id'),
                'via_id' => $request->input('via_id'),
                'numero_via' => $request->input('numero_via'),
                'direccion' => $request->input('direccion'),
                'telef_fijo' => $request->input('telef_fijo'),
                'telef_movil' => $request->input('telef_movil'),
                'correo' => $request->input('correo'),
                'parentesco_id' => $request->input('parentesco_id'),
                'telefono_parentesco' => $request->input('telefono_parentesco'),
                'nomape_parentesco' => $request->input('nomape_parentesco'),
                'sexo_id' => $request->input('sexo_id'),
                'estadoCivil_id' => $request->input('estadoCivil_id')
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
    public function destroy($id)
    {
        try{
            $data = Paciente::find($id);
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
