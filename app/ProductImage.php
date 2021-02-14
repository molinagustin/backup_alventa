<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //Para obtener la imagen de un producto
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
