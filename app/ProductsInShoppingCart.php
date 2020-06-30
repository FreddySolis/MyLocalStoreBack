<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsInShoppingCart extends Model
{
    protected $fillable = [
        'user_id','sc_id','quantity','subtotal'
    ];
}
