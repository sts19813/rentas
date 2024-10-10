<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    use HasFactory;

    protected $fillable = ['proyecto_id', 'ruta_imagen'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}