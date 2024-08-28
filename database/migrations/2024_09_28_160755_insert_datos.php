<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Insert default administrator role
        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Usuario',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        //insert dafeult sexo
        DB::table('sexos')->insert([
            [
                'nombre' => 'MASCULINO',
                'abreviatura' => 'M',
            ],
            [
                'nombre' => 'FEMENINO',
                'abreviatura' => 'F',
            ]
        ]);
        DB::table('tipo_doc_identidads')->insert([
            [
                'descripcion_larga' => 'Documento Nacional de Identidad',
                'descripcion_corta' => 'DNI',
                'longitud'=>8,
            ],
            [
                'descripcion_larga' => 'CARNET DE EXTRANJERIA',
                'descripcion_corta' => 'CARNET EXT.',
                'longitud'=>12
            ],
            [
                'descripcion_larga' => 'REG. UNICO DE CONTRIBUYENTES',
                'descripcion_corta' => 'RUC',
                'longitud'=>11
            ],
            [
                'descripcion_larga' => 'PASAPORTE',
                'descripcion_corta' => 'PASAPORTE',
                'longitud'=>12
            ],
            [
                'descripcion_larga' => 'PART. DE NACIMIENTO-IDENTIDAD',
                'descripcion_corta' => 'P. NAC.',
                'longitud'=>15
            ]
        ]);
        DB::table('estado_civils')->insert([
            [
                'nombre' => 'Soltero',
                'descripcion' => 'La persona no ha contraído matrimonio',
            ],
            [
                'nombre' => 'Casado',
                'descripcion' => 'La persona ha contraído matrimonio y el vínculo está legalmente reconocido',
            ],
            [
                'nombre' => 'Viudo',
                'descripcion' => 'La persona ha perdido a su cónyuge y no ha vuelto a casarse',
            ],
            [
                'nombre' => 'Divorciado',
                'descripcion' => 'La persona ha disuelto su matrimonio a través de un proceso legal',
            ],
            [
                'nombre' => 'Separado',
                'descripcion' => 'La persona está en un proceso de separación formal del cónyuge, pero no ha finalizado un divorcio',
            ]
        ]);
        DB::table('poblacions')->insert([
            [
                'descripcion' => 'TRABAJADOR(A) SEXUAL',
                'abreviatura' => 'TS',
            ],
            [
                'descripcion' => 'HOMBRE QUE TIENE SEXO CON HOMBRE',
                'abreviatura' => 'HSH',
            ],
            [
                'descripcion' => 'TRANSGÉNERO',
                'abreviatura' => 'TRA',
            ],
            [
                'descripcion' => 'HSH QUE ES TS',
                'abreviatura' => 'HTS',
            ],
            [
                'descripcion' => 'TRANSGENERO QUE ES TS',
                'abreviatura' => 'TTS',
            ],
            [
                'descripcion' => 'MUJER EN EDAD FÉRTIL',
                'abreviatura' => 'MEF',
            ],
            [
                'descripcion' => 'M POBLACION GENERAL',
                'abreviatura' => 'MPG',
            ],
            [
                'descripcion' => 'F POBLACION GENERAL',
                'abreviatura' => 'FPG',
            ],
            [
                'descripcion' => 'M PACIENTE CON TUBERCULOSIS',
                'abreviatura' => 'MPCT',
            ],
            [
                'descripcion' => 'F PACIENTE CON TUBERCULOSIS',
                'abreviatura' => 'FPCT',
            ],
            [
                'descripcion' => 'GESTANTE',
                'abreviatura' => 'GEST',
            ],
            [
                'descripcion' => 'PUERPERA',
                'abreviatura' => 'PP',
            ]
        ]);
        DB::table('examens')->insert([
            [
                'nombre' => 'Secreción Vaginal',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Sedimento Urinario',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Prueba Rápida de HIV',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'RPR',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Prueba Rápida de HBsAg',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Prueba Rápida DUAL VIH/Sífilis',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'GRAM de Secreción Uretral',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Exámen Directo/GRAM de Secreción (Otros)',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Prueba Rápida de Sífilis',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'TPHA',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Cultivo de Secreción Cervical',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Cultivo de Secreción Uretral',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Cultivo de Hisopado Faringeo',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Cultivo de Secreción Anal',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Prueba Rápida de Clamidia',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'ELISA HIV',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Panel Hepatitis B',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Exámen de Heces',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'CARGA VIRAL',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Recuento de CD4',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Testosterona Total',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Herpes II - IgM',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Testosterona Libre',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Progesterona',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Hepatitis C',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
            [
                'nombre' => 'Prueba Rápida de HCV',
                'descripcion' => '',
                'tipo_examen_id'=>null,
                'tipo_muestra_id'=>null,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
