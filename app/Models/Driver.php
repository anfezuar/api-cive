<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'licencia',
        'estado',
        'razon_estado',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Scope a query to only include driver of a given id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeId($query, $id)
    {
        if ($id) {
            return $query->where('id', $id);
        }

    }

    /**
     * Scope a query to only include driver of a given nombre.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $nombre
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNombre($query, $nombre)
    {
        if ($nombre) {
            return $query->where('nombre', 'like', '%' . $nombre . '%');
        }

    }

    /**
     * Scope a query to only include driver of a given apellido.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $apellido
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApellido($query, $apellido)
    {
        if ($apellido) {
            return $query->where('apellido', 'like', '%' . $apellido . '%');
        }

    }
}
