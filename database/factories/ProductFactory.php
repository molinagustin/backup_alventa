<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker -> words(3, true),
        'description' => $faker -> sentence(10),
        'long_description' => $faker -> text(),
        'price' => $faker -> randomFloat(4, 5, 1500),

        'category_id' => $faker -> numberBetween(1, 5)
    ];
});
