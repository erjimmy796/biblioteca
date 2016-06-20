<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\models\booksModel::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->name,
        'author'    => $faker->firstName,
        'reference' => $faker->swiftBicNumber,
        'year'      => $faker->year,
        'price'     => $faker->randomNumber(5),
        'inventory' => $faker->randomNumber(2)
    ];
});