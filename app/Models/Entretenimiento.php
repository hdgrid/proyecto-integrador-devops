<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entretenimiento extends Model
{
    protected $table = 'entretenimiento';

    protected $fillable = [
        'auto_id',
        'sistema_infotainment',
        'pantalla_principal',
        'pantalla_secundaria',
        'sistema_sonido',
        'numero_parlantes',
        'bluetooth',
        'android_auto',
        'apple_carplay',
        'navegador_gps',
        'cargador_inalambrico',
        'puertos_usb'
    ];

    protected $casts = [
        'pantalla_principal' => 'float',
        'pantalla_secundaria' => 'boolean',
        'bluetooth' => 'boolean',
        'android_auto' => 'boolean',
        'apple_carplay' => 'boolean',
        'navegador_gps' => 'boolean',
        'cargador_inalambrico' => 'boolean'
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class);
    }
} 