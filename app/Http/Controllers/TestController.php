<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        //En una variable, llamo al metodo de Eloquent ALL para traer todos los productos
       //$products = Product::all();

       //El metodo HAS es un SQL JOIN en donde se establece que busque las categorias que tengan productos
       $categories = Category::has('products')->get();

       //Cuando devuelve la vista, le agrega los productos. Con "compact" se envia todo el arreglo directamente sin tener que crearlo manualmente
       return view('welcome')-> with(compact('categories')); 
    }    
}
