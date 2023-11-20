<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'referencia';
    protected $fillable = [
        'referencia',
        'descripcion',
        'tipo',
    ];

    protected $hidden = [
        'fecha_update',
    ];

    public function scopeReferencia($query, $referencia)
    {
        if ($referencia) {
            return $query->where('referencia', $referencia);
        }

    }

    public function scopeNombre($query, $nombre)
    {
        if ($nombre) {
            return $query->where('descripcion', 'like', '%' . $nombre . '%');
        }

    }

    public function scopeTipo($query, $tipo)
    {
        if ($tipo) {
            return $query->where('tipo', $tipo);
        }

    }
}
