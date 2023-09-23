<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'menu',
        'permission'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function menuData()
    {
        return $this->belongsTo(Menu::class, 'menu');
    }
}
