<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'invoice_id'=>factory(App\Invoice::class),
        'employee_id'=>factory(App\Employee::class),
        'product_id'=>factory(App\Product::class),
        'quantity'=>null,
        'total_amount'=>null,
    ];
});
