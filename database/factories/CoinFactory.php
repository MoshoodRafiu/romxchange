<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coin;
use Faker\Generator as Faker;

$factory->define(Coin::class, function (Faker $faker) {
    return [
        "name" => $faker->unique()->randomElement(['bitcoin', 'ethereum']),
        "abbr" => $faker->unique()->randomElement(['BTC', 'ETH']),
    ];
});
