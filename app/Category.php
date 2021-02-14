<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Para obtener los productos de una categoria
    Public function products(){
        return $this->hasMany(Product::class);
    }
}
