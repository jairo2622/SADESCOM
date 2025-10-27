<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pyg extends Model
{
    protected $fillable = ['descripcion', 'total', 'gran_total'];

    protected $casts = [
        'descripcion' => 'array',
        'total' => 'array',
    ];
}
