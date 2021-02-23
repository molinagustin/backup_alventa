<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Dejamos definidos como estaticos los mensajes y las reglas de validacion y cuando las necesitamos las tomamos desde la clase Category
    public static $messages = [
        'name.required' => 'Es necesario un nombre para la categoría.',
        'name.min' => 'El nombre de la categoría debe ser mayor a 3 caracteres.',
        'description.max' => 'El contenido de la descripción debe ser menor a 200 caracteres.',
        'photo.file' => 'El archivo no fue subido correctamente y no pudo guardarse.',
        'photo.mimes' => 'Las extensiones validas para la imagen son JPEG, PNG, JPG, GIF y SVG.',          
        'photo.max' => 'El archivo a cargar no puede superar los 2Mb.',          
        'photo.dimensions' => 'La imagen debe contener dimensiones mayores a 100px y menores a 1024px.', 
    ];

    public static $rules = [
        'name' => 'required|min:3',
        'description' => 'max:200',
        'photo' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1024,max_height=1024',
    ];

    //Para el MASS ASIGNMENT o asignamiento masivo se declara un arreglo protegido, con los campos que SI pueden ser utilizados en el MASS ASIGNMENT
    protected $fillable = (['name', 'description', 'image']);

    //Para obtener los productos de una categoria
    Public function products(){
        return $this->hasMany(Product::class);
    }

    //Accesor para la imagen
    public function getFeaturedImageUrlAttribute()
    {
        //Obtenemos el primer producto de la lista de productos
        //$featuredProduct = $this->products()->where('category_id', $id)->first();
        $featuredProduct = $this->products()->first();        
        return $featuredProduct->featured_image_url;
    }
}
