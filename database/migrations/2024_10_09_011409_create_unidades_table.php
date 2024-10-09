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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id'); // Relación con proyecto
            $table->integer('metros_cuadrados');
            $table->decimal('precio_por_hora', 8, 2);
            $table->decimal('precio_por_mes', 10, 2);
            $table->string('nivel'); // Planta Baja, Alta
            $table->enum('estatus', ['disponible', 'comprometido', 'rentado'])->default('disponible');
            $table->timestamps();
    
            // Llave foránea para proyectos
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
