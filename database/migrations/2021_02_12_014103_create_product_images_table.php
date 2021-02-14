<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('image');
            //Es un campo booleano para saber si se trata de una imagen destacada, de esta forma sera la que se muestre como principal
            $table->boolean('featured')->default(false);

            /*Clave Foranea de Productos hacia Categorias  FK */
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
