<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Cart;

class CartStatus extends Model
{
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
