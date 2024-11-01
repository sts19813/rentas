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
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade'); 
            $table->string('nombre_razon_social');
            $table->string('rfc');
            $table->string('uso_factura');
            $table->string('regimen_fiscal');
            $table->string('giro_negocio');
            $table->string('correo');
            $table->string('codigo_postal');
            $table->string('ciudad');

            // Campos de Dirección de Facturación
            $table->string('direccion_linea1')->nullable();
            $table->string('pais')->nullable();
            $table->string('estado')->nullable();
            $table->string('ciudad_facturacion')->nullable(); // ciudad específica para facturación
            $table->string('codigo_postal_facturacion')->nullable();

            // Campos de Datos del Representante Legal
            $table->string('nombre_representante_legal')->nullable();
            $table->string('celular_representante_legal')->nullable();
            $table->string('relacion_representante_legal')->nullable();

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
