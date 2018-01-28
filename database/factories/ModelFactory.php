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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'numero' => $faker->randomDigit,
    ];
});

$factory->define(App\Models\Restaurant::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstNameMale,
        'cnpj' => $faker->ean13,
        'telefone' => $faker->phoneNumber,
        'cep' => $faker->postcode,
        'cidade' => $faker->city,
        'uf' => $faker->stateAbbr,
        'dono' => $faker->randomDigit
    ];
});

$factory->define(App\Models\Dish::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(200),
        'value' => $faker->randomFloat(2, 1, 100),
        'restaurant_id' => $faker->randomDigit
    ];
});
