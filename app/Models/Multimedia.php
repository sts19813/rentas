<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = ['proyecto_id', 'ruta_multimedia'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}