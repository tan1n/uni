<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'address'=>$faker->city,
        'designation'=>$faker->jobTitle,
        'nid'=>$faker->nationalIdNumber,
        'joining_date'=>$faker->dateTime(),
        'phone'=>$faker->e164PhoneNumber
    ];
});
