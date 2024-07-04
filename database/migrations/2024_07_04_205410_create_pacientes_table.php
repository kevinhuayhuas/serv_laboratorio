<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("tipoDocIndentidad_id");
            $table->foreign('tipoDocIndentidad_id')->references('id')->on('tipo_doc_identidads')->onDelete('cascade');
            $table->string("num_doc");
            $table->string("nombres");
            $table->string("ape_pat");
            $table->string("ape_mat");
            $table->date("fecha_nac");
            $table->unsignedInteger("ubigeo_id");
            $table->foreign('ubigeo_id')->references('id')->on('ubigeos')->onDelete('cascade');
            $table->unsignedInteger("via_id");
            $table->foreign('via_id')->references('id')->on('vias')->onDelete('cascade');
            $table->string("numero_via");
            $table->string("direccion");
            $table->string("telef_fijo")->nullable();
            $table->string("telef_movil")->nullable();
            $table->string("correo")->nullable();
            $table->unsignedInteger("parentesco_id");
            $table->foreign('parentesco_id')->references('id')->on('parentescos')->onDelete('cascade');
            $table->string("telefono_parentesco")->nullable();
            $table->string("nomape_parentesco")->nullable();
            $table->unsignedInteger("sexo_id");
            $table->foreign('sexo_id')->references('id')->on('sexos')->onDelete('cascade');
            $table->unsignedInteger("estadoCivil_id");
            $table->foreign('estadoCivil_id')->references('id')->on('estado_civils')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
