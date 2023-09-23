<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'cliente',
        'origen',
        'destino',
        'observaciones',
        'usuario',
        'puestos',
        'precio',
        'estado',
        'created_at',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cliente');
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
     * Scope a query to only include tickets of a given fecha.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $fecha_ini
     * @param  mixed  $fecha_fin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFecha($query, $fecha_ini, $fecha_fin)
    {
        if($fecha_ini && $fecha_fin) return $query->whereBetween('fecha', [$fecha_ini, $fecha_fin]);
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
     * Scope a query to only include tickets of a given cliente.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $cliente
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCliente($query, $cliente)
    {
        if($cliente) return $query->where('cliente', $cliente);
    }

    /**
     * Scope a query to only include tickets of a given origen.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $origen
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrigen($query, $origen)
    {
        if($origen) return $query->where('origen', $origen);
    }

    /**
     * Scope a query to only include tickets of a given destino.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $destino
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDestino($query, $destino)
    {
        if($destino) return $query->where('destino', $destino);
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
