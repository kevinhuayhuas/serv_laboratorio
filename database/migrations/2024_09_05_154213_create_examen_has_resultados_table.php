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
        Schema::create('examen_has_resultados', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("examen_id");
            $table->foreign('examen_id')->references('id')->on('examens')->onDelete('cascade');
            $table->unsignedInteger("resultado_id");
            $table->foreign('resultado_id')->references('id')->on('resultados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examen_has_resultados');
    }
};
