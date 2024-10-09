<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenidades extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Relación con Proyectos
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_amenidad');
    }
}
