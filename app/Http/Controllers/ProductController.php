<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products')); //Devuelve listado de productos
    }

    public function create()
    {
        return view('admin.products.create'); //Muestra formulario
    }

    public function store(Request $request)
    {
        //Registra el producto. Por medio del metodo DD nos permite imprimir el contenido que llega a $request, poder mostrarlo en la pagina a efectos practicos 
        //y luego finaliza la respuesta del servidor.
        //dd($request->all());

        //Para guardar el producto, creamos un objeto nuevo del tipo producto
        $product = new Product();

        //Se asignan los valores al objeto
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');

        //Se usa SAVE para realizar un INSERT en la tabla del producto
        $product -> save();

        //Luego redirigimos al usuario al listado de productos
        return redirect('/admin/products');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        //A pesar de ser el mismo metodo, internamente entiende que se trata de un UPDATE y no crea un nuevo registro
        $product -> save();

        return redirect('/admin/products');
    }

    public function destroy($id)
    {   //Eliminar ProductImage por que estaba relacionada
        ProductImage::where('product_id', $id)->delete();

        //Encuentra el producto por el id
        $product = Product::find($id);

        //Por medio del metodo DELETE lo elimino
        $product -> delete();

        //Con return BACK, nos redirige directamente a la pagina donde estabamos al momento de realizar la accion, en este caso el listado de productos
        return back();
    }

}
