<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'title'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
