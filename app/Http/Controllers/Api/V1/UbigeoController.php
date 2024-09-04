<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ubigeo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Api\V1\UbigeoService;

class UbigeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $ubigeoService;

    public function __construct(UbigeoService $ubigeoService){
        $this->ubigeoService = $ubigeoService;
    }

    public function index()
    {
        try {
            $data = Ubigeo::all();
            return response()->json($data);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getDepartamentos(){
        try {
            $departamentos = $this->ubigeoService->getDepartamentos();
            return response()->json($departamentos);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getProvincias($departamento){
        try {
            $departamentos = $this->ubigeoService->getProvincias($departamento);
            return response()->json($departamentos);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getDistritos($provincia){
        try {
            $departamentos = $this->ubigeoService->getDistritos($provincia);
            return response()->json($departamentos);
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
            'ubigeo_reniec' => 'required|string',
            'ubigeo_inei' => 'required|string',
            'departamento_inei' => 'required|string',
            'departamento' => 'required|string',
            'provincia_inei' => 'required|string',
            'provincia' => 'required|integer',
            'distrito' => 'required|string',
            'region' => 'required|string',
            'macroregion_inei' => 'required|string',
            'macroregion_minsa' => 'required|string',
            'iso_3166_2' => 'required|string',
            'fips' => 'required|integer',
            'superficie' => 'required|integer',
            'altitud' => 'required|integer',
            'latitud' => 'required|integer',
            'longitud' => 'required|integer',
            'Frontera' => 'required|string',
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
            $data = Ubigeo::create([
                'ubigeo_reniec' => $request->input('ubigeo_reniec'),
                'ubigeo_inei' => $request->input('ubigeo_inei'),
                'departamento_inei' => $request->input('departamento_inei'),
                'departamento' => $request->input('departamento'),
                'provincia_inei' => $request->input('provincia_inei'),
                'provincia' => $request->input('provincia'),
                'distrito' => $request->input('distrito'),
                'region' => $request->input('region'),
                'macroregion_inei' => $request->input('macroregion_inei'),
                'macroregion_minsa' => $request->input('macroregion_minsa'),
                'iso_3166_2' => $request->input('iso_3166_2'),
                'fips' => $request->input('fips'),
                'superficie' => $request->input('superficie'),
                'altitud' => $request->input('altitud'),
                'latitud' => $request->input('latitud'),
                'longitud' => $request->input('longitud'),
                'Frontera' => $request->input('Frontera')
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
            $data = Ubigeo::find($id);
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
    public function update(Request $request,  $id)
    {
        try {
            $data = Ubigeo::find($id);

            if (is_null($data)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }
            $validator = Validator::make($request->all(), [
                'ubigeo_reniec' => 'required|string',
                'ubigeo_inei' => 'required|string',
                'departamento_inei' => 'required|string',
                'departamento' => 'required|string',
                'provincia_inei' => 'required|string',
                'provincia' => 'required|integer',
                'distrito' => 'required|string',
                'region' => 'required|string',
                'macroregion_inei' => 'required|string',
                'macroregion_minsa' => 'required|string',
                'iso_3166_2' => 'required|string',
                'fips' => 'required|integer',
                'superficie' => 'required|integer',
                'altitud' => 'required|integer',
                'latitud' => 'required|integer',
                'longitud' => 'required|integer',
                'Frontera' => 'required|string',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json([
                    'error' => 'Error de validación',
                    'message' => $errors->all(),
                    'status' => false,
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            // Actualizar el registro
            $data->update([
                'ubigeo_reniec' => $request->input('ubigeo_reniec'),
                'ubigeo_inei' => $request->input('ubigeo_inei'),
                'departamento_inei' => $request->input('departamento_inei'),
                'departamento' => $request->input('departamento'),
                'provincia_inei' => $request->input('provincia_inei'),
                'provincia' => $request->input('provincia'),
                'distrito' => $request->input('distrito'),
                'region' => $request->input('region'),
                'macroregion_inei' => $request->input('macroregion_inei'),
                'macroregion_minsa' => $request->input('macroregion_minsa'),
                'iso_3166_2' => $request->input('iso_3166_2'),
                'fips' => $request->input('fips'),
                'superficie' => $request->input('superficie'),
                'altitud' => $request->input('altitud'),
                'latitud' => $request->input('latitud'),
                'longitud' => $request->input('longitud'),
                'Frontera' => $request->input('Frontera')
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
            $data = Ubigeo::find($id);
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
