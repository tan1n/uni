<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'employee_id'=>factory(App\Employee::class),
        'payment_method'=>'Cash',
        'discount'=>0,
        'total_amount'=>null
    ];
});
