<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Code::class, function (Faker $faker) {
    $userId = \App\Models\User::inRandomOrder()->first()->id;
    return [
        'code_name' => $faker->name,
        // we want to have both codes: attached to users and the ones that to be attached
        'user_id' => $faker->numberBetween(1,10) > 2 ? $userId : null
    ];
});
