<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //Para obtener la imagen de un producto
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //Definimos un ACCESOR para las imagenes que las busque ya sean si comienzan con HTTP, HTTPS o la ruta local
    public function getUrlAttribute()
    {   //Se comprueba si la cadena comienza con HTTP, y si es asi, devuelve la ruta completa de la imagen
        if (substr($this->image, 0, 4) === 'http')
        {
            return $this->image;
        }
        //Sino devuelve la ruta local concatenada con el nombre de la imagen
        return '/images/products/'.$this->image;

    }
}
