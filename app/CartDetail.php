<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    //Relacion hacia el producto del detalle
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
