<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'prodescuento';
    protected $primaryKey = 'referencia';
    public $timestamps = false;

    protected $fillable = [
        'referencia',
        'vlrdes',
        'vlrcondes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'referencia');
    }
}
