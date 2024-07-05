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
        Schema::create('ordens', function (Blueprint $table) {
            $table->increments("id");
            $table->dateTime("fecha");
            $table->unsignedInteger("establecimiento_id");
            $table->foreign('establecimiento_id')->references('id')->on('establecimientos')->onDelete('cascade');
            $table->unsignedInteger("paciente_id");
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->unsignedInteger("poblacion_id");
            $table->foreign('poblacion_id')->references('id')->on('poblacions')->onDelete('cascade');
            $table->string("HC");
            $table->integer("edad");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens');
    }
};
