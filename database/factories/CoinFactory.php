<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coin;
use Faker\Generator as Faker;

$factory->define(Coin::class, function (Faker $faker) {
    return [
        "name" => $faker->randomElement(['bitcoin', 'ethereum']),
        "abbr" => $faker->randomElement(['BTC', 'ETH']),
        "logo" => $faker->imageUrl(640, 640),
    ];
});
