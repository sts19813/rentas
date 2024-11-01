<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especificar los campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_cliente',
        'celular',
        'correo',
        'fecha_nacimiento',
        'nacionalidad',
        'ciudad',
    ];

    // Opcional: puedes definir algunas mutaciones o conversiones
    protected $casts = [
        'fecha_nacimiento' => 'date', // Asegura que se maneje como una instancia de Carbon
    ];

    public function negocio()
    {
        return $this->hasOne(Negocio::class);
    }

    public function referencias()
    {
        return $this->hasMany(Referencia::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
