<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;

class Remittance extends Model
{
    use HasFactory;

    protected $fillable = [
        'origen',
        'destino',
        'valor',
        'cedula_destinatario',
        'direccion_destinatario',
        'cedula_remitente',
        'direccion_remitente',
        'contenido',
        'usuario',
        'puerta',
        'created_at',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function customerDestinatario()
    {
        return $this->belongsTo(Customer::class, 'cedula_destinatario');
    }

    public function customerRemitente()
    {
        return $this->belongsTo(Customer::class, 'cedula_remitente');
    }

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
     * Scope a query to only include tickets of a given cliente.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $cliente
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDestinatario($query, $cliente)
    {
        if($cliente) return $query->where('cedula_destinatario', $cliente);
    }

    /**
     * Scope a query to only include tickets of a given cliente.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $cliente
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRemitente($query, $cliente)
    {
        if($cliente) return $query->where('cedula_remitente', $cliente);
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
