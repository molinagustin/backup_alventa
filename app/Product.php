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

    //Campo calculado, se accede en WELCOME.BLADE.PHP a traves de features_image_url
    public function getFeaturedImageUrlAttribute()
    {
        //Primero obtengo la primer imagen que tenga como condicion FEATURED o DESTACADA
        $featuredImage = $this->images()->where('featured', true)->first();
        //Si no hay una, busco la primera que encuentro
        if (!$featuredImage)        
            $featuredImage = $this->images()->first();        

        //Si hay al menos una imagen, le devuelvo la URL a traves del campo calculado en ProductImage
        if ($featuredImage)        
            return $featuredImage->url;  
                
        //Si no hay una imagen, devuelve la url de la imagen por defecto
        return '/images/products/default.png';

    }

    //Relacion hacia el detalle del carro de compras
    public function as()
    {

    }
}
