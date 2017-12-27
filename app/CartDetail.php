<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    //CartDetail n <---> 1 producto
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
