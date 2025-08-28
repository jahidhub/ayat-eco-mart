<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [

        'product_id',
        'size_id',
        'color',
        'regular_price',
        'sale_price',
        'sku',
        'quantity',
        'stock_status',
        'weight',
        'length',
        'width',
        'height'
    ];
}
