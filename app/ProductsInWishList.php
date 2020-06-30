<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsInWishList extends Model
{
    protected $fillable = [
        'user_id','wl_id'
    ];
    
}
