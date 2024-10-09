<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidades'; 

    use HasFactory;
    protected $fillable = [
        'proyecto_id', 'metros_cuadrados', 'precio_por_hora', 'precio_por_mes', 'nivel', 'estatus'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
