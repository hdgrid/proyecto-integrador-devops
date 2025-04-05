<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $table = 'motores';

    protected $fillable = [
        'auto_id',
        'tipo',
        'cilindros',
        'cilindrada',
        'potencia',
        'torque',
        'combustible'
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class);
    }
} 