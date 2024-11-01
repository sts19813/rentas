<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'nombre',
        'celular',
        'correo',
        'relacion',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
