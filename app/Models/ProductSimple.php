<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSimple extends Model
{
    protected $fillable = [
        'product_id',
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
