<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'employee_id'=>factory(Employee::class),
        'product_id'=>factory(Product::class),
        'discount'=>null,
        'quantity'=>null,
        'payment_method'=>$faker->randomElement(array('Cash','Credit Card','Bkash')),
        'total_amount'=>null,
    ];
});
