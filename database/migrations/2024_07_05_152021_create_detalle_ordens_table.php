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
        Schema::create('detalle_ordens', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("orden_id");
            $table->foreign('orden_id')->references('id')->on('ordens')->onDelete('cascade');
            $table->unsignedInteger("inventario_id");
            $table->foreign('inventario_id')->references('id')->on('inventarios')->onDelete('cascade');
            $table->unsignedInteger("resultado_id");
            $table->foreign('resultado_id')->references('id')->on('resultados')->onDelete('cascade');
            $table->date("fecha_muestra");
            $table->unsignedInteger("examen_id");
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ordens');
    }
};
