<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{

    protected $fillable = [
        'content',
        'link',
        'image',
    ];
}
