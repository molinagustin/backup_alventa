<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        //Encuentro el producto por medio de su id
        $product = Product::find($id);
        $images = $product->images;

        //Creamos 2 colecciones de imagenes para poder mostrarlas en 2 grupos en la vista del producto
        $imagesLeft = collect();
        $imagesRight = collect();

        //Iteramos en las imagenes colocando cada una de ellas en una coleccion distinta
        foreach ($images as $key => $image) 
        {
            if ($key % 2 == 0)
                $imagesLeft->push($image);
            else
                $imagesRight->push($image);
        }

        //Se lo devuelvo a la vista en formato json
        return view('products.show')->with(compact('product', 'imagesLeft', 'imagesRight'));
    }
}
