<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    protected $table = 'dimensiones';

    protected $fillable = [
        'auto_id',
        'largo',
        'ancho',
        'alto',
        'peso',
        'capacidad_tanque',
        'capacidad_cajuela',
        'distancia_ejes'
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class);
    }
} 