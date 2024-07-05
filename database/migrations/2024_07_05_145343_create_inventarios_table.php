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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->increments("id");
            $table->string("nombre");
            $table->string("descripcion");
            $table->unsignedInteger("categoria_id");
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->integer("cantidad");
            $table->unsignedInteger("unidad_medida_id");
            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas')->onDelete('cascade');
            $table->string("metodo");
            $table->string("marca");
            $table->string("lote");
            $table->date("fech_adquisicion");
            $table->date("fech_expiracion");
            $table->string("observaciones");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
