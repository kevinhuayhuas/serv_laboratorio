<?php
namespace App\Http\Services\Api\V1;

use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class PacienteService{


    public function getPacientes(){
        $data = DB::select("select * from v_pacientes");
        return $data;
    }

    public function getPacientesPorInicialesFecha_Nac($iniciales,$fecha_nacimiento){
        $data = Paciente::where('iniciales',$iniciales)->where('fecha_nac',$fecha_nacimiento)->get();
        return $data;
    }

}
