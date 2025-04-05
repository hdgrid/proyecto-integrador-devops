<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confort extends Model
{
    protected $table = 'confort';

    protected $fillable = [
        'auto_id',
        'aire_acondicionado',
        'climatizador',
        'asientos_calefactables',
        'asientos_electricos',
        'techo_solar',
        'volante_multifuncion',
        'control_crucero',
        'encendido_sin_llave'
    ];

    protected $casts = [
        'aire_acondicionado' => 'boolean',
        'climatizador' => 'boolean',
        'asientos_calefactables' => 'boolean',
        'asientos_electricos' => 'boolean',
        'techo_solar' => 'boolean',
        'volante_multifuncion' => 'boolean',
        'control_crucero' => 'boolean',
        'encendido_sin_llave' => 'boolean'
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class);
    }
} 