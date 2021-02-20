<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Muestro el listado de categorias
    public function index(){
        //Las obtengo paginadas al listado de categorias y las devuelvo en la vista
        $categories = Category::orderBy('name')->paginate(5);
        return view('admin.categories.index')->with(compact('categories'));
    }

    public function create(){
        //Solo devuelvo la vista con el formulario de registro
        return view('admin.categories.create');
    }

    public function store(Request $request){
        //Compruebo la validacion de sus campos
        $this->valid($request);

        //Almaceno los valores de los campos enviados y guardo un registro
        /*$category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->save();*/

        //Otra forma de almacenar datos en la BD mas resumida a la anterior
        //Por medio del metodo create, podemos pasarle internamente un arreglo con los valores a crear en la nueva clase, o bien podemos definir en el modelo CATEGORY, cuales son los campos que SI van a poder utilizarse como asignacion masiva (VER EL MODELO CATEGORY)
        Category::create($request->all()); //A esto se le conoce como asignacion masiva o mass assignment

        $notification = 'La categoría fue creada exitosamente.';
        return redirect('/admin/categories')->with(compact('notification'));
    }
    //Otra forma de que cuando recibimos un parametro por la URL, lo utilicemos de forma directa es colocando el objeto de la clase indicada y el mismo realiza una busqueda y se instancia con el valor pasado por la URL. Hay que tenes en cuenta que el parametro a recibir se llame igual al que se pasa por la URL desde la RUTA
    //public function edit($id){
    public function edit(Category $category){
        //Encuentro la categoría solicitada y devuelvo un json con sus valores
        //$category = Category::find($id);
        
        //Utilizando la otra forma de recibir un parametro y ya buscar el objeto apropiado directamente devolvemos la vista con el objeto ya instanciado
        return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request, Category $category){
        //Compruebo la validacion de sus campos
        $this->valid($request);

        //Encuentro la categoria editada, le cambio los valores por lo que traiga y actualizo el registro
        /*$category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->save();*/

        //Aplicando la forma de actualizar por medio de todos los campos
        $category->update($request->all());

        $notification = 'La categoría fue editada correctamente.';
        return redirect('/admin/categories')->with(compact('notification'));
    }

    public function destroy(Category $category){
        //Encuentro la categoria y aplico el metodo delete (SE CAMBIO EL ID POR EL CASTEO DE LA CATEGORIA EN EL PARAMETRO DIRECTAMENTE)
        //$category = Category::find($id);
        $category->delete();

        //Uso una variable flash
        $notification = 'La categoría fue eliminada correctamente.';
        return back()->with(compact('notification'));
    }

    //Validaciones generales para almacenar y editar categorias
    public function valid(Request $request)
    {   //Es una forma distinta de hacer la validacion a la vista en los productos
        $this->validate($request, Category::$rules, Category::$messages);
    }
}
