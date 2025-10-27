<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'nombre',
        'cantidad',
        'preciounidad',
        'proveedor',
        'perecedero',
        'fechavencimiento',
    ];
}
