<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especificar los campos que se pueden llenar masivamente
    protected $fillable = [ 
        'mes_renta',
        'plaza',
        'fecha_pago',
        'tolerancia',
        'fecha_vencimiento',
        'fecha_inicio',
        'local',
        'mensualidad',
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'tipo_cliente',
        'correo',
        'nacionalidad',
        'celular',
        'ciudad',
        'direccion',
        'pais',
        'estado',
        'ciudad_cliente',
        'codigo_postal',
        'status',
        'nombre_aval',
        'celular_aval',
        'relacion_aval',
        'nombreR1',
        'celularR1',
        'correoR1',
        'relacionR1',
        'nombreR2',
        'celularR2',
        'correoR2',
        'relacionR2',
        'nombreR3',
        'celularR3',
        'correoR3',
        'relacionR3',

    ];

    // Opcional: puedes definir algunas mutaciones o conversiones
    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function negocio()
    {
        return $this->hasOne(Negocio::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function plaza()
    {
        return $this->belongsTo(Unidad::class, 'plaza');
    }

    public function rentPrice()
    {
        return $this->hasMany(RentPrice::class, 'cliente_id');
    }
}
