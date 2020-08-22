<?php

use App\Coin;
use App\Market;
use App\Trade;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(User::class, 10)->create();
        factory(Coin::class, 5)->create();
        factory(Market::class, 100)->create();
        factory(Trade::class, 1000)->create();
    }
}
