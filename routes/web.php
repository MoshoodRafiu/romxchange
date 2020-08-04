<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

    Route::get('/market/user', 'MarketController@userMarket')->name('market.user');
    Route::get('/market/user/create', 'MarketController@create')->name('market.create');
    Route::post('/market/user/store', 'MarketController@store')->name('market.store');
    Route::get('/market/{market}/user/edit', 'MarketController@edit')->name('market.edit');
    Route::put('/market/{market}/user/update', 'MarketController@update')->name('market.update');
    Route::delete('/market/{market}/user/destroy', 'MarketController@destroy')->name('market.destroy');

    Route::get('/wallets', 'WalletController@index')->name('wallet.index');
    Route::get('/wallets/create', 'WalletController@create')->name('wallet.create');
    Route::post('/wallets/store', 'WalletController@store')->name('wallet.store');
    Route::get('/wallets/{wallet}/edit', 'WalletController@edit')->name('wallet.edit');
    Route::put('/wallets/{wallet}/update', 'WalletController@update')->name('wallet.update');
    Route::delete('/wallets/{wallet}/destroy', 'WalletController@destroy')->name('wallet.destroy');

    Route::get('/verification', 'VerificationController@index')->name('verification.index');
    Route::get('/verification/phone', 'VerificationController@phone')->name('verification.phone');
    Route::get('/verification/document', 'VerificationController@document')->name('verification.document');
    Route::post('/verification/document/store', 'VerificationController@documentStore')->name('verification.document.store');

    Route::get('/trades', 'TradeController@index')->name('trade.index');
    Route::get('/trades/{trade}/accept/buy', 'TradeController@acceptBuy')->name('trade.accept.buy');
    Route::get('/trades/{trade}/accept/sell', 'TradeController@acceptSell')->name('trade.accept.sell');
    Route::get('/trades/{market}/initiate/buy', 'TradeController@initiateBuy')->name('trade.initiate.buy');
    Route::get('/trades/{market}/initiate/sell', 'TradeController@initiateSell')->name('trade.initiate.sell');

    Route::post('/trades/initiate/buy/step1', 'TradeController@initiateBuyStep1')->name('trade.initiate.buy.step1');
    Route::post('/trades/initiate/buy/step2', 'TradeController@initiateBuyStep2')->name('trade.initiate.buy.step2');
    Route::post('/trades/initiate/buy/step3', 'TradeController@initiateBuyStep3')->name('trade.initiate.buy.step3');
    Route::post('/trades/initiate/buy/step4', 'TradeController@initiateBuyStep4')->name('trade.initiate.buy.step4');

    Route::get('/trades/{trade}/accept/buy/step1', 'TradeController@acceptBuyStep1')->name('trade.accept.buy.step1');
    Route::get('/trades/{trade}/accept/buy/step2', 'TradeController@acceptBuyStep2')->name('trade.accept.buy.step2');
    Route::get('/trades/{trade}/accept/buy/step3', 'TradeController@acceptBuyStep3')->name('trade.accept.buy.step3');
    Route::get('/trades/{trade}/accept/buy/step4', 'TradeController@acceptBuyStep4')->name('trade.accept.buy.step4');

    Route::post('/trades/initiate/sell/step1', 'TradeController@initiateSellStep1')->name('trade.initiate.sell.step1');
    Route::post('/trades/initiate/sell/step2', 'TradeController@initiateSellStep2')->name('trade.initiate.sell.step2');
    Route::post('/trades/initiate/sell/step3', 'TradeController@initiateSellStep3')->name('trade.initiate.sell.step3');
    Route::post('/trades/initiate/sell/step4', 'TradeController@initiateSellStep4')->name('trade.initiate.sell.step4');

    Route::post('/trades/accept/sell/step1', 'TradeController@acceptSellStep1')->name('trade.accept.sell.step1');
    Route::get('/trades/{trade}/accept/sell/step2', 'TradeController@acceptSellStep2')->name('trade.accept.sell.step2');
    Route::get('/trades/{trade}/accept/sell/step3', 'TradeController@acceptSellStep3')->name('trade.accept.sell.step3');
    Route::get('/trades/{trade}/accept/sell/step4', 'TradeController@acceptSellStep4')->name('trade.accept.sell.step4');

    Route::post('/trades/initiate/buy/nav/step1', 'TradeController@initiateBuyNavStep1')->name('trade.initiate.buy.nav.step1');
    Route::post('/trades/initiate/buy/nav/step2', 'TradeController@initiateBuyNavStep2')->name('trade.initiate.buy.nav.step2');
    Route::post('/trades/initiate/buy/nav/step3', 'TradeController@initiateBuyNavStep3')->name('trade.initiate.buy.nav.step3');
    Route::post('/trades/initiate/buy/nav/step4', 'TradeController@initiateBuyNavStep4')->name('trade.initiate.buy.nav.step4');
    Route::post('/trades/initiate/buy/nav/step5', 'TradeController@initiateBuyNavStep5')->name('trade.initiate.buy.nav.step5');

    Route::post('/trades/initiate/sell/nav/step1', 'TradeController@initiateSellNavStep1')->name('trade.initiate.sell.nav.step1');
    Route::post('/trades/initiate/sell/nav/step2', 'TradeController@initiateSellNavStep2')->name('trade.initiate.sell.nav.step2');
    Route::post('/trades/initiate/sell/nav/step3', 'TradeController@initiateSellNavStep3')->name('trade.initiate.sell.nav.step3');
    Route::post('/trades/initiate/sell/nav/step4', 'TradeController@initiateSellNavStep4')->name('trade.initiate.sell.nav.step4');
    Route::post('/trades/initiate/sell/nav/step5', 'TradeController@initiateSellNavStep5')->name('trade.initiate.sell.nav.step5');

    Route::get('/trades/{trade}/accept/buy/nav/step1', 'TradeController@acceptBuyNavStep1')->name('trade.accept.buy.nav.step1');
    Route::get('/trades/{trade}/accept/buy/nav/step2', 'TradeController@acceptBuyNavStep2')->name('trade.accept.buy.nav.step2');
    Route::get('/trades/{trade}/accept/buy/nav/step3', 'TradeController@acceptBuyNavStep3')->name('trade.accept.buy.nav.step3');
    Route::get('/trades/{trade}/accept/buy/nav/step4', 'TradeController@acceptBuyNavStep4')->name('trade.accept.buy.nav.step4');
    Route::get('/trades/{trade}/accept/buy/nav/step5', 'TradeController@acceptBuyNavStep5')->name('trade.accept.buy.nav.step5');

    Route::get('/trades/{trade}/accept/sell/nav/step1', 'TradeController@acceptSellNavStep1')->name('trade.accept.sell.nav.step1');
    Route::get('/trades/{trade}/accept/sell/nav/step2', 'TradeController@acceptSellNavStep2')->name('trade.accept.sell.nav.step2');
    Route::get('/trades/{trade}/accept/sell/nav/step3', 'TradeController@acceptSellNavStep3')->name('trade.accept.sell.nav.step3');
    Route::get('/trades/{trade}/accept/sell/nav/step4', 'TradeController@acceptSellNavStep4')->name('trade.accept.sell.nav.step4');
    Route::get('/trades/{trade}/accept/sell/nav/step5', 'TradeController@acceptSellNavStep5')->name('trade.accept.sell.nav.step5');


});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/market', 'MarketController@index')->name('market.index');
Route::get('/market/buy', 'MarketController@buy')->name('market.buy');
Route::get('/market/sell', 'MarketController@sell')->name('market.sell');
Route::get('/market/filter', 'MarketController@filterMarket')->name('market.filter');

