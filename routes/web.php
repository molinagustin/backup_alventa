<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//SOLO USAR METODO GET SI NECESITO OBTENER DATOS, PARA CUALQUIER OTRA OPERACION USO METODO POST COMO REGISTRAR, ACTUALIZAR O ELIMINAR ELEMENTOS
Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/{id}', 'ProductController@show'); // Mostrar datos de un producto a un usuario general

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

//Utilizamos un middleware para asociarlo a un grupo de rutas, de esta forma se aplicara a cualquier ruta dentro del grupo elegido
//Para usar el prefijo 'admin' se le aplico un alias al AdminMiddleware.php en el archivo Kernel.php dentro de App\Http
/*Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/products', 'ProductController@index'); // Listar productos y acceder a modificar o eliminar
    Route::get('/admin/products/create', 'ProductController@create'); // Crear producto
    Route::post('/admin/products', 'ProductController@store'); // Guardar el registro del producto
    Route::get('/admin/products/{id}/edit', 'ProductController@edit'); // Mostrar datos de un producto
    Route::post('/admin/products/{id}/edit', 'ProductController@update'); // Guardar los cambios del producto
    //Al usar el metodo DELETE, explicitamente estamos indicando que queremos borrar algo, por eso no lleva la palabar DELETE en la URL
    //Route::delete('/admin/products/{id}/delete', 'ProductController@destroy'); // Eliminar el registro de un producto
    Route::delete('/admin/products/{id}', 'ProductController@destroy');
    //Otros metodos que podemos usar son PUT, PATCH y DELETE los cuales son variaciones del tipo POST
});*/

//Gracias al prefijo admin (en minuscula) ya no sera necesario incluirlo en las rutas
//Al crear una carpeta ADMIN dentro de CONTROLLERS, se tuvo que actualizar el namespace dentro de cada controlador y la directiva USE para indicarle que el archivo Controller se encuentra en la ruta apropiada y no dentro de la carpeta ADMIN
/*Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/products', 'Admin\ProductController@index'); // Listar productos y acceder a modificar o eliminar
    Route::get('/products/create', 'Admin\ProductController@create'); // Crear producto
    Route::post('/products', 'Admin\ProductController@store'); // Guardar el registro del producto
    Route::get('/products/{id}/edit', 'Admin\ProductController@edit'); // Mostrar datos de un producto
    Route::post('/products/{id}/edit', 'Admin\ProductController@update'); // Guardar los cambios del producto
    //Al usar el metodo DELETE, explicitamente estamos indicando que queremos borrar algo, por eso no lleva la palabar DELETE en la URL
    //Route::delete('/admin/products/{id}/delete', 'Admin\ProductController@destroy'); // Eliminar el registro de un producto
    Route::delete('/products/{id}', 'Admin\ProductController@destroy');
    //Otros metodos que podemos usar son PUT, PATCH y DELETE los cuales son variaciones del tipo POST

    //Listado de Imagenes y subir nuevas
    Route::get('/products/{id}/images', 'Admin\ImageController@index'); //Para mostrar imagenes
    Route::post('/products/{id}/images', 'Admin\ImageController@store'); //Para guardar las imagenes
    Route::delete('/products/{id}/images', 'Admin\ImageController@destroy'); //Para eliminar imagenes
    Route::get('/products/{id}/images/select/{image}', 'Admin\ImageController@select'); //Para destacar imagenes
});*/

//Se le agrega un Namespace de Admin para la ruta de los controladores
Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/products', 'ProductController@index'); // Listar productos y acceder a modificar o eliminar
    Route::get('/products/create', 'ProductController@create'); // Crear producto
    Route::post('/products', 'ProductController@store'); // Guardar el registro del producto
    Route::get('/products/{id}/edit', 'ProductController@edit'); // Mostrar datos de un producto
    Route::post('/products/{id}/edit', 'ProductController@update'); // Guardar los cambios del producto
    //Al usar el metodo DELETE, explicitamente estamos indicando que queremos borrar algo, por eso no lleva la palabar DELETE en la URL
    //Route::delete('/admin/products/{id}/delete', 'Admin\ProductController@destroy'); // Eliminar el registro de un producto
    Route::delete('/products/{id}', 'ProductController@destroy');
    //Otros metodos que podemos usar son PUT, PATCH y DELETE los cuales son variaciones del tipo POST

    //Listado de Imagenes y subir nuevas
    Route::get('/products/{id}/images', 'ImageController@index'); //Para mostrar imagenes
    Route::post('/products/{id}/images', 'ImageController@store'); //Para guardar las imagenes
    Route::delete('/products/{id}/images', 'ImageController@destroy'); //Para eliminar imagenes
    Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //Para destacar imagenes
});