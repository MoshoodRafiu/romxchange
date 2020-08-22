<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Trade;
use Faker\Generator as Faker;

$factory->define(Trade::class, function (Faker $faker) {
    return [
        "transaction_id" => "AC14324635713".$faker->randomNumber(4),
        "coin_id" => function(){
            return \App\Coin::all()->random();
        },
        "market_id" => function(){
            return \App\Market::all()->random();
        },
        "buyer_id" => function(){
            return \App\User::all()->random();
        },
        "seller_id" => function(){
            return \App\User::all()->random();
        },
        "coin_amount" => $faker->numberBetween(10, 100),
        "coin_amount_usd" => "108",
        "coin_amount_ngn" => "56000",
        "transaction_charge_ngn" => $faker->numberBetween(1000, 100000),
        "transaction_status" => $faker->randomElement(["success", "cancelled", "pending"]),
    ];
});
