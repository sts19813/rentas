<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    // Campos asignables en la creación masiva
    protected $fillable = [
        'nombre', 
        'cantidad_locales', 
        'cantidad_cajones', 
        'precio_renta', 
        'cuota_mantenimiento', 
        'niveles', 
        'hora_apertura', 
        'hora_cierre', 
        'direccion1', 
        'pais', 
        'estado', 
        'ciudad', 
        'codigo_postal'
    ];

     // Relación muchos a muchos con Amenidades
     public function amenidades()
{
    return $this->belongsToMany(Amenidades::class, 'proyecto_amenidad', 'proyecto_id', 'amenidad_id');
}
 
     // Relación muchos a muchos con Servicios
     public function servicios()
     {
         return $this->belongsToMany(Servicio::class, 'proyecto_servicio');
     }

     //relacion con las unidades
     public function unidades()
    {
        return $this->hasMany(Unidad::class);
    }
}
