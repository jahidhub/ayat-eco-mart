<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [

      'name',
      'slug',
      'feature_image',
      'product_type',
      'category_id',
      'brand_id',
      'status',
      'short_description',
      'description',
      'meta_title',
      'meta_description',
      'keywords',


   ];
}
