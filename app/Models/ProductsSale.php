<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsSale extends Model
{

    use HasFactory;
    protected $table = 'venta_producto';
    protected $primaryKey = 'id_venpro';
    protected $fillable = [
        'num_venta',
        'id_producto',
        'cant_venta',
        'descuento',
        'vlr_venta',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_producto');
    }
}
