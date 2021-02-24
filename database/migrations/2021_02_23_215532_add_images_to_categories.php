<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //ESTA MIGRACION NO SE UTILIZA PORQUE YA HAY UN CAMPO DE IMAGEN PARA LAS CATEGORIAS. LA DEJO PARA VER COMO EJEMPLO COMO SE AGREGAN COLUMNAS
        //Esta migracion lo que hace es añadir a la TABLE Categories una nueva columna IMAGE para las imagenes de las categorias (Por eso no se usa el metodo CREATE de SCHEMA)
        /*Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Este metodo sirve para el ROLLBACK si es necesario quitar la columna IMAGE agregada
        /*Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image');
        });*/
    }
}
