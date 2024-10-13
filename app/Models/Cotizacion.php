<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{

    protected $table = 'cotizaciones'; 

    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'unidad_id',
        'nombre',
        'apellido',
        'tipo_cliente',
        'celular',
        'correo',
        'primer_pago',
        'tipo_renta',
        'duracion',
        'fecha_inicio',
        'total',
    ];
}
