<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguridad extends Model
{
    protected $table = 'seguridad';

    protected $fillable = [
        'auto_id',
        'airbags',
        'abs',
        'control_traccion',
        'control_estabilidad',
        'asistente_frenado',
        'monitoreo_presion_neumaticos',
        'camara_reversa',
        'sensores_estacionamiento'
    ];

    protected $casts = [
        'abs' => 'boolean',
        'control_traccion' => 'boolean',
        'control_estabilidad' => 'boolean',
        'asistente_frenado' => 'boolean',
        'monitoreo_presion_neumaticos' => 'boolean',
        'camara_reversa' => 'boolean',
        'sensores_estacionamiento' => 'boolean'
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class);
    }
} 