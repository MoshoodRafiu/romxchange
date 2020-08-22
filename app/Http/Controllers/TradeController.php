<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Market;
use App\Setting;
use App\Trade;
use App\Wallet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $trades = Trade::where('seller_id', Auth::user()->id)->orwhere('buyer_id', Auth::user()->id)->paginate(5);

        return view('user.dashboard.trades.index', compact('trades'));
    }

    public function adminTrades(){
        $trades = Trade::latest()->where('is_special', 1)->where('transaction_status', 'pending')->get();
        return view('admin.trades.index', compact('trades'));
    }

    public function enscrow(){
        $trades = Trade::latest()->where('is_special', 0)->where('transaction_status', 'pending')->get();
        return view('admin.enscrow.index', compact('trades'));
    }

    public function aceAccept(Trade $trade){
        if (!$trade->ace_transaction_stage == null){
            return view('admin.enscrow.panel', compact('trade'));
        }
        $trade->ace_transaction_stage = 1;
        $trade->update();

        return view('admin.enscrow.panel', compact('trade'));
    }

    public function aceProceed(Trade $trade){
        return view('admin.enscrow.panel', compact('trade'));
    }

    public function allTransactions(){
        $trades = Trade::latest()->paginate(10);

        return view('admin.trades', ['trades' => $trades, 'search' => false]);
    }

    public function aceStep2(Trade $trade){

        if (!($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 1)){
            return;
        }

        $trade->ace_transaction_stage = 2;
        $trade->update();

        $html = view('admin.enscrow.partials.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));

    }

    public function aceStep3(Trade $trade){

        if (!($trade->seller_transaction_stage >= 3 && $trade->buyer_transaction_stage >= 3 && $trade->ace_transaction_stage == 2)){
            return;
        }

        $trade->ace_transaction_stage = 3;
        $trade->transaction_status = "success";////
        $trade->update();

        $html = view('admin.enscrow.partials.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));

    }

    public function aceNavStep1(Trade $trade){
        if (!($trade->seller_transaction_stage >= 2 && $trade->buyer_transaction_stage >= 2 && $trade->ace_transaction_stage >= 1)){
            return;
        }

        $html = view('admin.enscrow.partials.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function aceNavStep2(Trade $trade){

        if (!($trade->seller_transaction_stage >= 3 && $trade->buyer_transaction_stage >= 3 && $trade->ace_transaction_stage >= 2)){
            return;
        }

        $html = view('admin.enscrow.partials.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function aceNavStep3(Trade $trade){

        if (!($trade->seller_transaction_stage >= 3 && $trade->buyer_transaction_stage >= 3 && $trade->ace_transaction_stage >= 2)){
            return;
        }

        $html = view('admin.enscrow.partials.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    /**
     * ACE ADMIN ACCEPT TRADE BUY
     *
     */

    public function adminAcceptBuy(Trade $trade){
        return view('admin.trades.accept.buy', compact('trade'));
    }

    public function adminAcceptBuyStep1(Trade $trade){

        $trade->buyer_transaction_stage = 1;

        $trade->update();

        $html = view('admin.trades.accept.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyStep2(Trade $trade){

        if (!($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 1)){
            return;
        }

        $trade->buyer_transaction_stage = 2;

        $trade->update();

//        if ($trade->buyer_transaction_stage == 2){
//            return;
//        }

        $html = view('admin.trades.accept.partials.buy.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyStep3(Trade $trade){

        if (!($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2)){
            return;
        }

        $trade->buyer_transaction_stage = 3;

        $trade->update();

        $html = view('admin.trades.accept.partials.buy.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyStep4(Trade $trade){

        $trade->buyer_transaction_stage = 4;

        $trade->update();

        $html = view('admin.trades.accept.partials.buy.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyNavStep1(Trade $trade){

        if (!$trade){
            return;
        }

        $html = view('admin.trades.accept.partials.buy.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyNavStep2(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 1 ){
            return;
        }

        $html = view('admin.trades.accept.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyNavStep3(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 2 ){
            return;
        }

        $html = view('admin.trades.accept.partials.buy.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyNavStep4(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 3 ){
            return;
        }

        if ($trade->seller_transaction_stage < 2 || $trade->buyer_transaction_stage < 3){
            return;
        }

        $html = view('admin.trades.accept.partials.buy.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptBuyNavStep5(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 4 || $trade->seller_transaction_stage < 3){
            return;
        }

        if ($trade->buyer_transaction_stage == 4){

            $trade->transaction_status = "success";

            $trade->update();
        }

        $html = view('admin.trades.accept.partials.buy.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }





    /**
     * ACE ADMIN ACCEPT TRADE SElL
     *
     */

    public function adminAcceptSell(Trade $trade){
        return view('admin.trades.accept.sell', compact('trade'));
    }

    public function allTransactionsFilter(Request $request){
        $user = User::where('display_name', $request->val)->first();

        if ($user){
            $trades = Trade::latest()->
            where('seller_id', $user->id)->
            orWhere('buyer_id', $user->id)->
            orWhere('transaction_id', $request->val)->
            orWhere('coin_amount', $request->val)->
            paginate(10);
        }else{
            $trades = Trade::latest()->
            where('transaction_id', $request->val)->
            orWhere('coin_amount', $request->val)->
            paginate(10);
        }

        return view('admin.trades', ['trades' => $trades, 'search' => true, 'val' => $request->val]);
    }

    public function adminAcceptSellStep1(Request $request){
        $trade = Trade::findOrFail($request->trade);

        if (!($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null)){
            return;
        }

        $trade->seller_transaction_stage = 1;

        $trade->update();

        $html = view('admin.trades.accept.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellStep2(Trade $trade){


        if (!($trade->buyer_transaction_stage == 3 && $trade->seller_transaction_stage == 1)){
            return;
        }

        $trade->seller_transaction_stage = 2;

        $trade->update();

        $html = view('admin.trades.accept.partials.sell.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellStep3(Trade $trade){

        if (!($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage >= 3)){
            return;
        }

        $trade->seller_transaction_stage = 3;

        $trade->update();

        $html = view('admin.trades.accept.partials.sell.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellStep4(Trade $trade){

        $trade->seller_transaction_stage = 4;

        $trade->transaction_status = "success";

        $trade->update();

        $html = view('admin.trades.accept.partials.sell.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellNavStep1(Trade $trade){

        if ($trade->seller_transaction_stage < 1){
            return;
        }

        $html = view('admin.trades.accept.partials.sell.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellNavStep2(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 1 ){
            return;
        }

        $html = view('admin.trades.accept.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellNavStep3(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 2 ){
            return;
        }

        $html = view('admin.trades.accept.partials.sell.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellNavStep4(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 3 ){
            return;
        }

        $html = view('admin.trades.accept.partials.sell.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function adminAcceptSellNavStep5(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 4 ){
            return;
        }

        $html = view('admin.trades.accept.partials.sell.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }



    /**
     * ACCEPT TRADE BUY
     *
     */

    public function acceptBuy(Trade $trade){
        return view('user.dashboard.trades.accept.buy', compact('trade'));
    }

    public function acceptBuyStep1(Trade $trade){

        $trade->buyer_transaction_stage = 1;

        $trade->update();

        $html = view('user.dashboard.trades.accept.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyStep2(Trade $trade){

        if (!($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 1)){
            return;
        }

        $trade->buyer_transaction_stage = 2;

        $trade->update();

//        if ($trade->buyer_transaction_stage == 2){
//            return;
//        }

        $html = view('user.dashboard.trades.accept.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyStep3(Trade $trade){

        if (!($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 2)){
            return;
        }

        $trade->buyer_transaction_stage = 3;

        $trade->update();

        $html = view('user.dashboard.trades.accept.partials.buy.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyStep4(Trade $trade){

        $trade->buyer_transaction_stage = 4;

        $trade->update();

        $html = view('user.dashboard.trades.accept.partials.buy.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyNavStep1(Trade $trade){

        if (!$trade){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.buy.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyNavStep2(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 1 ){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyNavStep3(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 2 ){
            return;
        }

        if ($trade->seller_transaction_stage < 2 || $trade->seller_transaction_stage < 2 || $trade->ace_transaction_stage < 2){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.buy.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyNavStep4(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 3 ){
            return;
        }

        if ($trade->seller_transaction_stage < 3 || $trade->seller_transaction_stage < 3){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.buy.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptBuyNavStep5(Trade $trade){

        if (!$trade || $trade->buyer_transaction_stage < 4 ){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.buy.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }





    /**
     * ACCEPT TRADE SELL
     *
     */

    public function acceptSell(Trade $trade){
        return view('user.dashboard.trades.accept.sell', compact('trade'));
    }

    public function acceptSellStep1(Request $request){
        if (!$request->has('company')){
            return response()->json(array('success' => false, 'error' => 'wallet company error'));
        }
        $trade = Trade::findOrFail($request->trade);

        if (!($trade->buyer_transaction_stage == 2 && $trade->seller_transaction_stage == null && $trade->ace_transaction_stage == 1)){
            return;
        }

        $trade->seller_transaction_stage = 1;
        $trade->seller_wallet_company = $request->company;

        $trade->update();

        $html = view('user.dashboard.trades.accept.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellStep2(Trade $trade){


        $trade->seller_transaction_stage = 2;

        $trade->update();

        $html = view('user.dashboard.trades.accept.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellStep3(Trade $trade){

        if (!($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 3)){
            return;
        }

        $trade->seller_transaction_stage = 3;

        $trade->update();

        $html = view('user.dashboard.trades.accept.partials.sell.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellStep4(Trade $trade){

        $trade->seller_transaction_stage = 4;

        $trade->update();

        $html = view('user.dashboard.trades.accept.partials.sell.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellNavStep1(Trade $trade){

        if (!$trade){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.sell.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellNavStep2(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 1 ){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellNavStep3(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 2 ){
            return;
        }

        if ($trade->buyer_transaction_stage < 2 || $trade->seller_transaction_stage < 2 || $trade->ace_transaction_stage < 2){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.sell.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellNavStep4(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 3 ){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.sell.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function acceptSellNavStep5(Trade $trade){

        if (!$trade || $trade->seller_transaction_stage < 4 ){
            return;
        }

        $html = view('user.dashboard.trades.accept.partials.sell.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }



    /**
     * INITIATE TRADE SELL
     *
     */

    public function initiateSell(Market $market){

        $trade = Trade::where('seller_id', Auth::user()->id)->where('buyer_id', $market->user_id)->where('market_id', $market->id)->where('transaction_status', "pending")->first();

        if ($trade){
            return view('user.dashboard.trades.initiate.sell', compact('market', 'trade'));
        }

        if ($this->marketBelongsToUser($market)){
            return back()->with('error', 'You cant carryout a trade on an advert that belongs to you');
        }

        if (!$this->userHasVerification()){
            return back()->with('error', 'You have to verify your phone number and documents before SELL trade can be carried out');
        }

        if (!$this->userSellVerified()){
            return back()->with('error', 'You have to verify your phone number and documents before SELL trade can be carried out');
        }elseif (!$this->sellerAccount()){
            return back()->with('error', 'please proceed to fill in your BANK DETAILS in PROFILE and try again');
        }

        return view('user.dashboard.trades.initiate.sell', compact('market'));
    }

    public function initiateSellStep1(Request $request){

        $market = Market::findOrFail($request->market);

        if ($request->amount < $market->min || $request->amount > $market->max || !$request->company){
            return response()->json(array('success' => false, 'error' => 'amount error'));
        }

        $trade = Trade::where('seller_id', Auth::user()->id)->where('buyer_id', $market->user_id)->where('market_id', $market->id)->where('transaction_status', "pending")->first();

        if ($trade){
            return;
        }

        $charge = Setting::all()->first()->charges / 100;

        $trade = new Trade;
        $trade->transaction_id = "ACE".$market->user_id.Auth::user()->id.time();
        $trade->coin_id = $market->coin->id;
        $trade->market_id = $market->id;
        $trade->seller_id = Auth::user()->id;
        $trade->buyer_id = $market->user_id;
        $trade->seller_transaction_stage = 1;
        $trade->coin_amount = $request->amount;
        $trade->coin_amount_usd = $request->amount * $market->price_usd;
        $trade->coin_amount_ngn = $request->amount * $market->price_ngn;
        $trade->transaction_charge_coin = $request->amount * $charge;
        $trade->transaction_charge_usd = $request->amount * $charge * $market->price_usd;
        $trade->transaction_charge_ngn = $request->amount * $charge * $market->price_ngn;
        $trade->seller_wallet_company = $request->company;
        $trade->transaction_status = "pending";

        if ($market->is_special == 1){
            $trade->is_special = 1;
        }

        $trade->save();

        $html = view('user.dashboard.trades.initiate.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateSellStep2(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if ($trade->is_special == 1){

            if (!($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2)){
                return;
            }

            $trade->seller_transaction_stage = 2;

            $trade->update();

            $html = view('user.dashboard.trades.initiate.partials.sell.step-2', compact('trade'))->render();

            return response()->json(array('success' => true, 'html' => $html));

        }

        if (!($trade->seller_transaction_stage == 1 && $trade->buyer_transaction_stage == 2 && $trade->ace_transaction_stage == 1)){
            return;
        }

        $trade->seller_transaction_stage = 2;

        $trade->update();

        $html = view('user.dashboard.trades.initiate.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateSellStep3(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if ($trade->is_special == 1){
            if (!($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage >= 4)){
                return;
            }

            $trade->seller_transaction_stage = 3;

            $trade->update();

            $html = view('user.dashboard.trades.initiate.partials.sell.step-4', compact('trade'))->render();

            return response()->json(array('success' => true, 'html' => $html));
        }

        if (!($trade->seller_transaction_stage == 2 && $trade->buyer_transaction_stage == 3 && $trade->ace_transaction_stage == 2)){
            return;
        }

        $trade->seller_transaction_stage = 3;

        $trade->update();

        $html = view('user.dashboard.trades.initiate.partials.sell.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateSellStep4(Request $request){

        $trade = Trade::findOrFail($request->trade);

        $trade->seller_transaction_stage = 4;

        $trade->update();

        $html = view('user.dashboard.trades.initiate.partials.sell.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }


    public function initiateSellNavStep1(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if (!$trade){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.sell.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateSellNavStep2(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if ($trade->is_special == 1){
            if ($trade->seller_transaction_stage < 1 || !$trade->buyer_transaction_stage){
                return;
            }

            if ($trade->seller_transaction_stage < 1 || $trade->buyer_transaction_stage < 2){
                return;
            }
            $html = view('user.dashboard.trades.initiate.partials.sell.step-2', compact('trade'))->render();

            return response()->json(array('success' => true, 'html' => $html));
        }

        if (!$trade || $trade->seller_transaction_stage < 1 || !$trade->buyer_transaction_stage || $trade->ace_transaction_stage == null){
            return;
        }

        if ($trade->seller_transaction_stage < 1 || $trade->buyer_transaction_stage < 2){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.sell.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateSellNavStep3(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if ($trade->is_special == 1){

            if ($trade->seller_transaction_stage < 2 || $trade->buyer_transaction_stage < 3){
                return;
            }

            $html = view('user.dashboard.trades.initiate.partials.sell.step-3', compact('trade'))->render();

            return response()->json(array('success' => true, 'html' => $html));
        }

        if (!$trade){
            return;
        }

        if ($trade->seller_transaction_stage < 2 || $trade->seller_transaction_stage < 2 || $trade->ace_transaction_stage < 2){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.sell.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateSellNavStep4(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if (!$trade || $trade->seller_transaction_stage < 3 ){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.sell.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateSellNavStep5(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if (!$trade || $trade->seller_transaction_stage < 4 ){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.sell.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }



    /**
     * INITIATE TRADE BUY
     *
     */

    public function initiateBuy(Market $market){

        $trade = Trade::where('buyer_id', Auth::user()->id)->where('seller_id', $market->user_id)->where('market_id', $market->id)->where('transaction_status', "pending")->first();

        if ($trade){
            return view('user.dashboard.trades.initiate.buy', compact('market', 'trade'));
        }


        if ($this->marketBelongsToUser($market)){
            return back()->with('error', 'You cant carryout a trade on an advert that belongs to you');
        }

        if (!$this->userHasVerification()){
            return back()->with('error', 'You have to verify your phone number before BUY trade can be carried out');
        }

        if (!$this->userBuyVerified()){
            return back()->with('error', 'You have to verify your phone number before BUY trade can be carried out');
        }elseif (!$this->buyerWallet($market->coin->id)){
            return back()->with('error', 'please add a wallet for this coin before carrying out a BUY trade');
        }

        return view('user.dashboard.trades.initiate.buy', compact('market'));
    }

    public function initiateBuyStep1(Request $request){

        $market = Market::findOrFail($request->market);

        $trade = Trade::where('buyer_id', Auth::user()->id)->where('seller_id', $market->user_id)->where('market_id', $market->id)->where('transaction_status', "pending")->first();

        if ($trade){
            return;
        }

        if ($request->amount < $market->min || $request->amount > $market->max){
            return response()->json(array('success' => false, 'error' => 'amount error'));
        }

        $charge = Setting::all()->first()->charges / 100;

        $trade = new Trade;
        $trade->transaction_id = "ACE".$market->user_id.Auth::user()->id.time();
        $trade->coin_id = $market->coin->id;
        $trade->market_id = $market->id;
        $trade->buyer_id = Auth::user()->id;
        $trade->seller_id = $market->user_id;
        $trade->buyer_transaction_stage = 1;
        $trade->coin_amount = $request->amount;
        $trade->coin_amount_usd = $request->amount * $market->price_usd;
        $trade->coin_amount_ngn = $request->amount * $market->price_ngn;
        $trade->transaction_charge_coin = $request->amount * $charge;
        $trade->transaction_charge_usd = $request->amount * $charge * $market->price_usd;
        $trade->transaction_charge_ngn = $request->amount * $charge * $market->price_ngn;
        $trade->transaction_status = "pending";

        if ($market->is_special == 1){
            $trade->is_special = 1;
        }

        $trade->save();

        $html = view('user.dashboard.trades.initiate.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyStep2(Request $request){

        $trade = Trade::findOrFail($request->trade);

        $trade->buyer_transaction_stage = 2;

        $trade->update();

        $html = view('user.dashboard.trades.initiate.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyStep3(Request $request){

        $trade = Trade::findOrFail($request->trade);

        $trade->buyer_transaction_stage = 3;

        $trade->update();

        $html = view('user.dashboard.trades.initiate.partials.buy.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyStep4(Request $request){

        $trade = Trade::findOrFail($request->trade);

        $trade->buyer_transaction_stage = 4;

        $trade->update();

        $html = view('user.dashboard.trades.initiate.partials.buy.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyNavStep1(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if (!$trade){
            return;
        }

        if ($trade->buyer_transaction_stage)

        $html = view('user.dashboard.trades.initiate.partials.buy.step-1', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyNavStep2(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if (!$trade || $trade->buyer_transaction_stage < 1 ){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.buy.step-2', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyNavStep3(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if ($trade->is_special == 1){
            if ($trade->buyer_transaction_stage < 2 || $trade->seller_transaction_stage < 1 || !$trade->seller_transaction_stage ){
                return;
            }


            $html = view('user.dashboard.trades.initiate.partials.buy.step-3', compact('trade'))->render();

            return response()->json(array('success' => true, 'html' => $html));
        }

        if (!$trade || $trade->buyer_transaction_stage < 2 ){
            return;
        }

        if ($trade->buyer_transaction_stage < 2 || $trade->seller_transaction_stage < 2 || !$trade->seller_transaction_stage || $trade->ace_transaction_stage < 2){
            return;
        }


        $html = view('user.dashboard.trades.initiate.partials.buy.step-3', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyNavStep4(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if ($trade->is_special == 1){
            if (!$trade || $trade->buyer_transaction_stage < 3 || $trade->seller_transaction_stage < 2 ){
                return;
            }

            $html = view('user.dashboard.trades.initiate.partials.buy.step-4', compact('trade'))->render();

            return response()->json(array('success' => true, 'html' => $html));
        }

        if (!$trade || $trade->buyer_transaction_stage < 3 || $trade->seller_transaction_stage < 3 ){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.buy.step-4', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    public function initiateBuyNavStep5(Request $request){

        $trade = Trade::findOrFail($request->trade);

        if (!$trade || $trade->buyer_transaction_stage < 4 ){
            return;
        }

        $html = view('user.dashboard.trades.initiate.partials.buy.step-5', compact('trade'))->render();

        return response()->json(array('success' => true, 'html' => $html));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        //
    }



    protected function userHasVerification(){
        if (Auth::user()->verification){
            return true;
        }
    }

    protected function userBuyVerified(){
        if (Auth::user()->verification->is_email_verified && Auth::user()->verification->is_phone_verified){
            return true;
        }
    }

    protected function userSellVerified(){
        if (Auth::user()->verification->is_email_verified && Auth::user()->verification->is_phone_verified && Auth::user()->verification->is_document_verified){
            return true;
        }
    }

    protected function sellerAccount(){
        if (Auth::user()->bankaccount){
            if (Auth::user()->bankaccount->bank_name && Auth::user()->bankaccount->account_name && Auth::user()->bankaccount->account_number){
                return true;
            }
        }
    }

    protected function buyerWallet($coin){
        if (Wallet::where('user_id', Auth::user()->id)->where('coin_id', $coin)->first()){
            return true;
        }
    }

    protected function marketBelongsToUser($market){
        if ($market->user->id === Auth::user()->id){
            return true;
        }
    }
}
