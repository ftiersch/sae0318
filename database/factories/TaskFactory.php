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

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'task' => $faker->sentence(3),
    ];
});

$factory->state(App\Task::class, 'done', function (Faker $faker) {
    return [
        'done_at' => now()->subMinutes(10),
    ];
});