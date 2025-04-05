<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    protected $fillable = [
        'nombre',
        'marca',
        'modelo',
        'anio',
        'version'
    ];

    public function motor()
    {
        return $this->hasOne(Motor::class);
    }

    public function transmision()
    {
        return $this->hasOne(Transmision::class);
    }

    public function dimension()
    {
        return $this->hasOne(Dimension::class);
    }

    public function seguridad()
    {
        return $this->hasOne(Seguridad::class);
    }

    public function confort()
    {
        return $this->hasOne(Confort::class);
    }

    public function entretenimiento()
    {
        return $this->hasOne(Entretenimiento::class);
    }
} 