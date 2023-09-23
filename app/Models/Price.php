<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'origen',
        'destino',
        'precio',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
