<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
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
        'vencimiento_tarjeta_operacion',
        'estado',
        'razon_estado'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Scope a query to only include vehicle of a given id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeId($query, $id)
    {
        if($id) return $query->where('id', $id);
    }

    /**
     * Scope a query to only include vehicle of a given placa.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $placa
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePlaca($query, $placa)
    {
        if($placa) return $query->where('placa', $placa);
    }
}
