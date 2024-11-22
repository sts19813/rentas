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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('correo');
            $table->string('mes_renta')->nullable();
            $table->foreignId('plaza')->constrained('proyectos')->onDelete('cascade'); // Relación con 'proyectos'
            $table->foreignId('local')->constrained('unidades')->onDelete('cascade'); // Relación con 'unidades'

            $table->string('fecha_pago')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->decimal('mensualidad', 10, 2)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('tipo_cliente', ['persona_fisica', 'persona_moral'])->default('persona_fisica');
            $table->string('nacionalidad')->nullable();
            $table->string('celular')->nullable();
            $table->string('direccion')->nullable();
            $table->string('pais')->nullable();
            $table->string('estado')->nullable();
            $table->string('ciudad_cliente')->nullable();
            $table->string('codigo_postal')->nullable();

            $table->enum('status', [
                'activo', 
                'inactivo', 
                'suspendido', 
                'en_espera', 
                'cancelado', 
                'finalizado', 
                'preaprobado', 
                'pendiente_de_pago'
            ])->default('activo');

            // Datos del aval
            $table->string('nombre_aval')->nullable();
            $table->string('celular_aval')->nullable();
            $table->string('relacion_aval')->nullable();

            //referencias
            $table->string('nombreR1');
            $table->string('celularR1');
            $table->string('correoR1');
            $table->string('relacionR1')->nullable();

            $table->string('nombreR2');
            $table->string('celularR2');
            $table->string('correoR2');
            $table->string('relacionR2')->nullable();

            $table->string('nombreR3');
            $table->string('celularR3');
            $table->string('correoR3');
            $table->string('relacionR3')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
