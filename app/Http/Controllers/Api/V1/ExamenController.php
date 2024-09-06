<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Examen;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\Api\V1\ExamenService;

class ExamenController extends Controller
{

    protected $examenService;

    public function __construct(ExamenService $examenService)
    {
        $this->examenService = $examenService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/examen",
     *     summary="Obtener todos los exámenes",
     *     tags={"Exámenes"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de exámenes",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nombre_examen", type="string", example="Examen de sangre"),
     *                 @OA\Property(property="descripcion", type="string", example="Descripción del examen"),
     *                 @OA\Property(property="n1", type="string", example="Valor III-1"),
     *                 @OA\Property(property="n2", type="string", example="Valor II-2"),
     *                 @OA\Property(property="n3", type="string", example="Valor II-1"),
     *                 @OA\Property(property="n4", type="string", example="Valor I-4"),
     *                 @OA\Property(property="n5", type="string", example="Valor I-3"),
     *                 @OA\Property(property="n6", type="string", example="Valor I-2"),
     *                 @OA\Property(property="n7", type="string", example="Valor I-1"),
     *                 @OA\Property(property="tipo_examen_id", type="integer", example=1),
     *                 @OA\Property(property="tipo_muestra_id", type="integer", example=1),
     *                 @OA\Property(property="estado", type="string", example="Activo"),
     *                 @OA\Property(property="identificador_texamen", type="integer", example=1),
     *                 @OA\Property(property="nombre_texamen", type="string", example="Tipo de Examen"),
     *                 @OA\Property(property="descripcion_texamen", type="string", example="Descripción del tipo de examen")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error del servidor",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Error del Servidor"),
     *             @OA\Property(property="message", type="string", example="Detalles del error")
     *         )
     *     )
     * )
     */
    public function index()
    {
        try {
            $data = $this->examenService->getExamenes();
            return response()->json($data);
        }catch (\Exception $exception) {
            return response()->json([
                'error' => 'Error del Servidor',
                'message' => $exception->getMessage(),
                'status' => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getExtablecimientoPorTipoExamen($tipoexamen){
            try{
                $data=$this->examenService->getExamenesPorTipoExamenes($tipoexamen);
                return response()->json($data);
            }catch (\Exception $exception) {
                return response()->json([
                    'error' => 'Error del Servidor',
                    'message' => $exception->getMessage(),
                    'status' => false,
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:355',
            'tipo_muestra_id' => 'required|integer'
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
            $existing = Examen::where('nombre', $request->input('nombre'))->first();
            if ($existing) {
                return response()->json([
                    'message' => "Ya existe este registro",
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            $data = Examen::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'tipo_muestra_id' => $request->input('tipo_muestra_id')
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
            $data = Examen::find($id);

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
    public function update(Request $request, $id)
    {
        try {
            $data = Examen::find($id);

            if (is_null($data)) {
                return response()->json(['message' => 'Registro no encontrado'], Response::HTTP_NOT_FOUND);
            }

            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string|max:355',
                'tipo_muestra_id' => 'required|integer'
            ]);

            // Verificar si otro registro tiene la misma descripción (excepto el actual)
            $existing= Examen::where('nombre', $validatedData['nombre'])
                ->where('id', '!=', $id) // Excluir el registro actual
                ->first();

            if ($existing) {
                return response()->json([
                    'message' => 'Ya existe otro registro con el mismo nombre',
                    'status' => false,
                ], Response::HTTP_CONFLICT); // Código 409: Conflicto
            }

            // Actualizar el registro
            $data->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'tipo_muestra_id' => $request->input('tipo_muestra_id')
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
            $data = Examen::find($id);
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
