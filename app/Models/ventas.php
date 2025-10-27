<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    // 🔹 Nombre de la tabla (asegura que sea plural o igual al nombre real)
    protected $table = 'ventas';

    // 🔹 Campos que se pueden asignar masivamente
    protected $fillable = [
        'descripcion',
        'tipo',
        'total',
        'fecha',
        'productos',
        'gran_total',
    ];

    // 🔹 Casts automáticos
    protected $casts = [
        'productos' => 'array',  // Laravel convierte JSON a array automáticamente
        'fecha' => 'datetime',   // Asegura formato de fecha
    ];
}
