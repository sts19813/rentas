<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id',
        'start_date',
        'end_date',
        'price',
    ];

    public function Unidad()
    {
        return $this->belongsTo(Unidad::class);
    }
}
