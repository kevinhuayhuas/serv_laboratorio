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
        Schema::create('ubigeos', function (Blueprint $table) {
            $table->increments("id");
            $table->string("ubigeo_reniec")->nullable();
            $table->string("ubigeo_inei")->nullable();
            $table->string("departamento_inei")->nullable();
            $table->string("departamento")->nullable();
            $table->string("provincia_inei")->nullable();
            $table->string("provincia")->nullable();
            $table->string("distrito")->nullable();
            $table->string("region")->nullable();
            $table->string("macroregion_inei")->nullable();
            $table->string("macroregion_minsa")->nullable();
            $table->string("iso_3166_2")->nullable();
            $table->string("fips")->nullable();
            $table->string("superficie")->nullable();
            $table->string("altitud")->nullable();
            $table->string("latitud")->nullable();
            $table->string("longitud")->nullable();
            $table->string("Frontera")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubigeos');
    }
};
