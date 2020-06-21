<?php

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'body'=> $faker->paragraph(5, true),
        'price'=> $faker->randomFloat(2, 1, 10),
        'slug'=> $faker->slug
    ];
});
