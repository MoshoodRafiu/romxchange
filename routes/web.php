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

Route::group(['middleware' => ['auth', 'email_verified', 'active']], function () {

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
    Route::put('/profile/password/update', 'ProfileController@updatePassword')->name('profile.password.update');

    Route::get('/market/user', 'MarketController@userMarket')->name('market.user');
    Route::get('/market/user/create', 'MarketController@create')->name('market.create');
    Route::post('/market/user/store', 'MarketController@store')->name('market.store');
    Route::get('/market/{market}/user/edit', 'MarketController@edit')->name('market.edit');
    Route::put('/market/{market}/user/update', 'MarketController@update')->name('market.update');
    Route::delete('/market/{market}/user/destroy', 'MarketController@destroy')->name('market.destroy');

    Route::post('/chat/message/send', 'MessageController@sendRegular')->name('message.send');
    Route::post('/chat/message/file/send', 'MessageController@sendRegularFile')->name('message.file.send');

    Route::post('/trades/reviews/store', 'ReviewController@store')->name('review.store');
    Route::get('/trades/{trade}/dispute', 'TradeController@dispute')->name('trade.dispute');
    Route::get('/trades/{trade}/switch', 'TradeController@switch')->name('trade.switch');
    Route::get('/trades/{trade}/cancel', 'TradeController@cancel')->name('trade.cancel');

    Route::get('/wallets', 'WalletController@index')->name('wallet.index');
    Route::get('/wallets/create', 'WalletController@create')->name('wallet.create');
    Route::post('/wallets/store', 'WalletController@store')->name('wallet.store');
    Route::get('/wallets/{wallet}/edit', 'WalletController@edit')->name('wallet.edit');
    Route::put('/wallets/{wallet}/update', 'WalletController@update')->name('wallet.update');
    Route::delete('/wallets/{wallet}/destroy', 'WalletController@destroy')->name('wallet.destroy');

    Route::get('/verification', 'VerificationController@index')->name('verification.index');
    Route::get('/verification/phone', 'VerificationController@phone')->name('verification.phone');
    Route::post('/verification/phone/code/request', 'VerificationController@requestCode')->name('verification.phone.code.request');
    Route::post('/verification/phone/code/verify', 'VerificationController@verifyCode')->name('verification.phone.code.verify');
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
Route::get('/email/verify', 'HomeController@verifyEmail')->name('email.verify')->middleware('auth');
Route::post('/email/verify/resend', 'HomeController@resendEmail')->name('verify.resend')->middleware('auth');
Route::get('/verify', 'HomeController@verifyUser')->name('verify.user');
Route::get('/market', 'MarketController@index')->name('market.index');
Route::get('/market/buy', 'MarketController@buy')->name('market.buy');
Route::get('/market/sell', 'MarketController@sell')->name('market.sell');
Route::get('/market/filter', 'MarketController@filterMarket')->name('market.filter');


Route::group(['middleware' => ['auth', 'admin']] , function () {
    Route::get('/admin/dashboard', 'HomeController@adminDashboard')->name('admin.dashboard');
    Route::get('/admin/transactions', 'TradeController@allTransactions')->name('admin.transactions');
    Route::get('/admin/transactions/filter', 'TradeController@allTransactionsFilter')->name('admin.transactions.filter');
    Route::get('/admin/transactions/enscrow', 'TradeController@enscrow')->name('admin.transactions.enscrow');
    Route::get('/admin/trades', 'TradeController@adminTrades')->name('admin.trades');
    Route::get('/admin/trades/disputes', 'TradeController@tradeDispute')->name('admin.trades.disputes');
    Route::get('/admin/trades/{trade}/disputes/chat', 'TradeController@tradeDisputeJoin')->name('admin.trades.dispute.join');
    Route::get('/admin/trades/{trade}/accept', 'TradeController@aceAccept')->name('admin.transactions.accept');
    Route::get('/admin/trades/{trade}/proceed', 'TradeController@aceProceed')->name('admin.transactions.proceed');
    Route::get('/admin/trades/{trade}/step2', 'TradeController@aceStep2')->name('admin.enscrow.step2');
    Route::get('/admin/trades/{trade}/step3', 'TradeController@aceStep3')->name('admin.enscrow.step3');

    Route::post('/admin/chat/message/send', 'MessageController@sendAdmin')->name('admin.message.send');

    Route::get('/admin/trades/{trade}/nav/step1', 'TradeController@aceNavStep1')->name('admin.enscrow.nav.step1');
    Route::get('/admin/trades/{trade}/nav/step2', 'TradeController@aceNavStep2')->name('admin.enscrow.nav.step2');
    Route::get('/admin/trades/{trade}/nav/step3', 'TradeController@aceNavStep3')->name('admin.enscrow.nav.step3');

    Route::get('/admin/trades/{trade}/accept/buy', 'TradeController@adminAcceptBuy')->name('admin.trade.accept.buy');
    Route::get('/admin/trades/{trade}/accept/sell', 'TradeController@adminAcceptSell')->name('admin.trade.accept.sell');

    Route::get('/admin/trades/{trade}/accept/buy/step1', 'TradeController@adminAcceptBuyStep1')->name('admin.trade.accept.buy.step1');
    Route::get('/admin/trades/{trade}/accept/buy/step2', 'TradeController@adminAcceptBuyStep2')->name('admin.trade.accept.buy.step2');
    Route::get('/admin/trades/{trade}/accept/buy/step3', 'TradeController@adminAcceptBuyStep3')->name('admin.trade.accept.buy.step3');
    Route::get('/admin/trades/{trade}/accept/buy/step4', 'TradeController@adminAcceptBuyStep4')->name('admin.trade.accept.buy.step4');

    Route::get('/admin/trades/{trade}/accept/buy/nav/step1', 'TradeController@adminAcceptBuyNavStep1')->name('admin.trade.accept.buy.nav.step1');
    Route::get('/admin/trades/{trade}/accept/buy/nav/step2', 'TradeController@adminAcceptBuyNavStep2')->name('admin.trade.accept.buy.nav.step2');
    Route::get('/admin/trades/{trade}/accept/buy/nav/step3', 'TradeController@adminAcceptBuyNavStep3')->name('admin.trade.accept.buy.nav.step3');
    Route::get('/admin/trades/{trade}/accept/buy/nav/step4', 'TradeController@adminAcceptBuyNavStep4')->name('admin.trade.accept.buy.nav.step4');
    Route::get('/admin/trades/{trade}/accept/buy/nav/step5', 'TradeController@adminAcceptBuyNavStep5')->name('admin.trade.accept.buy.nav.step5');

    Route::post('/admin/trades/accept/sell/step1', 'TradeController@adminAcceptSellStep1')->name('admin.trade.accept.sell.step1');
    Route::get('/admin/trades/{trade}/accept/sell/step2', 'TradeController@adminAcceptSellStep2')->name('admin.trade.accept.sell.step2');
    Route::get('/admin/trades/{trade}/accept/sell/step3', 'TradeController@adminAcceptSellStep3')->name('admin.trade.accept.sell.step3');
    Route::get('/admin/trades/{trade}/accept/sell/step4', 'TradeController@adminAcceptSellStep4')->name('admin.trade.accept.sell.step4');

    Route::get('/admin/trades/{trade}/accept/sell/nav/step1', 'TradeController@adminAcceptSellNavStep1')->name('admin.trade.accept.sell.nav.step1');
    Route::get('/admin/trades/{trade}/accept/sell/nav/step2', 'TradeController@adminAcceptSellNavStep2')->name('admin.trade.accept.sell.nav.step2');
    Route::get('/admin/trades/{trade}/accept/sell/nav/step3', 'TradeController@adminAcceptSellNavStep3')->name('admin.trade.accept.sell.nav.step3');
    Route::get('/admin/trades/{trade}/accept/sell/nav/step4', 'TradeController@adminAcceptSellNavStep4')->name('admin.trade.accept.sell.nav.step4');
    Route::get('/admin/trades/{trade}/accept/sell/nav/step5', 'TradeController@adminAcceptSellNavStep5')->name('admin.trade.accept.sell.nav.step5');

    Route::get('/admin/verifications', 'VerificationController@allVerifications')->name('admin.verifications');
    Route::get('/admin/verifications/{verification}', 'VerificationController@showVerification')->name('admin.verifications.show');
    Route::get('/admin/verifications/{verification}/approve', 'VerificationController@approveVerification')->name('admin.verifications.approve');
    Route::get('/admin/verifications/{verification}/decline', 'VerificationController@declineVerification')->name('admin.verifications.decline');

    Route::get('/admin/agents', 'AgentController@index')->name('admin.agents');
    Route::get('/admin/agents/create', 'AgentController@create')->name('admin.agents.create');
    Route::post('/admin/agents/store', 'AgentController@store')->name('admin.agents.store');

    Route::get('/admin/markets', 'MarketController@adminMarket')->name('admin.markets');
    Route::get('/admin/markets/filter', 'MarketController@adminMarketFilter')->name('admin.markets.filter');
    Route::delete('/admin/markets/{market}', 'MarketController@adminMarketDelete')->name('admin.markets.destroy');
    Route::get('/admin/markets/create', 'MarketController@adminMarketCreate')->name('admin.markets.create');
    Route::post('/admin/markets/store', 'MarketController@adminMarketStore')->name('admin.markets.store');
    Route::get('/admin/markets/{market}', 'MarketController@adminMarketEdit')->name('admin.markets.edit');
    Route::put('/admin/markets/{market}', 'MarketController@adminMarketUpdate')->name('admin.markets.update');

    Route::get('/admin/customers', 'CustomerController@index')->name('admin.customers');
    Route::get('/admin/customers/filter', 'CustomerController@filter')->name('admin.customers.filter');
    Route::get('/admin/customers/{customer}/restrict', 'CustomerController@restrict')->name('admin.customers.restrict');
    Route::get('/admin/customers/{customer}/approve', 'CustomerController@approve')->name('admin.customers.approve');
    Route::get('/admin/customers/{customer}', 'CustomerController@show')->name('admin.customers.show');

    Route::post('/admin/coins/store', 'CoinController@store')->name('admin.coins.store');
    Route::delete('/admin/coins/{coin}', 'CoinController@destroy')->name('admin.coins.destroy');

    Route::get('/admin/settings', 'SettingController@index')->name('admin.settings');
    Route::put('/admin/settings/update', 'SettingController@update')->name('admin.settings.update');
    Route::put('/admin/settings/bank-details/update', 'SettingController@updateBank')->name('admin.settings.bank.update');

    Route::get('/admin/wallets', 'WalletController@adminIndex')->name('admin.wallets.all');
    Route::get('/admin/wallets/{coin}/create', 'WalletController@adminCreate')->name('admin.wallets.create');
    Route::post('/admin/wallets/store', 'WalletController@adminStore')->name('admin.wallets.store');
    Route::get('/admin/wallets/{wallet}/edit', 'WalletController@adminEdit')->name('admin.wallets.edit');
    Route::put('/admin/wallets/{wallet}', 'WalletController@adminUpdate')->name('admin.wallets.update');
    Route::delete('/admin/wallets/{wallet}', 'WalletController@adminDestroy')->name('admin.wallets.destroy');
    Route::get('/admin/wallets/filter', 'WalletController@adminFilter')->name('admin.wallets.filter');
    Route::get('/admin/wallets/{coin}', 'WalletController@adminIndexWithCoin')->name('admin.wallets.single');
});
