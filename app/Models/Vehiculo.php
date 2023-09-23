<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'pasajeros',
        'vencimiento_soat',
        'vencimiento_tec_mec',
        'vencimiento_todo_riesgo',
        'estado'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
