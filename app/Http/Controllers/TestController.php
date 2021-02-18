<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        //En una variable, llamo al metodo de Eloquent ALL para traer todos los productos
       //$products = Product::all();

       //Para paginar los productos
       $products = Product::paginate(9);

       //Cuando devuelve la vista, le agrega los productos. Con "compact" se envia todo el arreglo directamente sin tener que crearlo manualmente
       return view('welcome')-> with(compact('products')); 
    }    
}
