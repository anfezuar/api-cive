<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo',
        'estado',
        'descripcion',
        'usuario',
        'created_at',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehiculo');
    }

    /**
     * Scope a query to only include tickets of a given id.
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
     * Scope a query to only include tickets of a given usuario.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $usuario
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUsuario($query, $usuario)
    {
        if($usuario) return $query->where('usuario', $usuario);
    }

    /**
     * Scope a query to only include tickets of a given estado.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $estado
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEstado($query, $estado)
    {
        if($estado) return $query->where('estado', $estado);
    }

    /**
     * Scope a query to only include tickets of a given created.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $created_ini
     * @param  mixed  $created_fin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreated($query, $created_ini, $created_fin)
    {
        if($created_ini && $created_fin) return $query->whereBetween('created_at', [$created_ini.' 00:00:00', $created_fin.' 23:59:59']);
    }
}
