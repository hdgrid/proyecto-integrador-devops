<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transmision extends Model
{
    protected $table = 'transmisiones';

    protected $fillable = [
        'auto_id',
        'tipo',
        'traccion',
        'marchas'
    ];

    public function auto()
    {
        return $this->belongsTo(Auto::class);
    }
} 