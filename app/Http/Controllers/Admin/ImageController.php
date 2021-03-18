<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use File;
use Image;

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
        //Hago comprobaciones para asegurarme que se trata de una imagen en el metodo VALID creado en este mismo controlador
        $this->valid($request);

        //Guardar la imagen en la carpeta de nuestro proyecto
        $file = $request->file('photo');
        $path = public_path() . '/images/products/'; // El public_path es la ruta absoluta hacia la carpeta PUBLIC dentro de nuestro proyecto
        
        $fileName = uniqid() . $file->getClientOriginalName(); //Se guarda un nombre en el cual se genera un ID unico y se concatena con el nombre del archivo
        //dd(storage_path() . '/images/products' . $fileName);
        //dd($path . $fileName);
        //Redimensiono la imagen
        $moved = Image::make($file)
            ->resize(500, 400)//El primer parametro es WIDTH y el segundo HEIGHT
            ->save($path . $fileName);

        //Se usa una variable intermedia porque en servidores como Linux, si no se cuenta con permisos apropiados a veces no crea la carpeta y si no lo verificamos antes de guardar la imagen en la BD, de igual forma se guardara a pesar de no tener carpeta
        //Esta forma es sin usar el Intervention Image para redimensionar la imagen, simplemente se guarda como viene
        //$moved = $file->move($path, $fileName); //Finalmente al archivo se lo guarda en la ruta con el nombre indicado

        //Guardar el registro en la base de datos
        if ($moved) {
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            //$productImage -> featured = ''; Las imagenes no seran destacadas por defecto
            $productImage->product_id = $id;
            $productImage->save(); //Realiza un INSERT
        }

        return back()->with('notification', 'Imagen subida correctamente.'); //Lo devuelve a la pagina de imagenes
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
        if ($deleted == true) {
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
        $productImage->featured = true;
        $productImage->save();

        return back();
    }

    public function valid(Request $request)
    {
        //Realizo la validacion de los campos antes de proceder a guardar el producto
        $messages = [
            'photo.file' => 'El archivo no fue subido correctamente y no pudo guardarse.',
            'photo.mimes' => 'Las extensiones validas para la imagen son JPEG, PNG, JPG, GIF y SVG.',
            'photo.max' => 'El archivo a cargar no puede superar los 5Mb.',
            'photo.dimensions' => 'La imagen debe contener dimensiones mayores a 100px y menores a 5120px.',
        ];

        //Creo el array de las reglas de validacion que se corresponden al nombre de los campos a tratar
        $rules = [
            'photo' => 'file|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:min_width=100,min_height=100,max_width=5120,max_height=5120',
        ];
        $this->validate($request, $rules, $messages);
    }
}
