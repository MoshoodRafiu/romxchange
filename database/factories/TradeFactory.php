<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Trade;
use Faker\Generator as Faker;

$factory->define(Trade::class, function (Faker $faker) {
    return [
        "transaction_id" => "AC14324635713".$faker->randomNumber(4),
        "market_id" => function(){
            return \App\Market::all()->random();
        },
        "buyer_id" => function(){
            return \App\User::all()->random();
        },
        "seller_id" => function(){
            return \App\User::all()->random();
        },
        "coin_amount" => "0.0009977",
        "coin_amount_usd" => "108",
        "coin_amount_ngn" => "56000",
        "transaction_status" => $faker->randomElement(["success", "cancelled", "pending"]),
    ];
});
