<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id(); // Llave primaria
            $table->string('nombre'); // Nombre de la plaza
            $table->integer('cantidad_locales'); // Cantidad de locales
            $table->integer('cantidad_cajones'); // Cantidad de cajones de estacionamiento
            $table->decimal('precio_renta', 10, 2)->nullable(); // Precio promedio de renta (nullable)
            $table->decimal('cuota_mantenimiento', 10, 2); // Cuota de mantenimiento
            $table->integer('niveles'); // Niveles de la plaza
            $table->time('hora_apertura'); // Hora de apertura
            $table->time('hora_cierre'); // Hora de cierre
            $table->string('direccion1'); // Dirección
            $table->string('pais'); // Relación con tabla de países
            $table->string('estado'); // Relación con tabla de estados
            $table->string('ciudad'); // Relación con tabla de ciudades
            $table->string('codigo_postal'); // Código postal
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
};
