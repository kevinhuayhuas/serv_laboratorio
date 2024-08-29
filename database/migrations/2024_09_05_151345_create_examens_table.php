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
        Schema::create('examens', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre");
            $table->string("descripcion")->nullable();
            $table->boolean("III-1")->nullable();
            $table->boolean("II-2")->nullable();
            $table->boolean("II-1")->nullable();
            $table->boolean("I-4")->nullable();
            $table->boolean("I-3")->nullable();
            $table->boolean("I-2")->nullable();
            $table->boolean("I-1")->nullable();
            $table->unsignedInteger("tipo_examen_id")->nullable();
            $table->foreign('tipo_examen_id')->references('id')->on('tipo_examens')->onDelete('cascade');
            $table->unsignedInteger("tipo_muestra_id")->nullable();
            $table->foreign('tipo_muestra_id')->references('id')->on('tipo_muestras')->onDelete('cascade');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
