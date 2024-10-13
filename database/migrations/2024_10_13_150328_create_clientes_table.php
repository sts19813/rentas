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
            $table->string('apellido');
            $table->enum('tipo_cliente', ['persona_fisica', 'persona_moral'])->default('persona_fisica');
            $table->string('celular');
            $table->string('correo');
            $table->date('fecha_nacimiento');
            $table->string('nacionalidad');
            $table->string('ciudad');
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
