<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;

class RolController extends Controller
{
    public function index()
    {
        try{
            $roles = Role::all();
            return response()->json($roles);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage(),'status' => false]);
        }
    }
    public function store(Request $request)
    {
        try {
            $findRol= Role::where('name', $request->txtNombre)->get();
            if (count($findRol)>0){
                return response()->json(['message' => "Ya existe: ".strtoupper($request->txtNombre),'status' => false]);
            }else {
                $rol = new Role;
                $rol->name = strtolower($request->txtNombre);
                $rol->guard_name = 'web';
                $rol->save();
                return response()->json(['message' => "Registrado con exito: ".$request->txtNombre,'status' => true]);
            }
        }catch (\Exception $e){
            return response()->json(["error"=>"error",'message' => $e->getMessage(),'status' => false]);
        }
    }

    public function show($rol)
    {
        $rolid = $rol;
        $rol = DB::select("select * from roles where id = ?", [$rolid]);
        if (!empty($rol)) {
            $rolObject = $rol[0];
            return response()->json($rolObject);
        } else {
            return response()->json(['error' => 'No se encontraron resultados'], 404);
        }
    }
    public function update(Request $request, Role $rol)
    {
        try {
            if($request->txtRol) {
                $rol->name = $request->txtRol;
                $rol->save();
                return response()->json(['message' => 'Actualizado correctamente', 'status' => true,'data' => $rol]);
            }else{
                return response()->json(['error' => 'Parametro inesperado','message' => 'Parametro inesperado', 'status' => false]);
            }
        }catch (\Exception $e){
            return response()->json(['error'=>'Error del Servidor','message' => $e->getMessage(),'status' => false]);
        }
    }
    public function destroy(Role $rol)
    {
        try{
            $rol->delete();
            return response()->json(['message' => 'Se eliminó correctamente', 'status' => true]);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage(),'status' => false]);
        }
    }

}
