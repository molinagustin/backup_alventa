<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use File;


class ImageController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $images = $product->images()->orderBy('featured', 'desc')->get(); //Obtenemos las imagenes ordenadas de forma descendente segun el campo featured. El Get sirve para realizar la consulta
        return view('admin.products.images.index')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id) //El id hace referencia al producto
    {
        //Guardar la imagen en la carpeta de nuestro proyecto
        $file = $request->file('photo');
        $path = public_path() . '/images/products'; // El public_path es la ruta absoluta hacia la carpeta PUBLIC dentro de nuestro proyecto
        $fileName = uniqid() . $file->getClientOriginalName(); //Se guarda un nombre en el cual se genera un ID unico y se concatena con el nombre del archivo
        //Se usa una variable intermedia porque en servidores como Linux, si no se cuenta con permisos apropiados a veces no crea la carpeta y si no lo verificamos antes de guardar la imagen en la BD, de igual forma se guardara a pesar de no tener carpeta
        $moved = $file->move($path, $fileName); //Finalmente al archivo se lo guarda en la ruta con el nombre indicado

        //Guardar el registro en la base de datos
        if ($moved) {
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            //$productImage -> featured = ''; Las imagenes no seran destacadas por defecto
            $productImage->product_id = $id;
            $productImage->save(); //REaliza un INSERT
        }

        return back(); //Lo devuelve a la pagina de imagenes
    }

    public function destroy(Request $request)
    {
        //Eliminar la imagen de los archivos locales
        $productImage = ProductImage::find($request->input('image_id')); //Busco la imagen en base al id de la solicitud

        if (substr($productImage->image, 0, 4) === 'http') {
            $deleted = true;
        } else {
            $fullPath = public_path() . '/images/products/' . $productImage->image;
            echo $fullPath;
            $deleted = File::delete($fullPath);
        }

        //Eliminar la imagen de la BD si fue eliminada localmente o era una URL HTTP
        if ($deleted == true) 
        {
            $productImage->delete();
        }

        return back();
    }

    public function select($id, $image) //Recibe el $id del producto y el id de la imagen en $image
    {
        //Desmarcar las otras imagenes destacadas
        //Busca de entre todas las imagenes con el ID del producto para actualizar el campo FEATURED a falso
        ProductImage::where('product_id', $id)->update([
            'featured' => false
        ]);

        //Destacar la imagen seleccionada
        //Encuentra la imagen por el ID y le coloca el estado FEATURED
        $productImage = ProductImage::find($image);
        $productImage -> featured = true;
        $productImage -> save();

        return back();
    }
}
