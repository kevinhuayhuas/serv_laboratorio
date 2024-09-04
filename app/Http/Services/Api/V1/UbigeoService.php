<?php

namespace App\Http\Services\Api\V1;

use Illuminate\Support\Facades\DB;

class UbigeoService{

    public function getDepartamentos()
    {
        $departamentos =  DB::select("select * from v_departamentos");
        return $departamentos;
    }

    public function getProvincias($departamento)
    {
        $provincias = DB::select("exec p_provincia_x_departamento ?", [$departamento]);
        return $provincias;
    }

    public function getDistritos($provincia)
    {
        $distritos = DB::select("exec p_distrito_x_provincia ?", [$provincia]);
        return $distritos;
    }


}
