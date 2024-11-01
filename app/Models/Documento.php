<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'ruta',
    ];

    // Relación con el cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
