<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=>$faker->randomElement(array('Shirt','Jeans','Shoes','Hats','Wallet')),
        'brand_id'=>factory(Brand::class),
        'cat_id'=>factory(Category::class),
        'quantity'=>$faker->numberBetween($min = 100, $max = 200),
        'vat'=>$faker->numberBetween($min = 1, $max = 50),
        'price'=>$faker->numberBetween($min = 1, $max = 1000),
        'product_code'=>$faker->isbn10
    ];
});
