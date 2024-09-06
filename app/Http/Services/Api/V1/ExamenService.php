<?php

namespace App\Http\Services\Api\V1;

use App\Models\Examen;
use Illuminate\Support\Facades\DB;

class ExamenService{

    public function getExamenes(){
        //return Examen::all();
        return DB::table('vista_examenes')->get();
    }
    public function getExamenesPorTipoExamenes($tipoexamen){
        $data = Examen::where('tipo_examen_id',$tipoexamen)->get();
        return  $data;
    }
}
