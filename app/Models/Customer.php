<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'Cedula';

    protected $fillable = [
        'nombre',
        'telefono',
    ];

    /**
     * Scope a query to only include customer of a given id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeId($query, $id)
    {
        if ($id) {
            return $query->where('Cedula', $id);
        }

    }

    /**
     * Scope a query to only include customer of a given nombre.
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
}
