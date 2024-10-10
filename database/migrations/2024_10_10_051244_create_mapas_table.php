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
        Schema::create('mapas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id'); // Relación con proyecto
            $table->string('ruta_imagen'); // Ruta de la imagen del mapa
            $table->timestamps();
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapas');
    }
};
