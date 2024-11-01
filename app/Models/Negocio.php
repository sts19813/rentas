<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'nombre_razon_social',
        'rfc',
        'uso_factura',
        'regimen_fiscal',
        'giro_negocio',
        'correo',
        'codigo_postal',
        'ciudad',
        'direccion_linea1',
        'pais',
        'estado',
        'ciudad_facturacion',
        'codigo_postal_facturacion',
        'nombre_representante_legal',
        'celular_representante_legal',
        'relacion_representante_legal',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
