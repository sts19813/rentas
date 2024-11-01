<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'razon_social',
        'rfc',
        'uso_factura',
        'regimen_fiscal',
        'giro_negocio',
        'correo',
        'cp',
        'direccion_facturacion',
        'pais_facturacion',
        'estado_facturacion',
        'ciudad_facturacion',
        'cp_facturacion', 
        'nombre_representante',
        'celular_representante',
        'relacion_representante'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
