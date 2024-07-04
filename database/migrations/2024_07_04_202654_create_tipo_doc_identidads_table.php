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
        Schema::create('tipo_doc_identidads', function (Blueprint $table) {
            $table->increments("id");
            $table->string("descripcion_larga");
            $table->string("descripcion_corta");
            $table->integer("longitud");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_doc_identidads');
    }
};
