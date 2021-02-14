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

Route::get('/admin/products', 'ProductController@index'); // Listar productos y acceder a modificar o eliminar

Route::get('/admin/products/create', 'ProductController@create'); // Crear producto
Route::post('/admin/products', 'ProductController@store'); // Guardar el registro del producto

Route::get('/admin/products/{id}/edit', 'ProductController@edit'); // Mostrar datos de un producto
Route::post('/admin/products/{id}/edit', 'ProductController@update'); // Guardar los cambios del producto

//Al usar el metodo DELETE, explicitamente estamos indicando que queremos borrar algo, por eso no lleva la palabar DELETE en la URL
//Route::delete('/admin/products/{id}/delete', 'ProductController@destroy'); // Eliminar el registro de un producto
Route::delete('/admin/products/{id}', 'ProductController@destroy');

//Otros metodos que podemos usar son PUT, PATCH y DELETE los cuales son variaciones del tipo POST