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
            $table->integer("ubigeo_reniec");
            $table->integer("ubigeo_inei");
            $table->integer("departamento_inei");
            $table->string("departamento");
            $table->string("provincia_inei");
            $table->integer("provincia");
            $table->string("distrito");
            $table->string("region");
            $table->string("macroregion_inei");
            $table->string("macroregion_minsa");
            $table->string("iso_3166_2");
            $table->integer("fips");
            $table->integer("superficie");
            $table->integer("altitud");
            $table->integer("latitud");
            $table->integer("longitud");
            $table->string("Frontera");
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
