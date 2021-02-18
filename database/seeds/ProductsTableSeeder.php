<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Product;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usar Model Factories para crear y guardar registros en la base de datos
        /* Este enfoque sirve si no es necesario que los registros creados esten distribuidos de una forma mas uniforme entre categorias, productos e imagenes
        factory(Category::class, 5) -> create();
        factory(Product::class, 100) -> create();
        factory(ProductImage::class, 200) -> create();
        */

        //Si queres que cada categoria tenga cierta cantidad de productos y que cada producto tenga cierta cantidad de imagenes utilizamos otro enfoque
        //Con CREATE se guardan en la base de datos. Con MAKE solo se guardan en memoria
        //Creo y guardo las categorias
        $categories = factory(Category::class, 4) -> create();
        //Realizo un loop en todas las categorias, utilizando cada una de ellas
        $categories -> each(function ($category){
            //Primero creo la cantidad de productos que asigno a cada categoria
            $products = factory(Product::class, 5) -> make();
            //Llamo a la funcion de productos desde la categoria y salvo la cantidad de productos creados anteriormente en dicha categoria
            $category->products()->saveMany($products);

            //Realizo el mismo procedimiento con los productos creados y las imagenes
            $products -> each(  function ($product){
                $images = factory(ProductImage::class, 3) -> make();
                $product->images()->saveMany($images);
            });          
        });
    }
}
