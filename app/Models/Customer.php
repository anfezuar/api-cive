<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'telefono'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
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
        if($id) return $query->where('id', $id);
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
        if($nombre) return $query->where('nombre', 'like', '%'.$nombre.'%');
    }
}
