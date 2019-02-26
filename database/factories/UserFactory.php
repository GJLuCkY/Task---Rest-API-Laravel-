<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'status' => rand(0, 1),
    ];
});

$factory->define(App\UsersData::class, function (Faker $faker) {
    $gender = [
        'male',
        'female',
        'undefined'
    ];

    $type = rand(0, 2);
    $firstTown = App\Town::first();
    $latestTown = App\Town::latest()->first();

    $town_id = rand($firstTown->id, $latestTown->id);

    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'gender' => $gender[$type],
        'town_id' => $town_id
    ];
});

$factory->define(App\Town::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'translit_name' => $faker->city
    ];
});
