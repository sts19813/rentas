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
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->string('razon_social');
            $table->string('rfc');
            $table->string('uso_factura')->nullable();
            $table->string('regimen_fiscal')->nullable();
            $table->string('giro_negocio')->nullable();
            $table->string('correo')->nullable();
            $table->string('cp')->nullable();
            $table->string('direccion_facturacion')->nullable();
            $table->string('pais_facturacion')->nullable();
            $table->string('estado_facturacion')->nullable();
            $table->string('ciudad_facturacion')->nullable();
            $table->string('cp_facturacion')->nullable();
            // Datos del representante legal
            $table->string('nombre_representante')->nullable();
            $table->string('celular_representante')->nullable();
            $table->string('relacion_representante')->nullable();
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
