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
        DB::table('tipo_muestras')->insert([
            [
               'descripcion' => 'Sangre'
            ],
            [
                'descripcion' => 'Eces'
            ],
            [
                'descripcion' => 'Orina'
            ],
            [
                'descripcion' => 'Tejido'
            ],
            [
                'descripcion' => 'Líquido cefalorraquídeo (LCR)'
            ],
            [
                'descripcion' => 'ADN y ARN'
            ],
            [
                'descripcion' => 'Saliva'
            ],
            [
                'descripcion' => 'Células'
            ],
            [
                'descripcion' => 'Líquido sinovial'
            ],
        ]);
        DB::table('tipo_examens')->insert([
            [
                'descripcion'=>'INMUNOLOGIA'
            ],
            [
                'descripcion'=>'HEMATOLOGIA'
            ],
            [
                'descripcion'=>'BIOQUIMICA'
            ],
            [
                'descripcion'=>'MICROBIOLOGIA'
            ]
        ]);
        DB::table('resultados')->insert([
            [
                'nombre'=>'NEGATIVO',
                'descripcion'=>'NEGATIVO'
            ],
            [
                'nombre'=>'POSITIVO',
                'descripcion'=>'POSITIVO'
            ],
            [
                'nombre'=>'REACTIVO',
                'descripcion'=>'REACTIVO'
            ],
            [
                'nombre'=>'NO REACTIVO',
                'descripcion'=>'NO REACTIVO'
            ],
            [
                'nombre'=>'CONSERVADA',
                'descripcion'=>'CONSERVADA'
            ],
            [
                'nombre'=>'DISMINUIDA',
                'descripcion'=>'DISMINUIDA'
            ],
            [
                'nombre'=>'AUSENTE',
                'descripcion'=>'AUSENTE'
            ],
            [
                'nombre'=>'MARRON',
                'descripcion'=>'MARRON'
            ],
            [
                'nombre'=>'MARRON CLARO',
                'descripcion'=>'MARRON CLARO'
            ],
            [
                'nombre'=>'MARRON OSCURO',
                'descripcion'=>'MARRON OSCURO'
            ],
            [
                'nombre'=>'PARDO',
                'descripcion'=>'PARDO'
            ],
            [
                'nombre'=>'PARDO CLARO',
                'descripcion'=>'PARDO CLARO'
            ],
            [
                'nombre'=>'PARDO OSCURO',
                'descripcion'=>'PARDO OSCURO'
            ],
            [
                'nombre'=>'AMARILLO',
                'descripcion'=>'AMARILLO'
            ],
            [
                'nombre'=>'VERDOSO',
                'descripcion'=>'VERDOSO'
            ],
            [
                'nombre'=>'NEGRO',
                'descripcion'=>'NEGRO'
            ],
            [
                'nombre'=>'SANGUINOLENTO',
                'descripcion'=>'SANGUINOLENTO'
            ],
            [
                'nombre'=>'CREMA',
                'descripcion'=>'CREMA'
            ],
            [
                'nombre'=>'ROJIZO',
                'descripcion'=>'ROJIZO'
            ],
            [
                'nombre'=>'PASTOSA',
                'descripcion'=>'PASTOSA'
            ],
            [
                'nombre'=>'BLANDO',
                'descripcion'=>'BLANDO'
            ],
            [
                'nombre'=>'SOLIDA',
                'descripcion'=>'SOLIDA'
            ],
            [
                'nombre'=>'FORMADA',
                'descripcion'=>'FORMADA'
            ],
            [
                'nombre'=>'LIQUIDA',
                'descripcion'=>'LIQUIDA'
            ],
            [
                'nombre'=>'SEMILIQUIDA',
                'descripcion'=>'SEMILIQUIDA'
            ],
            [
                'nombre'=>'POSITIVO 1+',
                'descripcion'=>'POSITIVO 1+'
            ],
            [
                'nombre'=>'POSITIVO 2+',
                'descripcion'=>'POSITIVO 2+'
            ],
            [
                'nombre'=>'POSITIVO 3+',
                'descripcion'=>'POSITIVO 3+'
            ],
            [
                'nombre'=>'AUSENTE',
                'descripcion'=>'AUSENTE'
            ],
            [
                'nombre'=>'0 - 5',
                'descripcion'=>'0 - 5'
            ],
            [
                'nombre'=>'5 - 10',
                'descripcion'=>'5 - 10'
            ],
            [
                'nombre'=>'10 - 15',
                'descripcion'=>'10 - 15'
            ],
            [
                'nombre'=>'15 - 20',
                'descripcion'=>'15 - 20'
            ],
            [
                'nombre'=>'20 -30',
                'descripcion'=>'20 -30'
            ],
            [
                'nombre'=>'30 - 40',
                'descripcion'=>'30 - 40'
            ],
            [
                'nombre'=>'40 - 50',
                'descripcion'=>'40 - 50'
            ],
            [
                'nombre'=>'50 - 60',
                'descripcion'=>'50 - 60'
            ],
            [
                'nombre'=>'60 - 70',
                'descripcion'=>'60 - 70'
            ],
            [
                'nombre'=>'70 - 80',
                'descripcion'=>'70 - 80'
            ],
            [
                'nombre'=>'80 - 90',
                'descripcion'=>'80 - 90'
            ],
            [
                'nombre'=>'90 - 100',
                'descripcion'=>'90 - 100'
            ],
            [
                'nombre'=>'> 100',
                'descripcion'=>'> 100'
            ],
            [
                'nombre'=>'NO SE OBS. COCCIDIOS',
                'descripcion'=>'NO SE OBS. COCCIDIOS'
            ],
            [
                'nombre'=>'ISOSPORA BELLI',
                'descripcion'=>'ISOSPORA BELLI'
            ],
            [
                'nombre'=>'CRYPTOSPORIDIUM PARVUM',
                'descripcion'=>'CRYPTOSPORIDIUM PARVUM'
            ],
            [
                'nombre'=>'CYCLOSPORA CAYETANENSIS',
                'descripcion'=>'CYCLOSPORA CAYETANENSIS'
            ],
            [
                'nombre'=>'NO APLICA',
                'descripcion'=>'NO APLICA'
            ],
            [
                'nombre'=>'1',
                'descripcion'=>'1'
            ],
            [
                'nombre'=>'2',
                'descripcion'=>'2'
            ],
            [
                'nombre'=>'4',
                'descripcion'=>'4'
            ],
            [
                'nombre'=>'8',
                'descripcion'=>'8'
            ],
            [
                'nombre'=>'16',
                'descripcion'=>'16'
            ],
            [
                'nombre'=>'32',
                'descripcion'=>'32'
            ],
            [
                'nombre'=>'64',
                'descripcion'=>'64'
            ],
            [
                'nombre'=>'128',
                'descripcion'=>'128'
            ],
            [
                'nombre'=>'256',
                'descripcion'=>'256'
            ],
            [
                'nombre'=>'512',
                'descripcion'=>'512'
            ],
            [
                'nombre'=>'1024',
                'descripcion'=>'1024'
            ],
            [
                'nombre'=>'2048',
                'descripcion'=>'2048'
            ],
            [
                'nombre'=>'4096',
                'descripcion'=>'4096'
            ],
        ]);
        DB::table('tipo_examens')->insert([
            [
                'descripcion'=>'Padre'
            ],
            [
                'descripcion'=>'Madre'
            ],
            [
                'descripcion'=>'Abuelo'
            ],
            [
                'descripcion'=>'Abuela'
            ],
            [
                'descripcion'=>'Bisabuelo'
            ],
            [
                'descripcion'=>'Bisabuela'
            ],
            [
                'descripcion'=>'Hijo'
            ],
            [
                'descripcion'=>'Hija'
            ],
            [
                'descripcion'=>'Nieto'
            ],
            [
                'descripcion'=>'Nieta'
            ],
            [
                'descripcion'=>'Bisnieto'
            ],
            [
                'descripcion'=>'Bisnieta'
            ],
            [
                'descripcion'=>'Hermano'
            ],
            [
                'descripcion'=>'Hermana'
            ],
            [
                'descripcion'=>'Tío'
            ],
            [
                'descripcion'=>'Tía'
            ],
            [
                'descripcion'=>'Sobrino'
            ],
            [
                'descripcion'=>'Sobrina'
            ],
            [
                'descripcion'=>'Primo'
            ],
            [
                'descripcion'=>'Prima'
            ],
            [
                'descripcion'=>'Suegro'
            ],
            [
                'descripcion'=>'Suegra'
            ],
            [
                'descripcion'=>'Yerno'
            ],
            [
                'descripcion'=>'Nuera'
            ],
        ]);
        DB::table('vias')->insert([
            ['descripcion' => 'Avenida'],
            ['descripcion' => 'Calle'],
            ['descripcion' => 'Jirón'],
            ['descripcion' => 'Pasaje'],
            ['descripcion' => 'Carretera'],
            ['descripcion' => 'Boulevard'],
            ['descripcion' => 'Autopista'],
            ['descripcion' => 'Callejón'],
            ['descripcion' => 'Alameda'],
            ['descripcion' => 'Camino'],
            ['descripcion' => 'Vereda'],
            ['descripcion' => 'Paseo'],
            ['descripcion' => 'Plaza'],
            ['descripcion' => 'Ronda'],
            ['descripcion' => 'Travesía'],
            ['descripcion' => 'Carretón'],
            ['descripcion' => 'Circunvalación'],
            ['descripcion' => 'Peatonal'],
            ['descripcion' => 'Sendero'],
            ['descripcion' => 'Ruta']
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
