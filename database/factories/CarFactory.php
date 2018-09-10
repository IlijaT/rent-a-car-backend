<?php

use Faker\Generator as Faker;
use App\Model\Company;

$factory->define(App\Model\Car::class, function (Faker $faker) {
    
    return [
        'company_id' => function () {
           // return factory(App\Model\Company::class)->create()->id;
            return Company::all()->random();
        },
        'model' => $faker->word,
        'registration' =>$faker->numberBetween(1000, 9000), 
        'year' => $faker->numberBetween(1960, 2018),  
        'consuming' => $faker->numberBetween(3, 33),
        'description' => $faker->paragraph,
        'is_rented' => $faker->boolean,

    ];
});
