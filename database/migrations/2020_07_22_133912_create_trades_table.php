<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->integer('coin_id');
            $table->integer('market_id');
            $table->integer('buyer_id');
            $table->integer('seller_id');
            $table->integer('agent_id')->nullable();
            $table->boolean('is_special')->default(0);
            $table->string('buyer_transaction_stage')->nullable();
            $table->string('seller_transaction_stage')->nullable();
            $table->string('ace_transaction_stage')->nullable();
            $table->string('coin_amount');
            $table->string('coin_amount_usd');
            $table->string('coin_amount_ngn');
            $table->boolean('buyer_has_summoned')->default(0);
            $table->boolean('seller_has_summoned')->default(0);
            $table->string('transaction_charge_coin')->nullable();
            $table->string('transaction_charge_usd')->nullable();
            $table->string('transaction_charge_ngn')->nullable();
            $table->string('seller_wallet_company')->nullable();
            $table->timestamp('trade_window_expiry');
            $table->string('transaction_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
