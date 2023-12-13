<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_id',
        'discount',
        'with_discount',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $rules = [
        'product_id' => 'required',
        'discount' => 'required|numeric',
        'with_discount' => 'required|numeric',
    ];

    /**
     * Get the product associated with the discount.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
