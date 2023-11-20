<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'venta';
    protected $primaryKey = 'num_venta';
    protected $fillable = [
        'num_venta',
        'ced_cliente',
        'vendedor',
        'total',
        'descuento',
        'fecha',
        'pago',
        'descripcion',
        'tipo',
        'estado',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ced_cliente');
    }

    public function productsSale()
    {
        return $this->hasMany(ProductsSale::class, 'num_venta');
    }

    public function scopeId($query, $id)
    {
        if ($id) {
            return $query->where('num_venta', $id);
        }
    }

    /**
     * Scope a query to only include tickets of a given cliente.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $cliente
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCliente($query, $cliente)
    {
        if ($cliente) {
            return $query->where('ced_cliente', $cliente);
        }
    }

    public function scopeFecha($query, $fechaIni, $fechaFin)
    {
        if ($fechaIni && $fechaFin) {
            return $query->whereBetween('fecha', [$fechaIni, $fechaFin]);
        }

    }

}
