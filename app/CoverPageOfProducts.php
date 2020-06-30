<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverPageOfProducts extends Model
{
    protected $fillable = [
        'product_id','image_id'
    ];
    
}
