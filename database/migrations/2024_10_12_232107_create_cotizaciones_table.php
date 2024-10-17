<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('unidad_id')->constrained('unidades')->onDelete('cascade');
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('tipo_cliente', ['persona_fisica', 'persona_moral'])->default('persona_fisica');
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();
            $table->decimal('primer_pago', 10, 2);
            $table->enum('tipo_renta', ['hora', 'dia', 'mes', 'año']);
            $table->integer('duracion')->nullable(); // Cantidad de horas, días o meses según el tipo de renta
            $table->datetime('fecha_inicio'); // Fecha de inicio de la renta
            $table->datetime('fecha_fin')->nullable(); // Fecha de finalizacion de la renta
            $table->decimal('total', 8, 2);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacions');
    }
};
