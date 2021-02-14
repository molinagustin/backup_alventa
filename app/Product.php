<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Para enlazar con categorias y obtener la categoria de un producto que va a ser 1 sola
    Public function category(){
        return $this->belongsTo(Category::class);
    }

    //Para obtener todos los productos a partir de una imagen del mismo
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
