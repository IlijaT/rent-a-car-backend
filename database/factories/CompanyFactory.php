<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,  
    ];
});
