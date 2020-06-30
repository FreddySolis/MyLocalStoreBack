<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','price','discount','final_price','stock','description','size','category_id','slug'
    ];
    
    //
}
